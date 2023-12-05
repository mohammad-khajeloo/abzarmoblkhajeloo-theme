define('page_direction', ['jquery'], function (jQuery) {
    var body = jQuery('body');

    return {
        get : function () {
            return body.data('direction') || this.types.RTL;
        },
        set : function (pageDirection) {
            body.data('direction', pageDirection);
        },
        types : {
            LTR : 'lrt',
            RTL : 'rtl'
        }
    }
});