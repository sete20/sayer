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
                                          <h4 class="p-2 d-flex "style="margin-right:50px;">
                                                دخول الأعضاء
                                          </h4>
                                          <hr style="color:red;border-color:#2cbebc;width:100%">
                                    </div>
                              </div>
                            <div class="p-2 row d-flex">
                                                            <div class=" col" >
                                                            <div class="form-group d-block" style="margin-right:50px;">
                                                            <label> رقم الهاتف</label>
                                                            <br>
                                                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus dir="ltr">
                                                            @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                             </div>
                                                            </div>
                                                            <div class="col">
                                                            <div class="form-group d-block" style=" margin-right:50px; width:250;">
                                                            <label  style="margin-right:10px;">كلمة السر</label>
                                                            <input style=" ;"id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="كلمة السر" autocomplete="current-password">
                                                            @error('password')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                            </div>
                                                    </div>
                                                      <div class="col">
                                                            <div class="form-group d-block" style=" margin-right:50px; width:250;">
                                                            </div>
                                                            </div>

                            </div>
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
