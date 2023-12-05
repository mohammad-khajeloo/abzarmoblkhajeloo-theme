define('square_box', ['jquery'], function (jQuery) {
    jQuery.fn.reformSquare = function () {
        var thisEl = jQuery(this);
        thisEl.css({
            height: thisEl.outerWidth() + "px"
        });
        return this;
    };

    jQuery.fn.squareBox = function () {
        this.each(function (index) {
            var thisEl = jQuery(this);
            thisEl.reformSquare();

            jQuery(window).load(function (event) {
                thisEl.reformSquare();
            });

            jQuery(window).resize(function (event) {
                thisEl.reformSquare();
            });
        });
        return this;
    };
});