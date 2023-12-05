define('filter_service',
    ['jquery', 'underscore', 'template', 'settings', 'local_cart_service', 'tools', 'init_settings', 'hashchange', 'price_data', 'rating_service', 'numerical_data'
    ],
    function (jQuery, _, template, settings, LocalCartService, tools) {
        let filters = {
            timeout: null
        };

        let currentDirectoryId = null;
        let productFilterId = null;
        let query = null;
        let productCountContainer = 0;
        let FilterService = null;
        let filterTagsContainer = null;
        let loadingContainer = null;
        let resultContainer = null;
        let loadingProtectorLayer = null;
        let loadedResult = null;
        let fetchLock = false;
        let selectedValues = [];
        let colors = [];
        let isInitiated = false;
        let discount = false;
        let noResult = jQuery("#filter-no-result").html();

        let filterTypes = {
            SELECT: 0,
            VALUE: 1
        };
        if (tools.getUrlParameter('tag')) {
            let tag_value = tools.getUrlParameter('tag');
            let tag_filter = getTagValue(4);
            let tag_key = getTagValue(5);
            let tags = {tag_value: tag_value, tag_filter: tag_filter, tag_key: tag_key};
            localStorage.setItem('tagItems', JSON.stringify(tags));
            window.history.replaceState(null, null, "?tag=" + tag_value);
        }

        function getTagValue(part) {
            let pathArray = window.location.href.split('/');
            let secondLevelLocation = pathArray[part];
            return decodeURIComponent(secondLevelLocation);
        }

        function startLoading() {
            fetchLock = true;
            if (loadingContainer.length) {
                loadingContainer.addClass('is-loading');
                loadingProtectorLayer.addClass('is-loading');
            }
        }

        function endLoading() {
            fetchLock = false;
            if (loadingContainer.length) {
                loadingContainer.removeClass('is-loading');
                setTimeout(function () {
                    loadingProtectorLayer.removeClass('is-loading');
                }, 600);
            }
        }

        function generateValue(filter) {
            if (filter && filter.value && filter.value.length)
                return filter.value;
            return false;
        }

        function updateHash(type = 'update') {
            let hashResult = '';
            _.each(filters, function (filter, key) {
                let value = generateValue(filter);
                if (value) {
                    hashResult += '/' + key + '/' + value;
                }
            });
            hashResult += '/';
            // check if type hash remove and tag param is isset
            if (tools.getUrlParameter('tag') && type === 'remove')
                window.history.replaceState(null, null, window.location.href.split('?')[0]);
            window.location.hash = decodeURIComponent(hashResult);
        }

        function updateValueIds() {
            selectedValues = [];
            _.each(filters, function (filter, key) {
                if (filter.type === filterTypes.SELECT) {
                    if (typeof filter.value !== 'undefined') {
                        let valueIds = [];
                        _.each(filter.value, function (valueKey, index) {
                            valueIds.push(filter.options[valueKey]);
                        });
                        if (filter.is_colors) {
                            colors = valueIds;
                        } else
                            selectedValues.push(valueIds);
                    }
                }
            });

            if (tools.getUrlParameter('tag')) {
                updateTags();
            }
        }

        function updateTags() {
            console.log(filterTagsContainer);
            if (filterTagsContainer.length !== 0) {
                filterTagsContainer.html('');

                _.each(filters, function (filter, key) {
                    let value = generateValue(filter);

                    if (value && filter.type === filterTypes.SELECT) {
                        _.each(value, function (alias, index) {
                            let newOptionTag = jQuery(template.filterOptionTag({
                                "alias": alias,
                            }));

                            newOptionTag.find('.remove-filter-option-tag').on('click', function (event) {
                                event.preventDefault();

                                filter.value.splice(filter.value.indexOf(alias), 1);
                                newOptionTag.remove();
                                updateHash('remove');
                                updateValueIds();
                                loadFirst();
                                if (!filter.tag)
                                    _.each(filter.elements, function (element) {
                                        element.trigger('filter:update_value', [filter.value]);
                                    });

                                return false;
                            });

                            filterTagsContainer.append(newOptionTag);
                        });
                    }
                });
            }
        }

        function fetchResult() {
            if (loadedResult === null || loadedResult.next_page_url !== null)
                if (!fetchLock) {
                    startLoading();
                    let apiUrl = settings.product.filter.url.get();
                    let next_page = 1;
                    if (loadedResult !== null && loadedResult.next_page_url !== null) {
                        let current_page = parseInt(loadedResult.current_page);
                        next_page = current_page + 1;
                    }

                    let priceRange = ["0", "999999999"];
                    if ("price-range" in filters &&
                        typeof filters["price-range"].value !== "undefined") {
                        priceRange = filters["price-range"].value;
                    }

                    let sortDefaultData = (window.siteEnv.SITE_DEFAULT_PRODUCT_SORT || "priority:desc").split(":");
                    let sortData = {
                        field: sortDefaultData[0],
                        method: sortDefaultData[1]
                    };

                    if ("sort" in filters &&
                        typeof filters["sort"].value !== "undefined") {
                        sortData = filters["sort"].options[filters["sort"].value];
                    }


                    // check set tag search
                    if (tools.getUrlParameter('tag') && selectedValues.length === 0) {
                        updateValueIds();
                    }
                    jQuery.ajax({
                        url: apiUrl,
                        type: settings.product.filter.url.method.get(),
                        data: {
                            directory_id: currentDirectoryId,
                            discount: discount,
                            query: query,
                            product_filter_id: productFilterId,
                            sort: sortData,
                            price_range: priceRange,
                            colors: colors,
                            values: selectedValues,
                            page: next_page
                        }
                    }).done(function (result) {
                        if (typeof result !== 'object')
                            loadedResult = jQuery.parseJSON(result);
                        else
                            loadedResult = result;
                        setTimeout(pushProducts, settings.product.filter.delay.get());
                        setProductCounts(result.total);
                    }).fail(function (result) {
                        console.log(result);
                    });
                }
        }

        window.loadFirst = function (titleQuery = null) {
            query = titleQuery !== null ? titleQuery : query;
            resultContainer.html("");
            loadedResult = null;
            clearTimeout(filters.timeout);
            filters.timeout = setTimeout(fetchResult, 300);
        }

        function loadMore() {
            fetchResult();
        }

        function cartResult(id) {
            if (LocalCartService.isInCart(id))
                return LocalCartService.getRow(id);
            else
                return {};
        }

        function pushProducts() {
            if (loadedResult.data && loadedResult.data.length) {
                _.each(loadedResult.data, function (product) {
                    product['is_cart'] = LocalCartService.isInCart(product.id);
                    product['cart_information'] = cartResult(product.id);
                    product['loaded'] = true;
                    const newProductBox = jQuery(template.productBox({product: product}));
                    newProductBox.find('.rating-content').ratingModule();
                    newProductBox.find('span.price-data').formatPrice();
                    newProductBox.find(".numerical-data").numericalData();
                    resultContainer.append(newProductBox);
                    newProductBox.find('.ratio-box').ratioBox();
                    LocalCartService.initProductElement(newProductBox);
                });
                LocalCartService.calculateInvoice();
            } else if (loadedResult.data.length === 0) {
                resultContainer.append(noResult);
            }
            endLoading();
        }

        function setProductCounts(count) {
            productCountContainer.html(count);
            productCountContainer.formatPrice();
        }

        return FilterService = {
            types: filterTypes,
            init: function () {
                if (!isInitiated) {
                    filterTagsContainer = jQuery('.filter-option-tag-container');
                    productCountContainer = jQuery('#products-counts');
                    loadingContainer = jQuery('#filter-loading-container');
                    resultContainer = jQuery('#filter-result-container');
                    currentDirectoryId = resultContainer.data('directory-id');
                    productFilterId = resultContainer.data("product-filter-id");
                    query = resultContainer.data('query');
                    loadingProtectorLayer = jQuery('.loading-protector-layer');
                    discount = tools.getUrlParameter("discount");
                    if (resultContainer.length !== 0) {
                        jQuery(window).scroll(function (event) {
                            let windowObj = jQuery(this);
                            let productContainerButtom = resultContainer.offset().top + resultContainer.height();

                            let windowScrollBottom = windowObj.scrollTop() + windowObj.height();
                            if (windowScrollBottom + 500 >= productContainerButtom) {
                                loadMore();
                            }
                        });
                    }
                    isInitiated = true;
                }
            },
            add: function (key, newFilter) {
                if (!isInitiated)
                    FilterService.init();
                /*
                * key : name of new filter
                *   rules : -key must not contain space character -key must be url friendly
                * newFilter : {
                *   element : jQueryElement
                *   type : types.SELECT or types.VALUE
                * }
                *
                *   rules :
                *       element must have 'filter:update_value' event listener
                *       element must call the updateValue function on change event of themselves
                *       filter elements must have initial data for themselves
                *
                * */
                if (isInitiated) {
                    let selectedFilter = filters[key] || {};
                    selectedFilter = jQuery.extend(selectedFilter, newFilter);
                    selectedFilter.elements = selectedFilter.elements || [];
                    selectedFilter.elements.push(newFilter.element);
                    filters[key] = selectedFilter;
                    loadFirst();
                }
            },
            updateValue: function (key, value, doUpdateHash) {
                if (!isInitiated)
                    FilterService.init();

                if (isInitiated) {
                    doUpdateHash = typeof doUpdateHash === "undefined" ? true : doUpdateHash;
                    let selectedFilter = filters[key];
                    if (selectedFilter) {
                        selectedFilter.value = value;
                        if (doUpdateHash)
                            updateHash();
                        if (selectedFilter.type === FilterService.types.SELECT)
                            updateTags();
                        updateValueIds();
                        loadFirst();

                        return true;
                    }
                }
                return false;
            },
            initHash: function () {
                if (!isInitiated)
                    FilterService.init();

                if (isInitiated) {
                    FilterService.translateHash();

                    jQuery(window).hashchange(function (event) {
                        FilterService.translateHash();
                    });
                }
            },
            translateHash: function () {
                if (!isInitiated)
                    FilterService.init();

                if (isInitiated) {
                    let decodedHash = decodeURIComponent(window.location.hash);
                    let hashParts = decodedHash.split('/');
                    hashParts.splice(0, 1);
                    let recordValid = false;
                    let key = '';
                    if (hashParts.length % 2 !== 0) {
                        _.each(hashParts, function (part, index) {
                            if (index % 2 === 0) {
                                recordValid = filters.hasOwnProperty(part);
                                key = part;
                            } else if (recordValid) {
                                if (part.length > 0) {
                                    let selectedValue = part.split(',');
                                    let filter = _.clone(filters[key]);
                                    if (typeof filter.translateData === "function")
                                        selectedValue = filter.translateData(selectedValue);
                                    _.each(filter.elements, function (element, index) {
                                        if (!filter.value || JSON.stringify(selectedValue) !== JSON.stringify(filter.value)) {
                                            element.trigger('filter:update_value', [selectedValue]);
                                            FilterService.updateValue(key, selectedValue, false);
                                        }
                                    });
                                }
                            }
                        });
                    }
                }
            },
        }

    });