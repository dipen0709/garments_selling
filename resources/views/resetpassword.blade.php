<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{config('constants.SITE_NAME')}} | {{$title}}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/public/img/favicon.png') }}" />
                <link rel="icon" type="image/x-icon" href="{{ asset('/public/img/favicon.png') }}" />
		<link rel="stylesheet" href="{{ asset('/public/css/style.css') }}">
		<link rel="stylesheet" href="{{ asset('/public/css/font-awesome.css') }}">
                 <link rel="stylesheet" href="{{ asset('/public/css/toaster.css') }}" type="text/css" />
		<script src="{{ asset('/public/js/jquery-3.3.1.min.js') }}"></script>
		<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                <script type="text/javascript">
                    var langauge_var = {!! json_encode(trans('javascript')); !!};        </script>
    </head>
<body>
<?php //echo Libraries::_getSessionMsg();?>
<header>
	<div class="header-w3l">
		<a href="{{URL::to('/').'/'}}">
			<img src="{{ asset('/public/img/logo.png') }}" />
		</a>		
	</div>
</header>
<div class="main-content-agile">
	<div class="sub-main-w3">
                @if (isset($error_message))
                <h4 style="text-align: center; color: red;">{{ $error_message }}</h4>
                @elseif (isset($message))
                <h4 style="text-align: center; color: green;">{{ $message }}</h4>
                @elseif(isset($validate))
		<h2>Congratulation!</h2>
		<p>Your account has been validated successfully.</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<h4>Thank You</h4>
                @elseif(isset($resetpassword))
		<h2>Reset Password</h2>
		<form action="{{route('updatepassword')}}" method="post" id="resetpassword">
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="token" id="token" value="{{ $data->user_rp_token }}">
                        <div class="pom-agile" style="margin-bottom: 15px;">
				<span class="fa fa-key" aria-hidden="true"></span>
				<input placeholder="New Password" id="password" name="password" class="pass" type="password" required="">
			</div>
			<div class="pom-agile">
				<span class="fa fa-key" aria-hidden="true"></span>
				<input placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" class="pass" type="password" required="">
			</div>
			<div class="right-w3l" style="margin-top: 15px;">
				<input type="submit" value="Submit">
			</div>
		</form>
                @endif
	</div>
</div>
<footer>
	<div class="footer">
		<p>&copy; {{date('Y')}} Pocket Nest. All rights reserved </p>
	</div>
</footer>
     <script src="{{ asset('/public/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('/public/js/additional-methods.js') }}"></script>
        <script src="{{ asset('/public/js/toaster.js') }}"></script>
        <script src="{{ asset('/public/js/common.js') }}"></script>
</body>
</html>