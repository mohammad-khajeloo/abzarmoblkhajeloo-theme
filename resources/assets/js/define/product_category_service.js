define('product_category_service', ['jquery'], function (jQuery) {

    var ProductCategoryService = null;

    return ProductCategoryService = {
        init: function (moduleIDSelector) {
            if (moduleIDSelector.length !== 0) {
                var currentLink = null;

                moduleIDSelector.find('.content').find('.checkbox').each(function () {

                    var th = jQuery(this),
                        label = th.find('label.checkbox-lb');

                    label.find('input[type="radio"]').on('change', function () {
                        currentLink = label.data('href');
                        if (currentLink != null) {
                            moduleIDSelector.find('.footer .btn.submit').on('click', function () {
                                window.location.href = currentLink;
                            });
                        }
                    });
                });
            }
        }
    }

});