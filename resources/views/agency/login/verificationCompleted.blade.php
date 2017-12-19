@extends('agency.layouts.template')
  @section('title')
    Verification Completed
  @endsection
@section('content')
<!-- BEGIN LOGIN -->
<div class="content">
  <h3>Congratulations!</h3>
  <h2 class="text-center">Your email has been verified successfully.</h2>
  <h2 class="text-center">Please wait for the approval</h2>
  <h2 class="text-center">From Administrator</h2>
  <h2 class="text-center">
    <a class="btn btn-success uppercase" href="{{URL::to('/agency')}}">Go To Login Page</a>
  </h2>
</div>
@endsection