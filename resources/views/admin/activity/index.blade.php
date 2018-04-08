@extends('admin.mainLayout.template')
  @section('title')
    Manage Activity
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
            <a href="{{URL::to('/admin/admin-dashboard')}}">Dashboard</a>
          <i class="fa fa-angle-right"></i>
        </li>
        <li>
          <a href="javascript:void(0);">Manage Activity</a>
        </li>
      </ul>
    </div>
    <div class="page-title">
      <div class="title_left">
        <h3>Manage Activity</h3>
      </div>
    </div>
    </br>
    @if (session()->has('success'))
    <div class="row">
      <div class="col-xs-12"> 
        <div class="alert alert-success">      
          <p>{!! session()->get('success') !!}</p>
        </div>
      </div>
    </div>
    @endif

    @if (session()->has('error'))
    <div class="row">
      <div class="col-xs-12"> 
        <div class="alert alert-error">      
          <p>{!! session()->get('error') !!}</p>
        </div>
      </div>
    </div>
    @endif
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row form-group">
      <div class="col-xs-10"> 
        <form class="form-inline " id="search_frm" name="search_frm" method="get" action="">
          <div class="pull-right">
            <div class=" form-group">
              <select class="form-control" name="status">
                <option value="">Select Option</option>
                <option value="0" <?php if (isset($_GET['status']) && $_GET['status'] == '0') { echo 'selected';} ?>>Not Active</option>
                <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') { echo 'selected';} ?>>Active</option>
              </select> 
            </div>
            <div class=" form-group">
              <a href="add-activity" style=" margin-bottom: 0px;margin-right: 0px;"  class="btn btn-default">Add New Activity</a>
            </div>
          </div>
        </form>
      </div>
    </div>
    
    <div class="row form-group">
      <div class="col-xs-10 "> 
        <div class="clearfix"></div>
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="">
          <div class="flip-scroll">
            <div class="flip-content">
                @if(count($activity_list)>0)
                  <?php $i = $activity_list->perPage() * ($activity_list->currentPage() - 1) + 1; ?>
                    @foreach($activity_list as $key=>$value)
                      <div class="manage_data_wrap @if($value['status']==0) not_active_bg @elseif($value['status']==1) active_bg @else pending_bg @endif">
                          <div class="data_row clearfix action">
                              <a title="Edit" href="{{URL::to('/admin/edit-activity')}}?id={{$value['id']}}"  class="btn btn-circle">
                                <i class="fa fa-pencil"></i>
                                  Edit
                              </a>
                              <?php if ($value['status'] == 1) { ?>
                                <a title="In Active" class="" style="color:red;" onclick="return confirm('Are you sure want to in active this activity?');" href="{{URL::to('/admin/deactivate-activity')}}?id={{$value['id']}}">
                                  <i class="fa icon-ban"></i>
                                    In Active
                                </a>
                              <?php } else { ?>
                                <a title="Active" class="" style="color:green;" onclick="return confirm('Are you sure want to active this activity?');" href="{{URL::to('/admin/activate-activity')}}?id={{$value['id']}}">
                                  <i class="fa icon-ban"></i>
                                  Active
                                </a>
                          <?php }?>
                          </div>                          
                          <div class="data_row clearfix">
                              <label>Activity Name</label>
                              <span>{{ucfirst($value['name'])}} </span>
                          </div>
                          <div class="data_row clearfix">
                              <label>Activity Icon</label>
                              @if($value['activity_image'])
                                <img height="50px" width="50px"  src="{{$value['activity_image']}}" />
                              @else
                                 No icon exists
                              @endif
                          </div>
                          <div class="data_row clearfix">
                              <label>Status</label>
                              <span>@if($value['status']==0) Not Active @else Active @endif</span>
                          </div>
                      </div>
                    <?php $i++; ?>
                    @endforeach
                  @else
                  <div class="no-data">Sorry, No Result Found</div>
                @endif
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="dataTables_paginate paging_bootstrap_full_number pull-right" id="sample_1_paginate">
                  {{$activity_list->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END CONTENT -->
</div>
@endsection