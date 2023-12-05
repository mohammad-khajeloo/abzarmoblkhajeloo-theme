require.config({
    paths: {
        jquery: '/HCMS-assets/js/lib/jquery',
        jq_cookie: '/HCMS-assets/js/lib/jquery.cookie',
        bootstrap: '/HCMS-assets/js/lib/bootstrap.min',
        underscore: '/HCMS-assets/js/lib/underscore-min',
        swiper: '/HCMS-assets/js/lib/swiper.min',
        loadScroll: '/HCMS-assets/js/lib/jQuery.loadScroll',
        nouislider: '/HCMS-assets/js/lib/nouislider.min',
        hashchange: '/HCMS-assets/js/lib/jquery.ba-hashchange.min',
        jquery_browser: '/HCMS-assets/js/lib/jquery.browser.min',
        pace: '/HCMS-assets/js/lib/pace.min',
        toast : '/HCMS-assets/js/lib/jquery.toast.min',
    },
    shim: {
        "bootstrap": {
            deps: ["jquery"]
        },
        "toast": {
            deps: ["jquery"]
        },
        "swiper": {
            deps: ["jquery"]
        },
        "hashchange": {
            deps: ["jquery", "jquery_browser"]
        },
        "cookie": {
            deps: ['jquery']
        },
        "loadScroll":{
            deps:['jquery']
        }
    }
});