@extends('agency.layouts.template')
@section('title')
    Account Rejected
@endsection
@section('content')
<!-- BEGIN LOGIN -->
   <div class="content">
      <h4 class="text-center">Your are blocked by Goweeks, if you have any concern, </h4>
      <h4 class="text-center">Please call us or drop a mail to goweeeks</h4>
      <h4 class="text-center">Contact and support: Email - team@goweeks.in Phone - 9582835523</h4>
      <h2 class="text-center">
         <a class="btn btn-success uppercase" href="{{ URL::to('/agency') }}">Back To Login</a>
      </h2>
   </div>
@endsection