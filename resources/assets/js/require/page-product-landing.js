if (window.currentPage === "product-landing-category") {
    require(['jquery', 'swiper', 'loadScroll' ,'search'],
        function (jQuery, Swiper, loadScroll) {

            var swiper1 = new Swiper('.main-page-slider .swiper-container', {
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
            jQuery('source').loadScroll(500);

        })
}