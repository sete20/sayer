<!doctype html>
<html lang="en">

<head>
    <title>Events | Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Lucid Bootstrap 4x Admin Template">
    <meta name="author" content="WrapTheme, design by: ThemeMakker.com">

    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/vendor/font-awesome/css/font-awesome.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/css/main.css">
    <link rel="stylesheet" href="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/css/color_skins.css">
</head>

<body class="theme-cyan">
<!-- WRAPPER -->
<div id="wrapper">
    <div class="vertical-align-wrap">
        <div class="vertical-align-middle auth-main" style="background: url({{ url('dashboard') }}/assets-ltr/images/auth_bg.jpg)">
            <div class="auth-box">
                <div class="top">
{{--                    <img src="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/images/logo-white.svg" alt="Lucid">--}}
                </div>
                <div class="card">
                    <div class="header">
                        <p class="lead">Login to your account</p>
                    </div>
                    <div class="body">
                        <form class="form-auth-small" action="{{ route('dashboard.login.post') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="signin-email" class="control-label sr-only">Email</label>
                                <input type="email" class="form-control" name="email" id="signin-email" value="" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="signin-password" class="control-label sr-only">Password</label>
                                <input type="password" class="form-control" name="password" id="signin-password" value="" placeholder="Password">
                            </div>
                            <div class="form-group clearfix">
                                <label class="fancy-checkbox element-left">
                                    <input name="remember_me" type="checkbox">
                                    <span>Remember me</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                            <div class="bottom">
                                <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="">Forgot password?</a></span>
                                <span>Don't have an account? <a href="">Register</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END WRAPPER -->
</body>
</html>
