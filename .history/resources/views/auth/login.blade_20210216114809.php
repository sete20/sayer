@extends('landing-r.includes.head')
@include('landing-r.includes.nav')
<link rel="stylesheet" href="{{asset('css/intlTelInput.css')}}">
<link rel="stylesheet" href="{{asset('css/demo.css')}}">
<script src="{{asset('js/intlTelInput.js')}}"></script>
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
                              <div class="row">
                                    <div class="col-md-10">

                                          @if ($errors->any())
                                          <div class="alert alert-danger">
                                                <ul>
                                                      @foreach ($errors->all() as $error)
                                                      <li>{{ $error }}</li>
                                                      @endforeach
                                                </ul>
                                          </div><br />
                                          @endif
                                          @if(session()->get('success'))
                                          <div class="alert alert-danger">
                                                {{ session()->get('success') }}
                                          </div>
                                          @endif
                                    </div>
                              </div>
                              <form class="text-left" method="POST" action="{{ url('userlogin') }}">
                                    @csrf
                                    <div class="form">
                                          <div class="row">
                                                <div class="col-md-5">
                                                      <div id="username-field" class="field-wrapper input subscribe-form">
                                                            <label> رقم الهاتف</label>
                                                            <input id="phone" type="text" class="phone form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus dir="ltr">
                                                            @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-md-5">
                                                      <div id="password-field" class="field-wrapper input mb-2 subscribe-form">
                                                            <label>كلمة السر</label>
                                                            <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="كلمة السر" autocomplete="current-password">
                                                            @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                      </div>
                                                </div>
                                          </div>
                                          </br></br>
                                          <div class="row">
                                                <div class="col-md-5">
                                                      <div class="password-field">
                                                            <div class="form-group subscribe-form">
                                                                  <button type="submit" class="btn btn-primary" style="background-color:#2cbebc;color:#000" value="">تسجيل الدخول</button>
                                                            </div>
                                                            <p> </p>
                                                            <div class="form-group subscribe-form">
                                                                  @if (Route::has('password.request'))
                                                                  <a href="{{ url('userpassword/reset') }}" class="forgot-pass-link">نسيت كلمة السر ؟</a>
                                                                  @endif
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                              </form>
                        </div>
                  </div>

            </div>

      </div>

      </div>
      </div>
      </div>
</section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.js" integrity="sha512-s/q7apy90iY/BCy3HnkSxOxqO30Sto5LnhQorz/ce4O/oBxDi1dKluM6C/SYy1AJ9+6MJfXnQl4mHVmrSYfujQ==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
        var consignee_phone = document.querySelector(".phone");
    window.intlTelInput(consignee_phone, {
        hiddenInput: "consignee_phone",
        initialCountry: "ae",
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
    window.intlTelInput(consignee_telephone, {
        hiddenInput: "consignee_telephone",
        initialCountry: "ae",
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
</script>
