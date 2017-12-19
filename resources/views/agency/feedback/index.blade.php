@extends('merchant.mainLayout.template')
@section('title')
   @lang('sidebar.feedback')
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
               <a href="javascript:void(0);">@lang('sidebar.feedback')</a>
            </li>
         </ul>
      </div>
      <h3 class="page-title">
         @lang('sidebar.feedback')
      </h3>
      <!-- END PAGE HEADER-->
      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
         <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="fa fa-table"></i>@lang('sidebar.feedback')
                  </div>
               </div>
               <div class="portlet-body form">
                  <!-- BEGIN FORM-->
                  {!! Form::open(['route' => 'send','class'=>'form-horizontal form-row-seperated']) !!}
                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('login.your_query')</label>
                           <div class="col-md-9">
                              <textarea placeholder="@lang('login.your_query')" class="form-control" name="feedback" rows="10" ></textarea>
                              <div class="error">{{ $errors->first('feedback') }}</div>
                           </div>
                        </div>
                     </div>

                     <div class="form-actions">
                        <div class="row">
                           <div class="col-md-offset-3 col-md-9">
                              <button type="submit" class="btn green">@lang('signup.submit')</button>
                           </div>
                        </div>
                     </div>
                  {!! Form::close() !!}
                  <!-- END FORM-->
               </div>
            </div>
         </div>
         <!-- END CONTENT -->
      </div>
   </div>
</div>
@endsection