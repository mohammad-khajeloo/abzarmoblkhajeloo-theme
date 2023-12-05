define('search', ['jquery', 'underscore', 'settings', 'template', 'data_analysis', 'init_settings'],
    function (jQuery, _, settings, template, DataAnalysisService) {

        jQuery.fn.search = function () {
            var win = jQuery(window);
            var winH = win.height();
            var winW = win.width();

            this.each(function (index) {
                var searchContainer = jQuery(this);
                var searchInput = searchContainer.find("input");
                var searchResultContainer = searchContainer.find(".search-result");
                var loadingContainer = searchResultContainer.find(".loading");
                var showMoreLink = searchResultContainer.find(".more");

                var directoriesResultContainer = searchResultContainer.find('.search-result-categories');
                var productsResultContainer = searchResultContainer.find('.search-result-product');

                var directoriesNoResultContainer = searchResultContainer.find('.categories-no-result');
                var productsNoResultContainer = searchResultContainer.find('.products-no-result');

                var search = {
                    url: settings.product.search.url.get(),
                    method: settings.product.search.url.method.get(),
                    latestValue: '',
                    timeout: null,
                    delay: settings.product.search.delay.get()
                };


                init();

                function init() {

                    searchInput.val('');
                    searchInput.keyup(handleChangeInput);
                    searchInput.focus(handleChangeInput);

                    win.click(hideSearchContainer);
                    searchContainer.click(function (event) {
                        event.stopPropagation();
                    });

                    if (winW < 1200) {
                        searchResultContainer.css('max-height', winH - 100 + 'px');
                    }
                }

                function handleChangeInput(e) {
                    var query = searchInput.val().trim();
                    if (isAcceptable(query)) {
                        clearTimeout(search.timeout);
                        search.timeout = setTimeout(function () {
                            fetchResult(query)
                        }, search.delay);
                    } else if (isEmpty(query)) {
                        hideSearchContainer();
                    }
                }

                function fetchResult(query) {
                    loadingContainer.show();
                    searchResultContainer.show();
                    productsNoResultContainer.hide();
                    directoriesNoResultContainer.hide();

                    DataAnalysisService.addSearchQuery(query);

                    jQuery.ajax(
                        {
                            url: search.url,
                            method: search.method,
                            data: {
                                query: query
                            }
                        }
                    ).done(function (response) {
                        search.latestValue = query;
                        loadingContainer.hide();
                        clearResultContainers();
                        pushProducts(response.products);
                        pushDirectories(response.directories);
                        updateShowMoreLink(response);
                    });
                }

                function hideSearchContainer() {
                    search.latestValue = '';
                    clearResultContainers();
                    searchResultContainer.hide();
                }

                function isAcceptable(query) {
                    return (query.length >= settings.product.search.data.minLength) && (query !== search.latestValue);
                }

                function isEmpty(query) {
                    return !query;
                }

                function clearResultContainers() {
                    productsResultContainer.empty();
                    directoriesResultContainer.empty();
                }

                function pushProducts(products) {
                    if (products && products.length)
                        _.each(products, function (product) {
                            var newProductBox = jQuery(template.searchResultProductBox({product: product}));
                            productsResultContainer.append(newProductBox);
                        });
                    else
                        productsNoResultContainer.show();
                }

                function pushDirectories(directories) {
                    if (directories && directories.length)
                        _.each(directories, function (directory) {
                            var newDirectoryBox = jQuery(template.searchResultDirectoryBox({
                                directory: directory,
                                query: search.latestValue
                            }));
                            directoriesResultContainer.append(newDirectoryBox);
                        });
                    else
                        directoriesNoResultContainer.show();
                }

                function updateShowMoreLink(response) {
                    if (response.directories.length + response.products.length > 0) {
                        showMoreLink.show();
                        showMoreLink.attr("href", "/search?query=" + search.latestValue);
                    } else
                        showMoreLink.hide();
                }

            });
        }
    });