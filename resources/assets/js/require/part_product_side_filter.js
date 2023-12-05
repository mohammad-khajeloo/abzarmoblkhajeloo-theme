if (window.currentPage === "product-filter") {
    require(['jquery'], function (jQuery) {
            var productsContainer = jQuery("#filter-result-container");
            var filtersWrapper = jQuery("#filters-wrapper");
            var filtersContainer = jQuery("#filters-container");
            var windowEl = jQuery(window);

            filtersContainer.destinationMargin = 0;

            jQuery.fn.offsetBottom = function () {
                return this.offset().top + this.outerHeight();
            };

            windowEl.updateScroll = function () {
                this.oldScrollTop = this.newScrollTop;
                this.newScrollTop = this.scrollTop();
            };

            windowEl.scrollDirection = function () {
                return this.oldScrollTop > this.newScrollTop ? 'UP' : 'DOWN';
            };

            windowEl.getViewHeight = function () {
                return windowEl.outerHeight() - 150;
            };

            windowEl.getBottomEdge = function () {
                return this.scrollTop() + this.outerHeight() - 20;
            };

            if (filtersWrapper.length != 0) {

                filtersWrapper.getTopEdge = function () {
                    return this.offset().top - 150;
                };

                filtersWrapper.getBottomEdge = function () {
                    return this.offsetBottom();
                };

                filtersContainer.setDestinationMargin = function (_destinationMargin, _min, _max) {
                    if (typeof _min === "undefined")
                        _min = this.getMinMargin();

                    if (typeof _max === "undefined")
                        _max = this.getMaxMargin();

                    if (_destinationMargin > _max)
                        this.destinationMargin = _max;
                    else if (_destinationMargin < _min) {
                        this.destinationMargin = _min;
                    } else {
                        this.destinationMargin = _destinationMargin;
                    }
                };

                filtersContainer.incDestinationMargin = function (_destinationMargin, _min, _max) {
                    var tmpValue = this.destinationMargin + _destinationMargin;
                    this.setDestinationMargin(tmpValue, _min, _max);
                };

                filtersContainer.getDestinationMargin = function () {
                    return this.destinationMargin;
                };

                filtersContainer.getMaxMargin = function () {
                    return Math.max(productsContainer.outerHeight() - this.outerHeight(), 0);
                };

                filtersContainer.getMinMargin = function () {
                    return 0;
                };

                filtersContainer.updatePosition = function (_dir, _scrollTop) {
                    if (typeof _dir === "undefined" || typeof _scrollTop === "undefined")
                        return false;

                    if (this.outerHeight() <= windowEl.getViewHeight()) {
                        this.setDestinationMargin(_scrollTop - filtersWrapper.getTopEdge());
                    } else {
                        if (_dir === "DOWN" && windowEl.getBottomEdge() >= this.offset().top + this.outerHeight())
                            this.setDestinationMargin(
                                windowEl.getBottomEdge() - filtersWrapper.offset().top - this.outerHeight()
                            );
                        else if (_dir === "UP" && _scrollTop + 150 <= this.offset().top) {
                            this.setDestinationMargin(
                                _scrollTop - filtersWrapper.getTopEdge()
                            );
                        }
                    }

                    this.css({
                        marginTop: this.getDestinationMargin()
                    });

                    return true;
                };

                windowEl.scroll(function () {
                    windowEl.updateScroll();
                    filtersContainer.updatePosition(windowEl.scrollDirection(), windowEl.newScrollTop);
                });

            }
        }
    )
    ;
}