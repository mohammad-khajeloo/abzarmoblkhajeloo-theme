define('price_control', ['jquery', 'tools'], function (jQuery, tools) {
    (function (jQuery) {
        jQuery.fn.priceControl = function () {
            this.on('keyup', function (event) {
                var thisEl = jQuery(this);
                var correctNumber = tools.dropNonDigits(thisEl.val());
                var persianNumber = tools.convertNumberToPersian(correctNumber);
                thisEl.val(tools.formatNumber(persianNumber));
            }).on('change', function(event){
                var thisEl = jQuery(this);
                var correctNumber = tools.dropNonDigits(thisEl.val());
                var persianNumber = tools.convertNumberToPersian(correctNumber);
                thisEl.val(tools.formatNumber(persianNumber));
            }).each(function (index) {

                var thisEl = jQuery(this);
                var name = (thisEl.attr('name') || 'price');
                thisEl.attr('name', name + '-view');

                var correctNumber = tools.dropNonDigits(thisEl.val());
                var persianNumber = tools.convertNumberToPersian(correctNumber);
                thisEl.val(tools.formatNumber(persianNumber));
            });
        };
    })(jQuery);
});