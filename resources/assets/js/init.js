window.hc_modules = {};

require(['underscore', 'pace', 'jq_cookie']);

define('init_settings', ['settings'], function (settings) {
    settings.init();
    settings.env.set(settings.env.types.PRODUCTION);
});

require(['local_cart_service', 'jquery', 'bootstrap'],
    function (LocalCartService, jQuery) {
        window.customConfirm = function (question, accepted, rejected) {
            window.acceptReq = function () {
                if (accepted)
                    accepted();
            };
            window.rejectReq = function () {
                if (rejected)
                    rejected();
            };
            var modalEl = jQuery('#confirm-modal');
            modalEl.find('p.question').text(question);
            modalEl.modal('show');
        };

        window.customAlert = function (message) {
            var modalEl = jQuery("#alert-modal");
            modalEl.find('p.message').text(message);
            modalEl.modal('show');
        };

        window.submitForm = function () {
            if (window.currentForm)
                window.currentForm.submit();
        };

        LocalCartService.init();
    });


if (window.currentPage === "product-filter") {
    require(['jquery', 'filter_service', 'product_category_service'], function (jQuery, FilterService, ProductCategoryService) {
        FilterService.init();
        ProductCategoryService.init(jQuery('#product-category-service'));
    });
}

require(['address_service'], function (AddressService) {
    AddressService.init(["", "modal"]);
});