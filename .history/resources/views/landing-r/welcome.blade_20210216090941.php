
<!DOCTYPE html>
<html lang="en">

<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
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
    <script src={{("vendor/bootstrap.min.js")}}></script>
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

<body data-spy="scroll" data-offset="70">
    <!-- START PRELOADER -->

    <!-- END PRELOADER -->
    <!-- START NAVBAR -->
    @include('landing-r.nav')
    <!-- END NAVBAR -->





<!-- START HOMEPAGE SLIDER -->
<div id="home" class="hompage-slides-wrapper gradient-bg angle-slides-wrapper-bg">
    <div class="homepage-slides">
        <div class="single-slider-item">
            <div class="slide-item-table">
                <div class="slide-item-tablecell">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-8 col-md-8">
                                <h1>شركة الشحن والتوصيل التي تأمنها على بضاعتك</h1>

                            </div><!-- END COL -->

                            <div class="col-sm-4 col-md-4">
                                <div class="welcome-phone">
                                    <img src="images/img_home_banner.png" alt="App mockup Image">
                                </div>
                            </div><!-- END COL -->
                        </div><!-- END ROW -->
                    </div><!-- END CONTAINER -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END HOMEPAGE SLIDER -->
<!-- START APP ABOUT SECTION -->
<section id="about" class="app-about-section angle-sp">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title angle-section-title">
                    <h2>عن تطبيق ساير</h2>
                    <h4 class="about_section_subtitle">تبحث عن خدمة البريد السريع المحلي الموثوق في الامارات العربية المتحدة.</h4>
                </div>
            </div><!-- END COL -->
        </div><!-- END ROW -->

        <div class="row">
            <div class="col-md-7">
                <div class="app-about-text">
                    <p>نحن في مهمة لجعل الشحن تجربة ممتعة للأفراد والشركات.</p>
                    <p>
                        تعمل ساير على إحداث ثورة في عالم الشحن والتسليم في الامارات العربية المتحدة باستخدام أحدث التقنيات. إرسال واستقبال الطرود لم يكن بهذه السهولة من قبل.
                    </p>

                    <ul>
                        <li style="font-family:'Segoe UI'"><i class="icofont icofont-verification-check"></i>تحميل</li>
                        <li style="font-family:'Segoe UI'"><i class="icofont icofont-verification-check"></i>تحديد الوقت</li>
                        <li style="font-family:'Segoe UI'"><i class="icofont icofont-verification-check"></i>توصيل</li>
                    </ul>

                    <a href="#app-download" class="default-button">
                        <center>
                            <i class="icofont icofont-download-alt"></i>
                            حمل الان. <br />
                                                                       <span style="font-size:8pt;color:black;">قريبا.</span>
                        </center>
                    </a>
                </div>
            </div><!-- END COL -->

            <div class="col-md-5">
                <div class="text-center">
                    <img src="images/new.png" alt="App Mockup">
                </div>
            </div><!-- END COL -->
        </div><!-- END ROW -->
    </div><!-- END CONTAINER -->
</section>
<!-- END APP ABOUT SECTION -->
<!-- START HOW IT WORKS SECTION -->
<section id="how-it-works" class="how-it-works angle-gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>كيف تعمل؟</h2>
                    <p>نحن في مهمة لتوفير وقتك وتيسير حياتك. أخبرنا بما تحتاج إلى تسليمه ، ومكان الاستلام من وإلى أين. ونحن سنهتم بالباقي.</p>
                </div>
            </div><!-- END COL -->
        </div><!-- END ROW -->

        <div class="row">
            <div class="col-md-6">
                <div class="hiw-feature-content">
                    <div class="single-hiw-feature">
                        <i class="icofont icofont-download-alt"></i>
                        <h4>قم بتنزيل التطبيق أو التسجيل عبر الإنترنت</h4>
                        <p> تطبيقنا متاح لأجهزة Android و iOS. قم بتنزيل تطبيق ساير للشحن وقم بإنشاء حساب حتى لا تضطر إلى ملء معلوماتك في كل مرة تصدر فيها طلبًا.</p>
                    </div>

                    <div class="single-hiw-feature">
                        <i class="icofont icofont-social-google-map"></i>
                        <h4>تعيين الالتقاط والتسليم الموقع والوقت</h4>
                        <p>بعد أن تختار ما إذا كنت تريد إرسال حزمة أو إحضارها ، استخدم GPS لإعلامنا بمكان التقاط الصور والتسليمات ، ثم اختر فترة زمنية لكل منها. </p>
                    </div>

                    <div class="single-hiw-feature">
                        <i class="icofont icofont-fast-delivery"></i>
                        <h4>ترك التعليقات للسائق</h4>
                        <p>
                            هل لديك طلب خاص من السائق؟ يمكنك ترك ملاحظاتهم ، مزيد من التفاصيل حول الموقع ، إذا كنت تريد منهم ترك الحزمة في مكتب الاستقبال ... إلخ
                        </p>
                    </div>

                    <div class="single-hiw-feature">
                        <i class="icofont icofont-map-pins"></i>
                        <h4>تأكيد وتتبع طلبك</h4>
                        <p>
                            عندما تنتهي ، ستحصل على تفاصيل طلبك لتأكيد الحجز. بمجرد تأكيد الطلب ، يمكنك تتبع ذلك في الوقت الحقيقي.
                        </p>
                    </div>
                </div>
            </div><!-- END COL -->


        </div><!-- END ROW -->
    </div><!-- END CONTAINER -->
</section>
<!-- END HOW IT WORKS SECTION -->
<!-- START sayer Now SECTION -->
<section id="about" class="app-about-section angle-sp pt100">
    <div class="container">

        <div class="row">
            <div class="col-md-7">
                <div class="app-about-text third_section_text">
                    <img src="images/logo.png" class="app-about_logo" />
                    <h3>نقدم لكم خدمه توصيل ساير الان</h3>
                    <p>
                        قل مرحباً بأحدث وأروع خدمة لدينا: الآن. سنلتقط الحزمة الخاصة بك في أقل من 45 دقيقة ونقدمها في أي مكان على الفور! سواء كان ذلك في الطعام أو المستندات أو الهدايا أو المفاتيح ... إلخ. سمها ما شئت ، سنعتني بها. كل ما عليك فعله هو اختيار خيار &quot;NOW&quot; ، وسيكون أقرب سائق لموقع الالتقاط في أسرع وقت ممكن للحصول على الحزمة وتسليمها ؛ لا توقف. إنها أسرع خدمة بريد سريع وهي ليست سوى بضع نقرات!
                    </p>
                </div>
            </div><!-- END COL -->

            <div class="col-md-5">
                <div class="text-center">
                    <img src="images/img_section1.png" alt="" class="now_section_img">
                </div>
            </div><!-- END COL -->
        </div><!-- END ROW -->
    </div><!-- END CONTAINER -->
</section>


<!-- END sayer Now SECTION -->
<!-- START APP DOWNLOAD SECTION -->
<section id="app-download" class="app-download-section angle-download-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>حمل البرنامج</h2>
                    <h4>قادم قريبا</h4>

                </div>
            </div><!-- END COL -->
        </div><!-- END ROW -->

        <div class="row">
            <div class="col-md-12">
                <div class="app-download-content">
                    <!-- START APP STORE -->
                    <a href="#" class="download-btn">
                        <i class="icofont icofont-brand-apple"></i>
                        <span>
                            متاح على
                            <span class="large-text">متجر التطبيقات</span>
                        </span>
                    </a>
                    <!-- END APP STORE -->
                    <!-- START PLAY STORE -->
                    <a href="#" class="download-btn">
                        <i class="icofont icofont-brand-android-robot"></i>
                        <span>
                            متاح على
                            <span class="large-text">متجر التطبيقات</span>
                        </span>
                    </a>
                    <!-- END PLAY STORE -->
                </div>
            </div><!-- END COL -->
        </div><!-- END ROW -->
    </div><!-- END CONTAINER -->
</section>
<!-- END APP DOWNLOAD SECTION -->
<!-- START BLOG SECTION -->
<section id="blog" class="blog-section angle-sp">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>أفضل خدمة التوصيل والتوصيل في الامارات العربية المتحدة</h2>
                    <p>نحن نؤمن أفضل الخدمات في المنطقة.</p>
                </div>
            </div><!-- END COL -->
        </div><!-- END ROW -->

    </div><!-- END CONTAINER -->
</section>
<!-- END BLOG SECTION -->



    <!-- START FOOTER AREA -->
        @include('landing-r.includes.footer')
    <!-- END FOOTER AREA -->

</body>

<!-- Mirrored from www.ساير للشحن.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 05 Jul 2020 19:54:43 GMT -->
</html>


