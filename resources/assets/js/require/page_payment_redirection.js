if (window.currentPage === "payment-redirection") {
    require(['jquery'], function (jQuery) {
        var mainForm = jQuery("form#redirection-form");
        mainForm.actionAttr = mainForm.attr('action');
        setTimeout(function () {
            if (typeof mainForm.actionAttr !== "undefined" &&
                mainForm.actionAttr != null &&
                mainForm.actionAttr.length > 0) {
                mainForm.submit();
            }
            else {
                var successMessage = jQuery("p#success-message");
                var dangerMessage = jQuery("p#danger-message");
                if(dangerMessage.length > 0 && successMessage.length > 0){
                    successMessage.fadeOut(0);
                    dangerMessage.fadeIn(0);
                }
            }
        }, 1000);
    });
}