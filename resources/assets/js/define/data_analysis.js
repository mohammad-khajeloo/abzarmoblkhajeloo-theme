define('data_analysis', ['jquery', 'jq_cookie'],
    function (jQuery, cookie) {
        var DataAnalysisService = null;
        var HDAIdKey = "hda_id";
        var HDABaseUrl = window.siteEnv.SITE_ANALYSIS_URL;

        DataAnalysisService = {
            HDAId: null,
            initActivation: function() {
                window.hc_modules.data_analysis = {
                    enabled: false
                };
                if (typeof window.siteEnv !== "undefined" &&
                    typeof window.siteEnv.SITE_ANALYSIS !== "undefined" &&
                    window.siteEnv.SITE_ANALYSIS === true) {
                    window.hc_modules.data_analysis.enabled = true;
                }
            },
            isEnabled: function() {
                return window.hc_modules.data_analysis.enabled;
            },
            initHDAId: function() {
                DataAnalysisService.HDAId = jQuery.cookie(HDAIdKey);
            },
            updateHDAIdCookie: function(content) {
                var date = new Date();
                date.setTime(date.getTime() + (30 * 60 * 1000));
                jQuery.cookie(HDAIdKey, content, {expires: date});
            },
            init: function () {
                DataAnalysisService.initActivation();
                if (!DataAnalysisService.isEnabled())
                    return;
                DataAnalysisService.initHDAId();
                if (DataAnalysisService.HDAId === undefined)
                    DataAnalysisService.registerCustomer();
                else {
                    DataAnalysisService.updateHDAIdCookie(DataAnalysisService.HDAId);
                    DataAnalysisService.addFootprint();
                }
            },
            registerCustomer: function () {
                if (!DataAnalysisService.isEnabled())
                    return;
                jQuery.ajax({
                    type: "POST",
                    url: HDABaseUrl + "/customer/"
                }).done(function (response) {
                    DataAnalysisService.HDAId = response.id;
                    DataAnalysisService.updateHDAIdCookie(response.id);
                    DataAnalysisService.addFootprint();
                });
            },
            //TODO: call updateCustomer method on user login
            updateCustomer: function (user_id) {
                if (!DataAnalysisService.isEnabled())
                    return;
                jQuery.ajax({
                    type: "PUT",
                    url: HDABaseUrl + "/customer/" + DataAnalysisService.HDAId,
                    contentType: 'application/json',
                    data: JSON.stringify({
                        kt_id: user_id
                    }),
                });
            },
            addSearchQuery: function (term) {
                if (!DataAnalysisService.isEnabled())
                    return;
                jQuery.ajax({
                    type: "POST",
                    url: HDABaseUrl + "/search-query/",
                    contentType: 'application/json',
                    data: JSON.stringify({
                        customer: DataAnalysisService.HDAId,
                        term: term
                    }),
                });
            },
            addFootprint: function () {
                if (!DataAnalysisService.isEnabled())
                    return;
                jQuery.ajax({
                    type: "POST",
                    url: HDABaseUrl + "/footprint/",
                    contentType: 'application/json',
                    data: JSON.stringify({
                        customer: DataAnalysisService.HDAId,
                        href: window.location.href,
                        referrer: document.referrer
                    }),
                });
            },
        };

        DataAnalysisService.init();

        return DataAnalysisService;
    }
);