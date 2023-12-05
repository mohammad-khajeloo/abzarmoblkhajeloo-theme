if (window.currentPage === "index") {
    require(['jquery', 'swiper', 'loadScroll', 'search'],
        function (jQuery, Swiper, loadScroll) {

            var winW = jQuery(window).width();

            var mainSlider = new Swiper('.main-page-slider .swiper-container', {
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 5000
                }
            });

            var discountSlider = new Swiper('.main-page-banner-big .swiper-container', {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 5000
                }
            });

            var discounts = new Swiper('.main-top-selling-content .swiper-container', {
                slidesPerView: 6,
                slidesPerColumn: 1,
                spaceBetween: 15,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    1200: {
                        slidesPerView: 4,
                        slidesPerColumn: 1,
                    },
                    767: {
                        slidesPerView: 1,
                        slidesPerColumn: 3,
                    },
                    575: {
                        slidesPerView: 1,
                        slidesPerColumn: 3,
                    }
                }
            });

            var brands = new Swiper('.main-brands .swiper-container', {
                slidesPerView: 8,
                spaceBetween: 5,
                breakpoints: {
                    0: {
                        slidesPerView: 2,
                    },
                    400: {
                        slidesPerView: 2,
                    },
                    576: {
                        slidesPerView: 4,
                    },
                    768: {
                        slidesPerView: 5,
                    },
                    992: {
                        slidesPerView: 7,
                    },
                    1200: {
                        slidesPerView: 8
                    },
                },
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 5000
                }
            });



            /*var categoriesProductsW = jQuery('.categoriesTab .tab-pane.active .product-item .product-pic').width();
            jQuery('.categoriesTab .product-item .product-pic').css('height', categoriesProductsW + 'px');*/
            var mainTab = jQuery('.main-product-categories-tab');

            mainTab.each(function (i) {
                var thisEl = jQuery(this);
                var tabChange = function () {
                    var tabs = thisEl.find('.categoriesTabNav .nav-link');
                    var active = tabs.filter('.active');

                    var next;
                    // var next = active.next('a.nav-link').length ? active.next('a.nav-link') :tabs.filter(':first-child');
                    if (active.next('a.nav-link').length) {
                        active.removeClass('active');
                        next = active.next('a.nav-link');
                    } else {
                        active.removeClass('active');
                        next = tabs.filter(':first-child');
                    }

                    var tabsContent = mainTab.find('.categoriesTab .tab-pane');
                    var activeContent = tabsContent.filter('.active');
                    var nextContent = activeContent.next('.tab-pane').length ? activeContent.next('.tab-pane') : tabsContent.filter(':first-child');
                    nextContent.find('img').each(function () {
                        var th = jQuery(this);
                        th.attr('src', th.data('source'));
                    });
                    // remove active class after add this class
                    next.tab().removeClass('active');
                    next.tab('show');
                };

                if (winW > 992) {
                    var tabCycle = setInterval(tabChange, 5000);
                    jQuery('.categoriesTab').hover(function () {
                        window.clearTimeout(tabCycle);
                    }, function () {
                        tabCycle = setInterval(tabChange, 5000);
                    });
                    jQuery(function () {
                        thisEl.find('.categoriesTabNav .nav-link').click(function (e) {
                            console.log(jQuery(this).tab())
                            e.preventDefault();
                            clearInterval(tabCycle);
                            // this line is comment because not used
                            // jQuery(this).tab('show');
                            tabCycle = setInterval(tabChange, 5000)
                        });
                    });
                }
            });

            mainTab.find('.categoriesTabNav .nav-link').on('click', function () {
                var th = jQuery(this);
                var tabID = th.attr('id');
                jQuery('.tab-pane').attr('aria-labelledby', tabID).find('img').each(function () {
                    var th = jQuery(this);
                    th.attr('src', th.data('source'));
                });
            });


            jQuery(window).on("resize", function () {
                var categoriesProductsW = jQuery('.categoriesTab .tab-pane.active .product-item .product-pic').width();
                jQuery('.categoriesTab .product-item .product-pic').css('height', categoriesProductsW + 'px');
            });

            jQuery('img').loadScroll(500);
            jQuery('source').loadScroll(500);

        }
    );
}