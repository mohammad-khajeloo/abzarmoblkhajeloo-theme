if (window.currentPage === "suppliers") {
    require(['jquery'],
        function ($) {
            $("input[name=supplier]").on('change', function () {
                console.log($(this).val());
                $('.suppliers-form').find('div.form-person-content').remove();
                if ($(this).val() === 'شخص حقیقی') {
                    $('.form-person-content').removeClass('d-none');
                    $('.form-legal-content').addClass('d-none');
                } else {
                    $('.form-legal-content').removeClass('d-none');
                    $('.form-person-content').addClass('d-none');
                }
            })
        }
    );
}