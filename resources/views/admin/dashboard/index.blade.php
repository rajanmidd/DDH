@extends('admin.mainLayout.template')
  @section('title')
    Dashboard
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
            <a href="{{URL::to('/admin/admin-dashboard')}}">Home</a>
          <i class="fa fa-angle-right"></i>
        </li>
        <li>
          <a href="javascript:void(0);">Dashboard</a>
        </li>
      </ul>
    </div>
    <h3 class="page-title">
      Dashboard
    </h3>
    <!-- END PAGE HEADER-->
    <!-- BEGIN DASHBOARD STATS -->
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-madison">
          <div class="visual">
            <i class="fa fa-comments"></i>
          </div>
          <div class="details">
            <div class="number">
              {{$total_users}}
            </div>
            <div class="desc">
              Total Users
            </div>
          </div>
          <a class="more" href="{{URL::to('/admin/list-user')}}">
            View More <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red-intense">
          <div class="visual">
            <i class="fa fa-bar-chart-o"></i>
          </div>
          <div class="details">
            <div class="number">
              0
            </div>
            <div class="desc">
              Unverified Agencies
            </div>
          </div>
          <a class="more" href="{{URL::to('/admin/list-pharmacy')}}">
            View More <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green-haze">
          <div class="visual">
            <i class="fa fa-shopping-cart"></i>
          </div>
          <div class="details">
            <div class="number">
              0
            </div>
            <div class="desc">
              Test
            </div>
          </div>
          <a class="more" href="{{URL::to('/admin/earned-revenue')}}">
            View More <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple-plum">
          <div class="visual">
            <i class="fa fa-globe"></i>
          </div>
          <div class="details">
            <div class="number">
              0
            </div>
            <div class="desc">
              New Order
            </div>
          </div>
          <a class="more" href="{{URL::to('/admin/orders?search_text=&status=1')}}">
            View More <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END CONTENT -->
@endsection