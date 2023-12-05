define('virtual_form', ['jquery', 'underscore', 'template'], function (jQuery, _, template) {
    (function (jQuery) {
        jQuery.fn.virtualForm = function () {
            this.each(function (index) {
                var submitButton = jQuery(this);
                var body = jQuery('body');
                var actionAttr = submitButton.data('action') || submitButton.attr('href') || '#';
                var methodAttr = submitButton.data('method');
                var fieldsAttr = submitButton.data('fields');
                var fields = {};
                var method = methodAttr;

                try {
                    fields = jQuery.parseJSON(fieldsAttr);
                } catch (exception) {
                    // console.error(exception);
                }

                switch (methodAttr) {
                    case 'DELETE' :
                        fields['_method'] = 'DELETE';
                        method = 'POST';
                        break;
                    case 'PUT' :
                        fields['_method'] = 'PUT';
                        method = 'POST';
                        break;
                }

                var virtualForm = jQuery(template.virtualForm({
                    formMethod: method,
                    formAction: actionAttr
                }));

                virtualForm.append(template.formInput({
                    inputName: '_token',
                    inputValue: window.csrfToken
                }));

                _.each(fields, function (value, key) {
                    virtualForm.append(template.formInput({
                        inputName: key,
                        inputValue: value
                    }));
                });

                body.append(virtualForm);

                submitButton.on('click', function (event) {
                    event.preventDefault();

                    if (submitButton.attr('confirm') !== undefined) {
                        window.currentForm = virtualForm;
                        var question = submitButton.attr('confirm');
                        question = question.length > 0 ? question : 'آیا از انجام این عملیات اطمینان دارید ؟';
                        window.customConfirm(question, window.submitForm);
                    } else {
                        virtualForm.submit();
                    }

                    return false;
                });

            });
        };
    })(jQuery);
});