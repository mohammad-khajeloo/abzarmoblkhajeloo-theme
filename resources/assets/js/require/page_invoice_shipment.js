if (window.currentPage === "invoice-shipment") {
    require(['jquery', 'template', 'swiper'], function (jQuery, template, Swiper) {
        var shippingTimeSlider = new Swiper('.shipping-time .swiper-container', {
            slidesPerView: 'auto',
            spaceBetween: 15,
            freeMode: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 5,
                },
                992: {
                    slidesPerView: 'auto',
                    spaceBetween: 15,
                    freeMode: true,
                },
            }
        });
        const logisticsContainer = jQuery("#logistics-container");

        function checkLogisticsStatus(cityId) {
            if (cityId === "333") {
                if (logisticsContainer.length > 0) {
                    logisticsContainer.fadeIn();
                    logisticsContainer.find("input[name='logistics_enabled']").val("1");
                }

                jQuery(".shipping-text").html('سفارش شما <span class="shipping-day"></span> در بازه زمانی ۱۴ الی ۱۸ به دستتان خواهد رسید.');
                if (window.currentServerTime >= '08:30' && window.currentServerTime <= "23:59")
                    jQuery('.shipping-day').append("فردا");
                else
                    jQuery('.shipping-day').append("امروز");

            } else {
                if (logisticsContainer.length) {
                    logisticsContainer.fadeOut();
                    logisticsContainer.find("input[name='logistics_enabled']").val("0");
                }
                jQuery(".shipping-text").html("سفارش شما با توجه به سرعت عملکرد سامانه‌های ارسال طی ۳ تا ۴ روز کاری به دستتان خواهد رسید.");
            }
        }

        jQuery("input[name='customer_address_id']").on("change", function (event) {
            checkLogisticsStatus(jQuery(this).attr("data-city-id"))
        });

        const selectedCityInput = jQuery("input[name='customer_address_id']:checked");
        if (selectedCityInput.length > 0)
            checkLogisticsStatus(selectedCityInput.attr("data-city-id"));
        else
            jQuery(".shipping-text").html("لطفا برای نمایش زمان تخمینی ارسال سفارش، آدرس خود را ایجاد و انتخاب نمایید.");

    });
}