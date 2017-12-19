<!DOCTYPE html>

<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Agency :: @yield('title')</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/fancybox/source/jquery.fancybox.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="{{asset('assets/global/css/components.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/admin/layout/css/layout.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/admin/pages/css/todo.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/admin/layout/css/themes/darkblue.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
<link href="{{asset('assets/admin/layout/css/custom.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/agency/custom_style.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
<script src="{{asset('js/sweetalert-dev.js')}}" type="text/javascript"></script>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<script>
      var base_url = '{{URL::to("/")}}';
</script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-over-content">
<?php 
   $action=substr(class_basename(Route::currentRouteAction()),(strpos(class_basename(Route::currentRouteAction()), '@') + 1));
   $controller=substr(class_basename(Route::currentRouteAction()), 0, (strpos(class_basename(Route::currentRouteAction()),'@')-0));
?>
@if (session()->has('success'))
   <script>
      swal({
         title: "Congratulations",
         text:  "{!! session()->get('success') !!}",
         type: "success",
      });
   </script>
@endif
@if (session()->has('error'))
   <script>
      swal({
         title: "Sorry",
         text:  "{!! session()->get('error') !!}",
         type: "error",
      });
   </script>
@endif
@include('agency.mainLayout.header')
<div class="page-container">
   @include('agency.mainLayout.sidebar')
   @yield('content')
</div>
@include('agency.mainLayout.footer')

