define('mobile_nav', ['jquery'], function (jQuery) {
    var maxMobileWidth = 991.98;
    var mobileClass = 'mobile-nav';

    jQuery.fn.mobileNav = function () {
        this.each(function (index) {
            var thisEl = jQuery(this);
            thisEl.timeoutToggle = null;
            thisEl.timeoutHide = null;

            //checking window size for setting mobile class to nav
            var windowObj = jQuery(window);
            thisEl.checkMobileNav = function (width) {
                if (width > maxMobileWidth) {
                    thisEl.removeClass(mobileClass);
                } else {
                    thisEl.addClass(mobileClass);
                }
            };
            thisEl.checkMobileNav(windowObj.width());
            windowObj.resize(function (event) {
                thisEl.checkMobileNav(windowObj.width());
            });

            if (thisEl.data('toggle')) {
                thisEl.toggleButton = jQuery(thisEl.data('toggle'));
                thisEl.openNavButton = thisEl.toggleButton;
                thisEl.closeNavButton = thisEl.toggleButton;
            } else {
                if (thisEl.data('open') && thisEl.data('close')) {
                    thisEl.openNavButton = jQuery(thisEl.data('open'));
                    thisEl.closeNavButton = jQuery(thisEl.data('close'));
                }
            }

            if (thisEl.openNavButton.length !== 0 && thisEl.closeNavButton.length !== 0) {
                thisEl.openNavButton.on('click', function (event) {
                    event.preventDefault();

                    if (!thisEl.hasClass('open-nav')) {

                        thisEl.addClass('visible');

                        clearTimeout(thisEl.timeoutToggle);
                        thisEl.timeoutToggle = setTimeout(function () {
                            thisEl.openNavButton.addClass('open');
                            thisEl.closeNavButton.addClass('open');
                            thisEl.addClass('open-nav');
                        }, 100);
                    }

                    return false;
                });
                thisEl.closeNavButton.on('click', function (event) {
                    event.preventDefault();

                    if (thisEl.hasClass('open-nav')) {

                        clearTimeout(thisEl.timeoutHide);
                        thisEl.timeoutHide = setTimeout(function () {
                            thisEl.removeClass('visible');
                        }, 500);

                        clearTimeout(thisEl.timeoutToggle);
                        thisEl.timeoutToggle = setTimeout(function () {
                            thisEl.openNavButton.removeClass('open');
                            thisEl.closeNavButton.removeClass('open');
                            thisEl.removeClass('open-nav');
                        }, 100);
                    }

                    return false;
                });
            }
        });
    };
});