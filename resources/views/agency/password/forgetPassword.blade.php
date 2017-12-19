@extends('merchant.layouts.template')
@section('title')
  @lang('signup.change_password')
@endsection
@section('content')
<!-- BEGIN LOGIN -->
   <div class="content">
      <!-- BEGIN FORGET PASSWORD FORM -->
      {!! Form::open(['route' => 'change-password1','class'=>'forget-password-form']) !!}
         <h3 class="form-title">@lang('signup.change_password')</h3>          
         <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">@lang('signup.password')</label>
            <input class="form-control form-control-solid placeholder-no-fix" id="password" type="password" autocomplete="off" placeholder="@lang('signup.password')" name="password" />
         </div>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">@lang('signup.retype_password')</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="@lang('signup.retype_password')" name="confirm_password"/>
         </div>
         <div class="form-actions">
            <button type="submit" class="btn btn-success uppercase">@lang('signup.submit')</button>
         </div>
         <input type="hidden" name="access_token" value="{{$pharmacyDetail->temp_access_token}}" />
      {!! Form::close() !!}
      <!-- BEGIN FORGET PASSWORD FORM -->
   </div>
@endsection