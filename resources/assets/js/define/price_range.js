define('price_range', ['jquery', 'underscore', 'page_direction', 'filter_service', 'seeker'],
    function (jQuery, _, PageDirection, FilterService) {
        function translateValue(result, start, end) {
            if(typeof start === "object"){
                var passedObj = _.clone(start);
                start = passedObj.start;
                end = passedObj.end;
            }

            var tmpResult = _.clone(result);

            _.each(tmpResult, function (value, index) {
                value = parseInt(value);
                if (PageDirection.get() === PageDirection.types.RTL) {
                    value = (end + start) - value;
                }
                tmpResult[index] = value;
            });

            return tmpResult;
        }

        jQuery.fn.priceRange = function (start, end) {
            var elements = this;
            this.each(function (index) {
                var thisEl = jQuery(this);

                if (!start || !end) {
                    start = thisEl.data('start');
                    end = thisEl.data('end');
                }

                thisEl.rangeSeeker({
                    start: [start, end],
                    connect: true,
                    range: {
                        'min': start,
                        'max': end
                    }
                }, [
                    {
                        eventName: 'slide',
                        eventCallback: function (result) {
                            elements.filter('[data-model="' + thisEl.data('model') + '"]').not(thisEl).each(function (index) {
                                jQuery(this).trigger('seeker:set', [result]);
                            });

                            FilterService.updateValue(thisEl.data('filter-id'), translateValue(result, start, end), false);
                        }
                    },
                    {
                        eventName: 'update',
                        eventCallback: function (result) {
                            var tmpResult = translateValue(result, start, end);

                            jQuery('[data-model="' + thisEl.data('model') + '"] [data-key]').each(function (index) {
                                var display = jQuery(this);
                                var displayData = parseInt(tmpResult[display.data('key')[PageDirection.get()]]);
                                if (typeof display.val === "function") {
                                    display.val(displayData);
                                    display.trigger('change');
                                } else {
                                    display.text(displayData);
                                }
                            });

                        }
                    }
                ]);

                //define filter service element
                thisEl.bind('filter:update_value', function (event, result) {
                    thisEl.trigger('seeker:set', [translateValue(result, start, end)]);
                });
                FilterService.add(thisEl.data('filter-id'), {
                    element : thisEl,
                    type : FilterService.types.VALUE,
                    translateData : function (result) {
                        var tmpResult = _.clone(result);
                        _.each(tmpResult, function (value, index) {
                            value = parseInt(value);
                            tmpResult[index] = value;
                        });
                        return tmpResult;
                    }
                });
            });
        };
    });

//