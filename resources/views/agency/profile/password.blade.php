@extends('merchant.mainLayout.template')
@section('title')
   @lang('sidebar.change_password')
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
               <a href="javascript:void(0);">@lang('sidebar.change_password')</a>
            </li>
         </ul>
      </div>
      <h3 class="page-title">
         @lang('sidebar.change_password')
      </h3>
      <!-- END PAGE HEADER-->
      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
         <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="fa fa-table"></i>@lang('sidebar.change_password')
                  </div>
               </div>
               <div class="portlet-body form">
                  <!-- BEGIN FORM-->
                  {!! Form::open(['route' => 'change-password','class'=>'form-horizontal form-row-seperated change-password-form']) !!}
                     <div class="form-body">
                        <div class="form-group">
                           @if (count($errors) > 0)
                              <div class="alert alert-danger">
                                 <strong>@lang('signup.whoops')</strong>@lang('signup.problem_with_input')<br><br>
                                 <ul>
                                    @foreach ($errors->all() as $error)
                                       <li>{{ $error }}</li>
                                    @endforeach
                                 </ul>
                              </div>
                            @endif
                        </div>
                     </div>
                      
                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('sidebar.old_password')</label>
                           <div class="col-md-9">
                              <input type="password" placeholder="@lang('sidebar.old_password')" class="form-control" name="old_password" />
                              <div class="error">{{ $errors->first('old_password') }}</div>
                           </div>
                        </div>
                     </div>
                     
                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('sidebar.new_password')</label>
                           <div class="col-md-9">
                              <input type="password" placeholder="@lang('sidebar.new_password')" class="form-control" id="new_password" name="new_password" />
                              <div class="error">{{ $errors->first('new_password') }}</div>
                           </div>
                        </div>
                     </div>
                  
                      <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('sidebar.confirm_new_password')</label>
                           <div class="col-md-9">
                              <input type="password" placeholder="@lang('sidebar.confirm_new_password')" class="form-control" name="confirm_new_password" />
                              <div class="error">{{ $errors->first('confirm_new_password') }}</div>
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