@extends('agency.mainLayout.template')
  @section('title')
    Dashbaord
  @endsection
@section('content')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
   <div class="page-content">
      <!-- BEGIN PAGE HEADER-->
      <div class="page-bar">
         <ul class="page-breadcrumb">
            <li>
               <i class="fa fa-home"></i>
               <a href="{{URL::to('/merchant/merchant-dashboard')}}">Home</a>
               <i class="fa fa-angle-right"></i>
            </li>
            <li>
               <a href="javascript:void(0);">Dashbaord</a>
            </li>
         </ul>
      </div>
      <h3 class="page-title">
         Dashbaord
      </h3>
      <!-- END PAGE HEADER-->
      <!-- BEGIN DASHBOARD STATS -->
      <div class="row">
         <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat blue-madison">
               <div class="visual">
                  <i class="fa fa-comments"></i>
               </div>
               <div class="details">
                  <div class="number">
                     {{count($total_activities)}}
                  </div>
                  <div class="desc">
                     Total Activities
                  </div>
               </div>
                <a class="more" href="{{URL::to('agency/list-activity')}}">
                  View More <i class="m-icon-swapright m-icon-white"></i>
               </a>
            </div>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat red-intense">
               <div class="visual">
                  <i class="fa fa-bar-chart-o"></i>
               </div>
               <div class="details">
                  <div class="number">
                     0
                  </div>
                  <div class="desc">
                     Total Orders
                  </div>
               </div>
               <a class="more" href="{{URL::to('agency/list-activity')}}">
                  View More<i class="m-icon-swapright m-icon-white"></i>
               </a>
            </div>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat green-haze">
               <div class="visual">
                  <i class="fa fa-shopping-cart"></i>
               </div>
               <div class="details">
                  <div class="number">
                     0
                  </div>
                  <div class="desc">
                     Total Orders
                  </div>
               </div>
               <a class="more" href="{{URL::to('agency/list-activity')}}">
                  View More <i class="m-icon-swapright m-icon-white"></i>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- END CONTENT -->
@endsection