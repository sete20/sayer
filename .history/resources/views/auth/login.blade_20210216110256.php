@extends('landing-r.includes.head')

<body class="form">


    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <div class=""></div>
                        <center>
                        <img src="{{asset('images/sayer_logo.png')}}" style="height:120px;width:150px;">
                        </center>


                        <h1 class="text-center" style="color:white">تسجيل الدخول <a href="#"><span class="brand-name"></span></a></h1>
                        @if(session()->get('success'))
               <div class="text-center" style="color:red;font-size:20px">
                    {{ session()->get('success') }}
                 </div>
  @endif
                        <form class="text-left" method="POST" action="{{ route('login.custom') }}">
                        {{ csrf_field() }}
                            <div class="form" >

                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="phone" type="text" style="color:white"  class="form-control @error('phone') is-invalid @enderror" placeholder="رقم الهاتف" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" style="color:white" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="كلمة السر" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block">اظهار كلمة السر </p>
                                        <label class="switch s-primary">
                                            <input type="checkbox" id="toggle-password" class="d-none">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">دخول</button>
                                    </div>

                                </div>

                                <div class="field-wrapper text-center keep-logged-in">
                                    <div class="n-chk new-checkbox checkbox-outline-primary" style="color:white">
                                        <label class="new-control new-checkbox checkbox-outline-primary" style="color:white;">

                                        </label>
                                    </div>
                                </div>

                                <div class="field-wrapper">
                                @if (Route::has('password.request'))
                                    <a href="{{ url('adminpassword/reset') }}" class="forgot-pass-link" style="color:white">نسيت كلمة السر ?</a>
                                    @endif
                                </div>

                            </div>
                        </form>
                        <p class="terms-conditions">© 2020 All Rights Reserved. <a href="@"></a>  <a href="javascript:void(0);"> </a>, <a href="javascript:void(0);">Privacy</a>, and <a href="javascript:void(0);">Terms</a>.</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/authentication/form-1.js')}}"></script>

</body>
</html>
