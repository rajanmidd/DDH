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
      Agency
    </h3>
    <!-- END PAGE HEADER-->
    <!-- BEGIN DASHBOARD STATS -->
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-madison">
          <div class="visual">
            <i class="fa fa-comments"></i>
          </div>
          <div class="details">
            <div class="number">
              {{$pending_agency}}
            </div>
            <div class="desc">
              Pending Agency
            </div>
          </div>
          <a class="more" href="{{URL::to('/admin/list-agency?status=0')}}">
            View More <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat red-intense">
          <div class="visual">
            <i class="fa fa-bar-chart-o"></i>
          </div>
          <div class="details">
            <div class="number">{{$rejected_agency}}</div>
            <div class="desc">
              Rejected Agency
            </div>
          </div>
          <a class="more" href="{{URL::to('/admin/list-agency?status=2')}}">
            View More <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple-plum">
          <div class="visual">
            <i class="fa fa-globe"></i>
          </div>
          <div class="details">
            <div class="number">{{$blocked_agency}}</div>
            <div class="desc">
              Blocked Agency
            </div>
          </div>
          <a class="more" href="{{URL::to('/admin/list-agency?status=3')}}">
            View More <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
    </div>

    <h3 class="page-title">
      Activity
    </h3>
    <div class="row">
      <div class="col-lg-4 col-lg-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat red-flamingo">
          <div class="visual">
            <i class="fa fa-globe"></i>
          </div>
          <div class="details">
            <div class="number">{{$pending_activity}}</div>
            <div class="desc">
              Pending Activity
            </div>
          </div>
          <a class="more" href="{{URL::to('/admin/activities?status=1')}}">
            View More <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-lg-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat red-flamingo">
          <div class="visual">
            <i class="fa fa-globe"></i>
          </div>
          <div class="details">
            <div class="number">{{$blocked_activity}}</div>
            <div class="desc">
              Blocked Activity
            </div>
          </div>
          <a class="more" href="{{URL::to('/admin/activities?status=2')}}">
            View More <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-lg-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat red-flamingo">
          <div class="visual">
            <i class="fa fa-globe"></i>
          </div>
          <div class="details">
            <div class="number">{{$deleted_activity}}</div>
            <div class="desc">
              Deleted Activity
            </div>
          </div>
          <a class="more" href="{{URL::to('/admin/activities?status=3')}}">
            View More <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
    </div>

    <h3 class="page-title">
      Others
    </h3>
    <div class="row">
      <div class="col-lg-4 col-lg-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat yellow-saffron">
          <div class="visual">
            <i class="fa fa-globe"></i>
          </div>
          <div class="details">
            <div class="number">&nbsp;</div>
            <div class="desc">
              Total Users
            </div>
          </div>
          <a class="more" href="#">
            View More <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-lg-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat yellow-casablanca">
          <div class="visual">
            <i class="fa fa-globe"></i>
          </div>
          <div class="details">
            <div class="number">&nbsp;</div>
            <div class="desc">
              New Orders
            </div>
          </div>
          <a class="more" href="#">
            View More <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-lg-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat grey-mint">
          <div class="visual">
            <i class="fa fa-globe"></i>
          </div>
          <div class="details">
            <div class="number">&nbsp;</div>
            <div class="desc">
              Past Orders
            </div>
          </div>
          <a class="more" href="#">
            View More <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-lg-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat grey-mint">
          <div class="visual">
            <i class="fa fa-globe"></i>
          </div>
          <div class="details">
            <div class="number">&nbsp;</div>
            <div class="desc">
              Trasactions
            </div>
          </div>
          <a class="more" href="#">
            View More <i class="m-icon-swapright m-icon-white"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END CONTENT -->
@endsection