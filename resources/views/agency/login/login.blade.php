@extends('agency.layouts.template')
@section('title')
   Login
@endsection
@section('content')
<!-- BEGIN LOGIN -->
   <div class="content">
      <!-- BEGIN LOGIN FORM -->
      {!! Form::open(['route' => 'agency.login','class'=>'login-form']) !!}
         <h3 class="form-title">Sign In</h3>
         <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span>Enter username and password</span>
         </div>        
         @if (count($errors) > 0)
            <div class="alert alert-danger">
               <ul>
                  @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                  @endforeach
               </ul>
            </div>
          @endif
          
         <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" value="{{ old('email') }}" />
         </div>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
         </div>
         <div class="form-actions">
            <button type="submit" class="btn btn-success uppercase">Login</button>
            <label class="rememberme check">
               <a href="javascript:;" id="forget-password" class="forget-password">Forget Password</a>
         </div>
         <div class="create-account">
            <p>
               <a href="javascript:;" id="register-btn" class="uppercase">Create An Account</a>
            </p>
         </div>
      {!! Form::close() !!}
      <!-- END LOGIN FORM -->
      <!-- BEGIN FORGOT PASSWORD FORM -->
      {!! Form::open(['route' => 'agency.forgetPasswordMail','class'=>'forget-form']) !!}
         <h3>Forget Password</h3>
         <p>
            Enter your e-mail address below to reset your password.
         </p>
         <div class="form-group">
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
         </div>
         <div class="form-actions">
            <button type="button" id="back-btn" class="btn btn-default">Back</button>
            <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
         </div>
      {!! Form::close() !!}
      <!-- END FORGOT PASSWORD FORM -->
      <!-- BEGIN REGISTRATION FORM -->
      {!! Form::open(['route' => 'agency.register','class'=>'register-form','files'=>true]) !!}
         <h3>Signup</h3>
         <p class="hint">
            Enter your personal details below :
         </p>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Agency Name</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Company Name" name="company"/>
         </div>  
         
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Address</label>
            <textarea class="form-control placeholder-no-fix" placeholder="Address" id="address" name="address"></textarea>
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
         </div>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Owner Name</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Owner Name" name="owner_name"/>
         </div>
         <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email"/>
         </div>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="password" placeholder="Password" name="password"/>
         </div>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Confirm Password</label>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="confirm_password"/>
         </div>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Mobile Number</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Mobile" name="mobile"/>
         </div>     
             
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Certificate Upload</label>
            <input type="file" name="certificate_image" id="certificate" class="filestyle" data-buttonName="btn-primary" data-buttonText="Choose Certificate">
         </div>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Adhar-Card or other Govt Proof</label>
            <input type="file" name="id_proof" id="license_image" class="filestyle" data-buttonName="btn-primary" data-buttonText="Adhar-Card or other Govt Proof ">
         </div>
         <div class="form-group">
         
         <input type="checkbox" name="terms_condition" id="inlineCheckbox21" value='1'>
            I declared that i have read all terms and conditions and privacy policy of goweeks
         </div>
         
         <div class="form-actions">
            <button type="button" id="register-back-btn" class="btn btn-default">Back</button>
            <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">Submit</button>
         </div>
      {!! Form::close() !!}
      <!-- END REGISTRATION FORM -->
   </div>
@endsection