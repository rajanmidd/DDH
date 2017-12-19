@extends('merchant.mainLayout.template')
@section('title')
   @lang('account.manage_bank_account')
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
               <a href="javascript:void(0);">@lang('account.manage_bank_account')</a>
            </li>
         </ul>
      </div>
      <h3 class="page-title">
         @lang('account.manage_bank_account')
      </h3>
      <!-- END PAGE HEADER-->
      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
         <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="fa fa-table"></i>@lang('account.manage_bank_account')
                  </div>
               </div>
               <div class="portlet-body form">
                  <!-- BEGIN FORM-->
                  {!! Form::model($accountDetail, ['method' => 'PATCH', 'route' => ['update-account-detail'], 'class'=>'form-horizontal form-row-seperated']) !!}
                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('account.bank_name')</label>
                           <div class="col-md-9">
                              <input type="text" placeholder="@lang('account.bank_name')" class="form-control" name="bank_name" value="{{ (!empty($accountDetail->bank_name)) ? $accountDetail->bank_name:'' }}"  />
                              <div class="error">{{ $errors->first('bank_name') }}</div>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('account.account_number')</label>
                           <div class="col-md-9">
                              <input type="text" placeholder="@lang('account.account_number')" class="form-control" name="account_number" value="{{ !empty($accountDetail->account_number)?$accountDetail->account_number:'' }}"/>
                              <div class="error">{{ $errors->first('account_number') }}</div>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('account.swift_code')</label>
                           <div class="col-md-9">
                              <input type="text" placeholder="@lang('account.swift_code')" class="form-control" name="swift_code" value="{{ !empty($accountDetail->swift_code) ? $accountDetail->swift_code:'' }}"/>
                              <div class="error">{{ $errors->first('swift_code') }}</div>
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