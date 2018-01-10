@extends('agency.mainLayout.template')
@section('title')
   Change Password
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
               <a href="{{URL::to('/agency/agency-dashboard')}}">Home</a>
               <i class="fa fa-angle-right"></i>
            </li>
            <li>
               <a href="javascript:void(0);">Change Password</a>
            </li>
         </ul>
      </div>
      <h3 class="page-title">
         Change Password
      </h3>
      <!-- END PAGE HEADER-->
      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
         <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="fa fa-table"></i>Change Password
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
                           <label class="control-label col-md-3">Old Password</label>
                           <div class="col-md-9">
                              <input type="password" placeholder="Old Password" class="form-control" name="old_password" />
                              <div class="error">{{ $errors->first('old_password') }}</div>
                           </div>
                        </div>
                     </div>
                     
                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">New Password</label>
                           <div class="col-md-9">
                              <input type="password" placeholder="New Password" class="form-control" id="new_password" name="new_password" />
                              <div class="error">{{ $errors->first('new_password') }}</div>
                           </div>
                        </div>
                     </div>
                  
                      <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">Confirm New Password</label>
                           <div class="col-md-9">
                              <input type="password" placeholder="Confirm New Password" class="form-control" name="confirm_new_password" />
                              <div class="error">{{ $errors->first('confirm_new_password') }}</div>
                           </div>
                        </div>
                     </div>
                  
                     <div class="form-actions">
                        <div class="row">
                           <div class="col-md-offset-3 col-md-9">
                              <button type="submit" class="btn green">Submit</button>
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