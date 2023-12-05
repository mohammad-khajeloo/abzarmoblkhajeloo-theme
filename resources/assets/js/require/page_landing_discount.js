if (window.currentPage === "landing-discounts") {
    require(['jquery', 'swiper', 'loadScroll', 'search'],
        function (jQuery, Swiper, loadScroll) {

            var winW = jQuery(window).width();

            var mainSlider = new Swiper('.discount-slider', {
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 5000
                }
            });

            jQuery('img').loadScroll(500);

            var cat = jQuery(".discount-categories .cat-item"), th, catLink,
            discountProducts = jQuery(".discount-products");

            cat.on('click', function (e) {
                th = jQuery(this);
                e.preventDefault();
                catLink = th.attr('href');
                if(catLink == "*"){
                    discountProducts.find('div[class^="col-lg-"]').removeAttr('style');
                }else{
                    discountProducts.find(catLink).removeAttr('style');
                    discountProducts.find('div[class^="col-lg-"]:not('+catLink+')').css('display', 'none');
                }
            })

        }
    );
}