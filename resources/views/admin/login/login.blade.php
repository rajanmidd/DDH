@extends('admin.layouts.template')
  @section('title')
    Login
  @endsection
@section('content')
<!-- BEGIN LOGIN -->
<div class="content">
  <!-- BEGIN LOGIN FORM -->
  {!! Form::open(['route' => 'admin.login','class'=>'login-form']) !!}
  <h3 class="form-title">Admin Login</h3>
  <div class="alert alert-danger display-hide">
    <button class="close" data-close="alert"></button>
    <span>Enter any username and password.</span>
  </div>
  @if (session()->has('success'))
  <script>
    swal({
      title: "Congratulations",
      text: "{!! session()->get('success') !!}",
      type: "success",
    });
  </script>
  @endif

  @if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops</strong>There were some problems with your input.<br><br>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <div class="form-group">
    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
    <label class="control-label visible-ie8 visible-ie9">Email Id</label>
    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email Id" name="email" value="{{ old('email') }}" />
  </div>
  <div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Password</label>
    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
  </div>
  <div class="form-actions">
    <button type="submit" class="btn btn-success uppercase">Log In</button>
    <label class="rememberme check">
       <!--<input type="checkbox" name="remember" value="1"/>@lang('signup.remember') </label>-->
      <!--<a href="javascript:;" id="forget-password" class="forget-password">@lang('signup.forget_password')</a>-->
  </div>

  {!! Form::close() !!}
  <!-- END LOGIN FORM -->
</div>
@endsection