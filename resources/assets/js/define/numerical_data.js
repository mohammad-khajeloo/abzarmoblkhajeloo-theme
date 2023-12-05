define('numerical_data', ['jquery', 'tools'], function (jQuery, tools) {
    jQuery.fn.numericalData = function () {
        this.each(function (index) {
            var thisEl = jQuery(this);
            var result = tools.convertNumberToPersian(thisEl.text());
            thisEl.text(result);
        });
    }
});