define('article_box', ['jquery'], function (jQuery) {
    jQuery.fn.reformArticle = function (selector, ratio, parentExtraHeight) {
        var thisEl = jQuery(this);
        var contentEl = thisEl.find(selector);
        if (contentEl.length !== 0) {
            var contentWith = contentEl.width();
            var contentHeight = contentWith * ratio.y / ratio.x;
            contentEl.css({
                height: contentHeight + 'px'
            });
            thisEl.css({
                height: (contentHeight + parentExtraHeight) + 'px'
            });
        }

    };

    jQuery.fn.articleBox = function (selector, ratio, parentExtraHeight) {
        this.each(function (index) {
            var thisEl = jQuery(this);
            thisEl.reformArticle(selector, ratio, parentExtraHeight);

            jQuery(window).load(function (event) {
                thisEl.reformArticle(selector, ratio, parentExtraHeight);
            });

            jQuery(window).resize(function (event) {
                thisEl.reformArticle(selector, ratio, parentExtraHeight);
            });
        });
    };
});