define('fix_with_to', ['jquery'], function (jQuery) {
    jQuery.fn.reformWithTo = function (selector) {
        var compareTo = jQuery(selector);
        if (compareTo.length !== 0) {
            jQuery(this).css({
                'width': compareTo.width() + "px"
            });
        }

    };

    jQuery.fn.fixWithTo = function (selector) {
        this.each(function (index) {
            var thisEl = jQuery(this);
            thisEl.reformWithTo(selector);
            jQuery(window).resize(function (event) {
                thisEl.reformWithTo(selector);
            });
        });
    };
});