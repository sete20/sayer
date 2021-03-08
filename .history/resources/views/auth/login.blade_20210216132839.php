@extends('landing-r.includes.head')
@include('landing-r.includes.nav')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" integrity="sha512-gxWow8Mo6q6pLa1XH/CcH8JyiSDEtiwJV78E+D+QP0EVasFs8wKXq16G8CLD4CJ2SnonHr4Lm/yY2fSI2+cbmw==" crossorigin="anonymous" />
<section class="top-banner-area">
      <div class="container" dir="rtl">
            <div class="row">
                  <div class="col-md-4">
                        <h2 class="banner-title"> </h2>
                  </div><!-- END COL -->
                  <div class="col-md-8">
                        <ol class="breadcrumb ">
                              <li class="active"><a href="index.html">الرئيسية</a></li>
                              <li class="active" dir="rtl">تسجيل الدخول </li>
                        </ol>
                  </div><!-- END COL -->
            </div><!-- END ROW -->
      </div><!-- END CONTAINER -->
</section>
<div class="row">
<h1 class="col-md-2 col-lg-2 col-sm-2"> </h1>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.js" integrity="sha512-s/q7apy90iY/BCy3HnkSxOxqO30Sto5LnhQorz/ce4O/oBxDi1dKluM6C/SYy1AJ9+6MJfXnQl4mHVmrSYfujQ==" crossorigin="anonymous"></script>
<script>
      var input = document.querySelector("#phone");
      window.intlTelInput(input, {
            hiddenInput: "full_number"
            , initialCountry: "ae"
            , separateDialCode: true
            , utilsScript: "{{asset('js/utils.js')}}"
      , });

</script>
