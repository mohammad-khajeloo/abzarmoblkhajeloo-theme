define('search_filters', ['jquery'], function (jQuery) {

    jQuery.fn.searchFilters = function () {
        this.each(function (index) {
            var thisEl = jQuery(this);
            var searchInput = thisEl.find(".filter-search > input");
            var options = thisEl.find('ul[act="filter-control"] > li');
            var submitButton = thisEl.find('button[act="submit"]');
            var clearButton = thisEl.find('button[act="clear"]')
            var timeout = null;

            clearButton.on("click", function (event) {
                event.preventDefault();
                searchInput.val("");
                searchInput.trigger("change");
                return false;
            });

            searchInput.on("keyup change", function (event) {
                event.preventDefault();
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    if (searchInput.val().length > 0) {
                        submitButton.fadeOut(0);
                        clearButton.fadeIn(0);
                    } else {
                        submitButton.fadeIn(0);
                        clearButton.fadeOut(0);
                    }
                    options.each(function (optionIndex) {
                        var thisOption = jQuery(this);

                        if (thisOption.text().toLowerCase().trim().indexOf(searchInput.val().toLowerCase()) === -1) {
                            thisOption.fadeOut();
                        } else {
                            thisOption.fadeIn();
                        }
                    });
                }, 300);
                return false;
            });
        });
    }
});