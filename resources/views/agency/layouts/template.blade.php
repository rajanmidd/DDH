<!DOCTYPE html>
<?php 
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0 "); // Proxies.
?>
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8"/>
   <title>Agency :: @yield('title')</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
   <meta http-equiv="Content-type" content="text/html; charset=utf-8">
   <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate, max-stale=0, post-check=0, pre-check=0" />
   <meta http-equiv="Pragma" content="no-cache" />
   <meta http-equiv="Expires" content="-1" />
   <meta http-equiv="Vary" content="*" />
   <!-- BEGIN GLOBAL MANDATORY STYLES -->
   <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
   <link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
   <link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
   <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
   <link href="{{asset('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->
   <!-- BEGIN PAGE LEVEL STYLES -->
   <link href="{{asset('assets/admin/pages/css/login.css')}}" rel="stylesheet" type="text/css"/>
   <!-- END PAGE LEVEL SCRIPTS -->
   <!-- BEGIN THEME STYLES -->
   <link href="{{asset('assets/global/css/components.css')}}" id="style_components" rel="stylesheet" type="text/css"/>
   <link href="{{asset('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
   <link href="{{asset('assets/admin/layout/css/layout.css')}}" rel="stylesheet" type="text/css"/>
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
   <script type="text/javascript">
      //window.history.forward();
      function noBack() { 
         var oldURL = document.referrer;
         console.log(oldURL);
         var lastPart=oldURL.substr(oldURL.lastIndexOf('/') + 1);
         
         if(lastPart =='agency-dashboard')
         {
            window.location=base_url+"/agency/agency-dashboard";;
         }
      }
  </script>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="login" onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="" >
   
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
@include('agency.layouts.header')
@yield('content')
@include('agency.layouts.footer')

