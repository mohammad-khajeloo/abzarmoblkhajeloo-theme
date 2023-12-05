if (window.currentPage === "product-filter") {
    require(['jquery'], function (jQuery) {
        /*var windowEl = jQuery(window);
        var optionsWrapperEl = jQuery("#options-wrapper");
        var optionsContainerEl = optionsWrapperEl.find('.options');
        var optionsInnerContainerEl = optionsWrapperEl.find('.inner-container');
        optionsWrapperEl.makeFixed = function () {
            optionsContainerEl.addClass('fixed');
            optionsInnerContainerEl.addClass('container-fluid');
        };
        optionsWrapperEl.makeRelative = function () {
            optionsContainerEl.removeClass('fixed');
            optionsInnerContainerEl.removeClass('container-fluid');
        };

        windowEl.scroll(function () {
            if (windowEl.width() > 992) {
                if (windowEl.scrollTop() >= optionsWrapperEl.offset().top) {
                    optionsWrapperEl.makeFixed();
                } else {
                    optionsWrapperEl.makeRelative();
                }
            }
        });*/
    });
}