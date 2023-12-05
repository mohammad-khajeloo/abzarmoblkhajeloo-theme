if (window.currentPage === "about") {
    require(['jquery'],
        function (jQuery) {

            var videoWrapper = jQuery('.about-top-video');
            var btn = videoWrapper.find('.sound-btn');
            var video = videoWrapper.find('video');
            btn.on('click', function () {
                if (video.prop('muted')) {
                    video.prop('muted' , false);
                    btn.find('i').removeClass('fa-volume-off').addClass('fa-volume-up');
                } else {
                    video.prop('muted' , true);
                    btn.find('i').removeClass('fa-volume-up').addClass('fa-volume-off');
                }
            });

        }
    );
}