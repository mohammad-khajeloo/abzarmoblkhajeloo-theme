if (window.currentPage === "blog-list") {
    require(['jquery', 'swiper'],
        function (jQuery, Swiper) {

            var swiper = new Swiper('.articles .slider .swiper-container', {
                pagination: {
                    el: '.swiper-pagination'
                },
            });


        }
    );
}