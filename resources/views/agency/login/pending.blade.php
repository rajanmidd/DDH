@extends('agency.layouts.template')
@section('title')
    Account Pending
@endsection
@section('content')
<!-- BEGIN LOGIN -->
   <div class="content">
      <h4 class="text-center">Your account is in Goweeks review process, this will be processed in same working day. </h4>
      <h4 class="text-center">You might get call from goweeks or goweeks member will visit your place for verification</h4>
      <h4 class="text-center">Contact and support: Email - team@goweeks.in Phone - 9582835523</h4>
      <h2 class="text-center">
         <a class="btn btn-success uppercase" href="{{ URL::to('/agency') }}">Go to Login</a>
      </h2>
   </div>
@endsection