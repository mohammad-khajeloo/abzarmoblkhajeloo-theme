define('rating_service', ['jquery', 'template', 'bootstrap'], function (jQuery, template) {
    jQuery.fn.ratingModule = function () {
        this.each(function (index) {
            var ratingContainer = jQuery(this);
            var rateValue = ratingContainer.data('rate');
            var rateIntValue = parseInt(rateValue);
            var ratingModal = jQuery("#rating-modal");

            var starsContainer = jQuery(template.ratingStartsContainer({
                "rateValue": rateValue
            }));
            var starElements = [];

            for (var i = 0; i < 5; i++) {
                var star = null;
                if (i < rateIntValue) {
                    star = jQuery(template.ratingStarFilled({}));
                } else {
                    if (i === rateIntValue && (rateValue - rateIntValue) !== 0) {
                        star = jQuery(template.ratingStarHalf({}));
                    } else {
                        star = jQuery(template.ratingStarEmpty({}));
                    }
                }
                starElements.push(star);
                starsContainer.append(star);
            }

            if (ratingContainer.data('active') && ratingContainer.data('active') === "on" &&
                ratingContainer.data('action') && ratingContainer.data('action').length > 0) {
                _.each(starElements, function (starElement, index) {
                    starElement.on('click', function (event) {
                        event.preventDefault();
                        event.stopPropagation();

                        var ratingModalDisplay = ratingModal.find('.rating-content');
                        if (ratingModalDisplay.length > 0) {
                            ratingModalDisplay.data('rate', (index + 1).toString());
                            ratingModalDisplay.ratingModule();
                        }

                        var ratingForm = ratingModal.find('form');
                        if(ratingForm.length > 0){
                            ratingForm.attr('action', ratingContainer.data('action'));
                        }

                        ratingModal.modal('show');

                        return false;
                    }).hover(function () {
                        for (var i = 0; i <= index; i++) {
                            starElements[i].addClass('selected');
                        }
                    }, function () {
                        for (var i = 0; i <= index; i++) {
                            starElements[i].removeClass('selected');
                        }
                    });
                });
            }

            ratingContainer.html(starsContainer);
        })
    }
});