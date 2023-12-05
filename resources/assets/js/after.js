if (window.currentPage === "product-filter") {
    require(['jquery', 'swiper', 'filter_service', 'price_data'], function (jQuery, Swiper, FilterService) {
        FilterService.initHash();
        var quickViewSlider = new Swiper('#product-quick-view-slider', {
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });

        var quickViewModal = jQuery('#product-quick-view');
        jQuery('body').on('click', '.quick-view', function () {
            var thisElement = jQuery(this);

            var productTitle = thisElement.data('product-title'),
                productTitleTag = quickViewModal.find("#product-modal-title");
            productTitleTag.empty();
            productTitleTag.append(productTitle);

            var productBox = quickViewModal.find('.product-item-modal');
            var productId = thisElement.data('product-id');
            var productCount = thisElement.attr('data-value');
            // Todo : after this job this can be change to function
            quickViewModal.find('.counter-input .counter-box-modal').addClass('d-none');
            quickViewModal.find('#product-modal-add-to-cart').addClass('d-none');
            if (thisElement.attr('data-product-isCart')==='true')
                quickViewModal.find('.counter-input .counter-box-modal').removeClass('d-none');
            else
                quickViewModal.find('#product-modal-add-to-cart').removeClass('d-none');

            var cart_row_id = thisElement.data('cart-row-id');
            productBox.attr('data-product-id', productId);
            productBox.attr('data-row-id', cart_row_id);
            productBox.find('div.count-group').attr('data-action','/customer/cart/detach-product/'+productId);
            productBox.find('input.count-control-local').attr('value',productCount);
            productBox.find('input.count-control-local').val(productCount);
            productBox.find('input.count-control-local').attr('name', 'count-' + productId);
            productBox.find('input.count-control-local').attr('data-max', thisElement.data('max'));
            productBox.find('input.count-control-local').attr('data-min', thisElement.data('min'));
            productBox.find('.counter-box-modal').addClass('counter-box-' + productId);
            productBox.find('.add-basket').addClass('single-add-btn-' + productId);
            // end here
            var productStatus = thisElement.data('product-status');
            quickViewModal.find('.modal-content').removeClass('active');
            quickViewModal.find('.modal-content').removeClass('not-active');
            quickViewModal.find('.modal-content').addClass(productStatus);

            var productCode = thisElement.data('product-code');
            var productCodeTag = quickViewModal.find("#product-modal-code");
            productCodeTag.empty();
            productCodeTag.append(productCode);

            var productPrice = thisElement.data('product-price');
            var productPriceTag = quickViewModal.find("#product-modal-price");
            productPriceTag.empty();
            productPriceTag.append(productPrice);

            var productAddToCart = thisElement.data('product-add-to-cart');
            var productAddToCartTag = quickViewModal.find("#product-modal-add-to-cart");
            productAddToCartTag.attr("href", productAddToCart);

            var productAddToNeedList = thisElement.data('product-add-to-need-list');
            var productAddToNeedListTag = quickViewModal.find("#product-modal-add-to-need-list");
            productAddToNeedListTag.attr("href", productAddToNeedList);

            var productMainPhoto = thisElement.data('product-main-photo');
            var productMainPhotoTag = quickViewModal.find("#product-modal-main-photo");
            productMainPhotoTag.attr("src", productMainPhoto);
            productMainPhotoTag.attr("alt", productTitle);

            var productSecondaryPhoto = thisElement.data('product-secondary-photo');
            var productSecondaryPhotoTag = quickViewModal.find("#product-modal-secondary-photo");
            productSecondaryPhotoTag.attr("src", productSecondaryPhoto);
            productSecondaryPhotoTag.attr("alt", productTitle);

            var productUrl = thisElement.data('product-url');
            var productUrlTag = quickViewModal.find("#product-modal-url");
            productUrlTag.attr("href", productUrl);

            var productExtraProperties = thisElement.data('product-extra-properties');

            var productModalExtraProperties = jQuery("#product-modal-extra-properties");
            productModalExtraProperties.empty();
            productModalExtraProperties.append("<div class='title-wrapper'>" +
                "<div class=\"title\">ویژگی‌ها</div>" + "  </div>");
            jQuery.each(productExtraProperties, function (key, value) {
                productModalExtraProperties.append("<div class=\"product-property\">" +
                    "<div class=\"property-title\">" + value.key + "</div>" +
                    "<span class=\"property-value p-structure-value\">" + value.value +
                    "</span> </div>");
            });
            quickViewModal.modal('show');
            jQuery('.price-data').formatPrice();
            // jQuery('#product-modal-add-to-cart').on('click', function () {
            //     quickViewModal.modal('hide');
            // });

        });

        quickViewModal.on('shown.bs.modal', function (e) {
            quickViewSlider.update();
        });

    });
}


if (window.currentPage === "index") {
    require(['jquery'], function (jQuery) {

            /*jQuery(window).on("load", function () {
                jQuery('img').each(function () {
                    var th=jQuery(this);
                    var src=th.data('src');
                    th.attr('src',src);
                })
            });*/


            /*jQuery('img:not([src^="/"])').each(function () {
                var th = jQuery(this);
                th.load(function () {
                    var src = th.data('src');
                    th.attr('src', src);
                });
            })*/

        }
    );
}