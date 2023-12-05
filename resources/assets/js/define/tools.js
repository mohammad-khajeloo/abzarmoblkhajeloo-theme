define('tools', ['jquery', 'underscore'], function (jQuery, _) {

    return {
        dropNonDigits: function (string) {
            var digits = '0123456789۰۱۲۳۴۵۶۷۸۹.';
            var result = '';
            _.each(string, function (item) {
                if (_.indexOf(digits, item) !== -1) {
                    result += item;
                }
            });
            return result;
        },
        convertNumberToPersian: function (string) {
            if (string) {
                var persianDigits = '۰۱۲۳۴۵۶۷۸۹';
                var englishDigits = '0123456789';

                _.each(englishDigits, function (item, index, list) {
                    string = string.split(item).join(persianDigits[index]);
                });
                return string;
            }

        },
        convertNumberToEnglish: function (string) {
            if (string) {
                var persianDigits = '۰۱۲۳۴۵۶۷۸۹';
                var englishDigits = '0123456789';

                _.each(persianDigits, function (item, index, list) {
                    string = string.split(item).join(englishDigits[index]);
                });

                return string;
            }
        },
        formatNumber: function (string) {
            if (string) {
                var length = string.length;
                var temp = length % 3;
                var result = '';

                _.each(string, function (item, index, list) {
                    if (index === temp) {
                        if (index !== 0)
                            result += ',';
                        if (temp + 3 < length)
                            temp += 3;
                    }
                    result += item;
                });
                return result;
            }
        },
        getUrlParameter: function (sParam) {
            let sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;
            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
        },
        calculateDiscount: function (discountGroup, productCount, productPrice) {
            let discount = 0;
            if (discountGroup !== null) {
                discount = discountGroup.value;
                const stepsData = (discountGroup.steps_data !== null && discountGroup.steps_data.length > 0) ? JSON.parse(discountGroup.steps_data) : [];
                stepsData.forEach((iterStep, indexStep) => {
                    if (productCount * productPrice > iterStep.amount && iterStep.value > discount) {
                        discount = iterStep.value;
                    }
                });
            }
            return discount;
        }

    };


});