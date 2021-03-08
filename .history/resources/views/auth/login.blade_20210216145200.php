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
<section id="bt_bb_section5eef5ada297d3" class="bt_bb_section bt_bb_top_spacing_normal bt_bb_bottom_spacing_large bt_bb_layout_boxed_1200 bt_bb_vertical_align_top">
      <div class="bt_bb_port" style="background-color:white">
            <div class="bt_bb_cell">
                  <div class="bt_bb_cell_inner">
                        <div class="widget-content widget-content-area" dir="rtl">
                              <div class="row">
                                    <div class="col-md-11">
                                          <h4>
                                                دخول الأعضاء
                                          </h4>
                                          <hr style="color:red;border-color:#2cbebc;width:100%">
                                    </div>
                              </div>
                              <form>
                                    <div class="form-group">
                                          <label for="exampleInputEmail1">Email address</label>
                                          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputPassword1">Password</label>
                                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div class="form-check">
                                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                          <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                              </form>
                        </div>
                  </div>
            </div>
      </div>
</section>
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
