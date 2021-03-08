    <nav class="navbar navbar-default navbar-fixed-top top-menu">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">تبديل الملاحه</span>
                    <span class="icon-bar top-bar"></span>
                    <span class="icon-bar middle-bar"></span>
                    <span class="icon-bar bottom-bar"></span>
                </button>
                <a class="navbar-brand sayer_logo" href="HomeSite/index.html"></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('/') }}">الرئيسية</a></li>
                    <li><a href="{{ url('/for-business') }}">حساب جديد</a></li>
                    <li><a href="{{ url('/for-drivers') }}">ماذا يجب أن تعرف</a></li>
                    <li><a href="{{ url('/tracking') }}">تتبع شحنتك</a></li>
                    <li><a href="{{ url('/about-us') }}">من نحن</a></li>
                    <li><a href="{{ url('/contact-us') }}">تواصل معنا</a></li>
                    <li><a href="{{ url('/') }}">تسجيل الدخول</a></li>
                    <li><a href="{{ url('/') }}" id="arabic">English</a></li>
                    <li class="no_border vision-logo">
                        <a href="javascript:void()">
                            <img src="images/arab.png" />
                        </a>
                    </li>
                </ul>
            </div>
        </div><!-- END CONTAINER -->
    </nav>
