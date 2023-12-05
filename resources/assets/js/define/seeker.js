define('seeker', ['jquery', 'underscore', 'nouislider'], function (jQuery, _, noUiSlider) {

    jQuery.fn.rangeSeeker = function (options, eventListeners) {
        this.each(function (index) {
            var thisPureEl = this;

            noUiSlider.create(thisPureEl, options);

            _.each(eventListeners, function (eventListener) {
                thisPureEl.noUiSlider.on(eventListener.eventName, eventListener.eventCallback);
            });
        });

        this.bind('seeker:set', function (event, data) {
            this.noUiSlider.set(data);
        });
    }
});