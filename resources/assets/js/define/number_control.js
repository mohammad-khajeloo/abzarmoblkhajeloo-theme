define('number_control', ['jquery', 'tools', 'template'], function (jQuery, tools, template) {
    (function (jQuery) {
        jQuery.fn.numberControl = function () {
            this.on('keyup keydown', function (_event) {
                var thisEl = jQuery(this);
                var allowedKeys = "1234567890۱۲۳۴۵۶۷۸۹۰";
                var thisVal = thisEl.val();

                var pressedKey = _event.key;
                if (allowedKeys.indexOf(pressedKey) !== -1) {
                    _event.preventDefault();
                    _event.stopPropagation();

                    if (_event.type === "keydown") {
                        thisVal += pressedKey;
                        thisVal = tools.convertNumberToPersian(thisVal);
                    }

                } else {
                    thisVal = tools.dropNonDigits(thisVal);
                    thisVal = tools.convertNumberToPersian(thisVal);
                }

                var dataNumber = tools.convertNumberToEnglish(thisVal);
                window.numberInputs[thisEl.attr('name')].val(dataNumber);
                thisEl.val(thisVal);

            }).each(function (index) {
                window.numberInputs = window.numberInputs || {};

                var thisEl = jQuery(this);
                var name = (thisEl.attr('name') || 'price');
                thisEl.attr('name', name + '-view');
                thisEl.closest('form').append(template.formInput({inputName: name, inputValue: 0}));
                window.numberInputs[thisEl.attr('name')] = jQuery('input[name="' + name + '"]');

                var inputNumber = tools.dropNonDigits(thisEl.val());
                var dataNumber = tools.convertNumberToEnglish(inputNumber);
                var viewNumber = tools.convertNumberToPersian(inputNumber);
                window.numberInputs[thisEl.attr('name')].val(dataNumber);
                thisEl.val(viewNumber);
            });
        };
    })
    (jQuery);
})
;