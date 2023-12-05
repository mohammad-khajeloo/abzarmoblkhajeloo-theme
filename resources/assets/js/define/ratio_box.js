define('ratio_box', ['jquery'], function (jQuery) {
    jQuery.fn.reformBox = function () {
        var thisEl = jQuery(this);
        var ratio = thisEl.data('ratio');
        if (ratio) {
            var ratioParts = ratio.split(":");
            if(ratioParts.length === 2){
                var ratioW = parseFloat(ratioParts[0]),
                    ratioH = parseFloat(ratioParts[1]);

                var resultHeight = thisEl.outerWidth() * ratioH / ratioW ;
                thisEl.css({
                    height: resultHeight + "px"
                });
            }
        }
        return this;
    };

    jQuery.fn.ratioBox = function () {
        this.each(function (_index) {
            var thisEl = jQuery(this);
            thisEl.reformBox();

            jQuery(window).load(function (_event) {
                thisEl.reformBox();
            });

            jQuery(window).resize(function (_event) {
                thisEl.reformBox();
            });
        });
        return this;
    };
});