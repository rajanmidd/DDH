<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Error</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/admin/pages/css/error.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/css/components.css')}}" id="style_components" rel="stylesheet" type="text/css"/>
</head>
<body class="page-500-full-page">
<div class="row">
   <div class="col-md-12 page-500">
      <div class=" number">
         {{$exception->getCode()}}
      </div>
      <div class=" details">
         <h3>Oops! Something went wrong.</h3>
         <p>
            {{$exception->getMessage()}} <br/>
            in {{$exception->getFile()}}<br />
            at line number {{$exception->getLine()}}! </br/>
            Please come back in a while.<br/><br/>
         </p>
      </div>
   </div>
</div>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>