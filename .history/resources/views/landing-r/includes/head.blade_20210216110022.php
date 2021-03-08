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

    <!-- rtl classes -->
    <link href="Content/custom-rtl.css" rel="stylesheet" title="rtlcss">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src={{asset("js/vendor/jquery-1.12.4.min.js")}}></script>
    <script src="appconfig.html"></script>
    <!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Owl Carousel JS -->
    <script src="{{asset('js/vendor/owl.carousel.min.js')}}"></script>
    <!-- Jquery Counterup JS -->
    <script src={{asset("js/vendor/jquery.counterup.min.js")}}></script>
    <!-- Waypoints JS -->
    <script src={{asset("js/vendor/waypoints.min.js")}}></script>
    <!-- jquery.magnific-popup JS -->
    <script src={{asset("js/vendor/jquery.magnific-popup.min.js")}}></script>
    <!-- Parsley JS -->
    <script src={{asset("js/vendor/parsley.min.js")}}></script>
    <!-- Jquery Particleground JS -->
    <script src="{{asset("js/vendor/jquery.particleground.min.js")}}"></script>
    <!-- Custom JS -->
    <script src="{{asset('js/custom.js')}}"></script>


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
                var $rtl_boostrap = $('link[href="/Content/vendor/bootstrap-rtl.min.css"]');
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
