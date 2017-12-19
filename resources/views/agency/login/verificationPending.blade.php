@extends('agency.layouts.template')
@section('title')
    Verification Pending
@endsection
@section('content')
<!-- BEGIN LOGIN -->
   <div class="content">
      <h3>Congratulations!</h3>
      <h2 class="text-center">You have registered successfully.</h2>
      <h2 class="text-center">Please check your email</h2>
      <h2 class="text-center">and verifiy your email.</h2>
      <h2 class="text-center">
         <a class="btn btn-success uppercase" href="{{URL::to('/agency')}}">Go To Login Page</a>
      </h2>
   </div>
@endsection