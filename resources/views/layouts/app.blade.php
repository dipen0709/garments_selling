<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{config('constants.SITE_NAME')}} | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('/public/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('/public/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('/public/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('/public/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('/public/css/_all-skins.min.css') }}">
        <!-- Date Picker -->
        <link rel="stylesheet" href="{{ asset('/public/css/bootstrap-datepicker.min.css') }}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('/public/css/daterangepicker.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="{{ asset('/public/css/toaster.css') }}" type="text/css" />
        <script type="text/javascript">
            var base_url = "{{URL::to('/').'/'}}";
                    var langauge_var = {!! json_encode(trans('javascript')); !!};        </script>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">

        <div class="wrapper">
            <!--Navbar-->

            @yield('content')

            <div class="control-sidebar-bg"></div>
        </div>

        <script src="{{ asset('/public/js/common.js') }}"></script>
        <script src="{{ asset('/public/js/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('/public/js/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
                    $.widget.bridge('uibutton', $.ui.button);</script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('/public/js/bootstrap.min.js') }}"></script>

        <!-- daterangepicker -->
        <script src="{{ asset('/public/js/moment.min.js') }}"></script>
        <script src="{{ asset('/public/js/daterangepicker.js') }}"></script>
        <!-- datepicker -->
        <script src="{{ asset('/public/js/bootstrap-datepicker.min.js') }}"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{ asset('/public/js/bootstrap3-wysihtml5.all.min.js') }}"></script>
        <!-- Slimscroll -->
        <script src="{{ asset('/public/js/jquery.slimscroll.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('/public/js/fastclick.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('/public/js/adminlte.min.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('/public/js/dashboard.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('/public/js/demo.js') }}"></script>

        <script src="{{ asset('/public/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('/public/js/bootstrap.js') }}"></script>
        <script src="{{ asset('/public/js/additional-methods.js') }}"></script>
        <script src="{{ asset('/public/js/toaster.js') }}"></script>
    </body>
</html>
