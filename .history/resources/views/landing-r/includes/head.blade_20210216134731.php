<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="img/favicon.html">

    <!-- SITE TITLE -->
    <title>ساير</title>
    <!-- Bootstrap min CSS -->
    <link href="Content/vendor/bootstrap.min.css" rel="stylesheet">

    <!-- rtl classes -->
    <link href="Content/vendor/bootstrap-rtl.min.css" rel="stylesheet" title="rtlcss">

    <!-- Animate CSS -->
    <link href="Content/vendor/animate.css" rel="stylesheet">
    <!-- Icofont CSS -->
    <link href="Content/vendor/icofont.css" rel="stylesheet">
    <!-- Owl Carouse CSS -->
    <link href="Content/vendor/owl.carousel.css" rel="stylesheet">
    <!-- Magnific Popup CSS -->
    <link href="Content/vendor/magnific-popup.css" rel="stylesheet">
    <!-- Style CSS -->
    <link href="Content/style.css" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="Content/responsive.css" rel="stylesheet">
    <!-- custom CSS -->
    <link href="Content/custom.css" rel="stylesheet">

    <!-- "rtl classes" -->
    <link href="Content/custom-rtl.css" rel="stylesheet" title="rtlcss">

    <!-- "jQuery necessary for Bootstrap's JavaScript plugins" -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="appconfig.html"></script>
    <!-- Bootstrap JS -->
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- Jquery Counterup JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery.counterup@2.1.0/jquery.counterup.js"></script>
    <!-- Waypoints JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js" integrity="sha512-ZKNVEa7gi0Dz4Rq9jXcySgcPiK+5f01CqW+ZoKLLKr9VMXuCsw3RjWiv8ZpIOa0hxO79np7Ec8DDWALM0bDOaQ==" crossorigin="anonymous"></script>">
    <!-- jquery.magnific-popup JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous"></script>">
    <!-- Parsley JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.1/parsley.min.js"></script>
    <!-- Jquery Particleground JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.3/particles.js" integrity="sha512-BgV3bZfMmUklIZI+dP0SILdmQ0RBY2gxegFFyfgo4Ui56WhKF4Pny9LsV/l96jxDDA+2w47zAXA4IyHo2UT/Qg==" crossorigin="anonymous"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/custom.js') }}"></script>


            <!-- rtl classes -->
            <link href="Content/vendor/bootstrap-rtl/bootstrap-rtl.css" rel="stylesheet" />
            <link href="Content/vendor/bootstrap-rtl/custom-bootstrap-rtl.css" rel="stylesheet" />
            <link href="Content/custom-rtl.css" rel="stylesheet" />
            <!-- Responsive CSS -->
            <link href="Content/responsive.css" rel="stylesheet">
            <script type="text/javascript">
                $('html').attr('dir', 'rtl');
                //  $('.nav.navbar-nav').addClass('navbar-right')
                $(document).ready(function () {


                    $('.nav.navbar-nav').removeClass('navbar-right')
                    $('body').css('font-family', 'Segoe UI')
                    $('p').css('font-family', 'Segoe UI')

                });
            </script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('.slide-btn-white, .slide-btn-bordered, .default-button').on('click', function (e) {
                var anchor = $(this);
                $('html, body').stop().animate({
                    scrollTop: $(anchor.attr('href')).offset().top - 30
                }, 1500);
                e.preventDefault();
            });


            $(function () {
                var $rtl_boostrap = $('link[href="<link
  rel="stylesheet"
  href="https://cdn.rtlcss.com/bootstrap/v4.3.1/css/bootstrap.min.css"
  integrity="sha384-LobEUEN+vN9RjeqoGV210e9rydU8P3KMTgX9FKxalf0zavDGgINz6K+iXoTLpNFA"
  crossorigin="anonymous" />"]');
                var $rtl_custom = $('link[href="/Content/custom-rtl.css"]');
                toggle = true;

                $('link[title=rtlcss]')[0].disabled = true;
                $('link[title=rtlcss]')[1].disabled = true;

                $('#arabic').click(function () {
                    if (toggle) {
                        $rtl_boostrap.removeAttr('disabled');
                        $rtl_custom.removeAttr('disabled');
                        $('html').attr('dir', 'rtl');
                    } else {
                        $rtl_boostrap.attr('disabled', 'disabled');
                        $rtl_custom.attr('disabled', 'disabled');
                        $('html').attr('dir', 'ltr');
                    }
                    toggle = !toggle;
                });
            });
        });

        // detect visitor country
        $(function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(getLocation);
            } else {
                //$('#loc').html('Geolocation is not supported by your browser.');
            }

            function getLocation(loc) {
                var latitude = loc.coords.latitude;
                var longitude = loc.coords.longitude;
                $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?latlng=" + latitude + "," + longitude, function (data) {
                    data.results.reverse();
                    // alert(data.results[0].formatted_address);
                });
            }
        });
    </script>
</head>
