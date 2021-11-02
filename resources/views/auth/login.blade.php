<!doctype html>
<html lang="en">

<head>
<title>Madienty DashBoard</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Mplify Bootstrap 4.1.1 Admin Template">
<meta name="author" content="ThemeMakker, design by: ThemeMakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/animate-css/animate.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/color_skins.css')}}">
</head>

<body class="theme-blue rtl">
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle auth-main">
				<div class="auth-box">
                    <div class="mobile-logo"><a href="index"><img src="{{asset('assets/images/logo-icon.png')}}" alt="Madienty"></a></div>
                    <div class="auth-left">
                        <div class="left-top">
                            <a href="index.html">
                                <img src="{{asset('uploads/Logo.png')}}" alt="Madienty" style="margin-top: -13px;">
                                <span>مدينتى</span>
                            </a>
                        </div>
                        <div class="left-slider">
                            <img src="{{asset('assets/images/login/1.jpg')}}" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="auth-right">

                        <div class="card">
                            <div class="header">
                                <p class="lead">تسجيل لدخول</p>
                            </div>
                            <div class="body">
                                <form class="form-auth-small" method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}

                                        <div class="text-danger">{{session('msg')}}</div>
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="signin-email" class="control-label sr-only">Email</label>
                                        <input type="email" class="form-control" id="signin-email" name="email" value="" placeholder="email address">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="signin-password" class="control-label sr-only">Password</label>
                                        <input type="password" class="form-control" id="signin-password" name="password" value="" placeholder="Password">
                                    </div>
                                   <!-- <div class="form-group clearfix">
                                        <label class="fancy-checkbox element-left">
                                            <input type="checkbox">
                                            <span>Remember me</span>
                                        </label>
                                    </div>-->
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">تسجيل الدخول</button>
                                    <!--<div class="bottom">
                                        <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="page-forgot-password.html">Forgot password?</a></span>
                                        <span>Don't have an account? <a href="page-register.html">Register</a></span>
                                    </div>-->
                                </form>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>
</html>







