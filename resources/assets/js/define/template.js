define('template', ['jquery', 'underscore'], function (jQuery, _) {
    return {
        filterOptionTag: _.template(jQuery('#template-filter-option-tag').html()),
        productBox: _.template(jQuery('#template-product-box').html()),
        formInputMessage: _.template(jQuery('#template-form-input-message').html()),
        formInput: _.template(jQuery('#template-form-input').html()),
        virtualForm: _.template(jQuery('#template-virtual-form-template').html()),
        ratingStartsContainer: _.template(jQuery('#template-rating-stars-container').html()),
        ratingStarEmpty: _.template(jQuery('#template-rating-star-empty').html()),
        ratingStarFilled: _.template(jQuery('#template-rating-star-filled').html()),
        ratingStarHalf: _.template(jQuery('#template-rating-star-half').html()),
        searchResultProductBox: _.template(jQuery('#template-search-result-product-box').html()),
        searchResultDirectoryBox: _.template(jQuery('#template-search-result-directory-box').html()),
        cartTable: _.template(jQuery('#template-cart-table').html()),
        cartActions: _.template(jQuery('#template-cart-actions').html()),
        localCartTypeLimitError: _.template(jQuery('#local-cart-type-limit-error').html()),
        printableInvoiceRow: _.template(jQuery('#printable-invoice-row').html())
    }
});