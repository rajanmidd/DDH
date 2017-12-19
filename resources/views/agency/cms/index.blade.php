@extends('merchant.mainLayout.template')
@section('title')
   {{trans('sidebar.' . $pageDetail->slug )}}
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
               <a href="{{URL::to('/merchant/merchant-dashboard')}}">@lang('sidebar.home')</a>
               <i class="fa fa-angle-right"></i>
            </li>
            <li>
               <a href="javascript:void(0);">{{trans('sidebar.' . $pageDetail->slug )}}</a>
            </li>
         </ul>
      </div>
      <h3 class="page-title">
         {{trans('sidebar.'.$pageDetail->slug)}}
      </h3>
      <!-- END PAGE HEADER-->
      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
         <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="fa fa-table"></i>{{trans('sidebar.' . $pageDetail->slug )}}
                  </div>
               </div>
               <div class="portlet-body form">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-body">
                           {{$pageDetail->content}}
                        </div>                  
                     </div>                  
                  </div>                  
               </div>
            </div>
         </div>
         <!-- END CONTENT -->
      </div>
   </div>
</div>
@endsection