define('select_control', ['jquery', 'underscore', 'filter_service', 'tools'], function (jQuery, _, FilterService, tools) {
    jQuery.fn.selectControl = function () {
        this.each(function (index) {
            var thisEl = jQuery(this);
            var filterId = thisEl.data('filter-id');
            var filterObj = {
                element: thisEl,
                options: {}
            };
            var type = thisEl.data('type');

            if (thisEl.hasClass('not-close-click')) {
                thisEl.on('click', function (event) {
                    event.stopPropagation();
                })
            }

            if (type === 'single') {
                filterObj.type = FilterService.types.VALUE;
                thisEl.monitor = jQuery('[act="filter-monitor"][data-filter-id="'+filterId+'"]');
                thisEl.setMonitor = function (value) {
                    if(thisEl.monitor.length !== 0){
                        thisEl.monitor.text(value);
                    }
                };
            } else if (type === 'multi') {
                filterObj.type = FilterService.types.SELECT;
            }

            filterObj.is_colors = thisEl.data("is-colors");

            if (filterId) {
                thisEl.find('[act="filter-option"]').each(function (optionIndex) {
                    var optionEl = jQuery(this);
                    var alias = optionEl.data('alias');
                    if (alias)
                        filterObj.options[alias] = optionEl.data('value');
                    if (type === 'single') {
                        optionEl.on('click', function (event) {
                            thisEl.find('[act="filter-option"]').removeClass('active');
                            thisEl.setMonitor(alias);
                            FilterService.updateValue(filterId, alias);
                            optionEl.addClass('active');
                        });
                    }

                    if (type === 'multi') {
                        optionEl.find('input[type="checkbox"]').on('change', function (event) {
                            var selectedOptions = [];
                            thisEl.find('input[type="checkbox"]:checked').each(function (inputIndex) {
                                var selectedAlias = jQuery(this).closest('li').data('alias');
                                if (selectedAlias) {
                                    selectedOptions.push(selectedAlias);
                                }
                            });
                            FilterService.updateValue(filterId, selectedOptions);
                        });
                    }
                });

                thisEl.bind('filter:update_value', function (event, result) {
                    if(type === 'single'){
                        thisEl.setMonitor(result);
                    }else if(type === 'multi'){
                        thisEl.find('[act="filter-option"]').each(function (index) {
                            var thisOption = jQuery(this);
                            var alias = thisOption.data('alias');
                            if (alias) {
                                if (result.hasOwnProperty(alias) || result.indexOf(alias) !== -1) {
                                    thisOption.find('input').attr('checked', true);
                                } else {
                                    thisOption.find('input').attr('checked', false);
                                }
                            }
                        });
                    }

                });

                FilterService.add(filterId, filterObj);
            }


        });
        if (tools.getUrlParameter('tag')) {
            var tagItem = jQuery.parseJSON(localStorage.getItem('tagItems'));
            var tagId = tagItem.tag_filter;
            var tagObj = {
                element: '',
                options: {},
                type: 0,
                value: [tagItem.tag_key],
                tag: true
            };
            tagObj.options[tagItem.tag_key] = parseInt(tagItem.tag_value);
            FilterService.add(tagId, tagObj);
        }
    };
});