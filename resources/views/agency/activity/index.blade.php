@extends('agency.mainLayout.template')
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
            <a href="{{URL::to('/agency/agency-dashboard')}}">Dashboard</a>
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
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row form-group">
      <div class="col-xs-12"> 
        <form class="form-inline " id="search_frm" name="search_frm" method="get" action="">
          <div class="pull-right">
            <div class="form-group">              
              <input value="<?php if (isset($_GET['search_text'])) { echo $_GET['search_text'];} ?>" type="text" name="search_text" class="form-control" placeholder="Search For..."> 
            </div>
            <div class=" form-group">
              <select class="form-control" name="status">
                <option value="">Select Option</option>
                <option value="0" <?php if (isset($_GET['status']) && $_GET['status'] == '0') { echo 'selected';} ?>>Not Active</option>
                <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') { echo 'selected';} ?>>Active</option>
              </select> 
            </div>
            <div class=" form-group">
              <button style=" margin-bottom: 0px;margin-right: 0px;" type="submit" class="btn btn-default">Go</button>
            </div>
            <div class=" form-group">
              <a href="list-activity" style=" margin-bottom: 0px;margin-right: 0px;"  class="btn btn-default">Reset</a>
            </div>
            <div class=" form-group">
              <a href="add-activity" style=" margin-bottom: 0px;margin-right: 0px;"  class="btn btn-default">Add New Activity</a>
            </div>
          </div>
        </form>
      </div>
    </div>
    
    <div class="row form-group">
      <div class="col-xs-12 "> 
        <div class="clearfix"></div>
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box green">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-table"></i>Manage Activity
            </div>
          </div>
          <div class="portlet-body flip-scroll">
            <table class="table table-bordered table-striped table-condensed flip-content">
              <thead class="flip-content">
                <tr>
                  <th> Sr No. </th>
                  <th> Activity Name </th>
                  <th>Title</th>
                  <th>Location</th>
                  <th>Capacity</th>
                  <th>Price/Perosn</th>
                  <th> Status </th>
                  <th> Action</th>
                </tr>
              </thead>
              <tbody>
                @if(count($activity_list)>0)
                  <?php $i = $activity_list->perPage() * ($activity_list->currentPage() - 1) + 1; ?>
                    @foreach($activity_list as $key=>$value)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{ucfirst($value->activityName['name'])}}</td>
                        <td> {{ucfirst($value['title'])}}</td>
                        <td> {{$value['location']}}</td>
                        <td> {{$value['capacity']}}</td>
                        <td> {{$value['price_per_person']}}</td>
                        <td>
                          @if($value['status']==0)
                            Not Active
                          @else
                            Active
                          @endif
                        </td>
                        <td class="numeric">
                          <div class="actions">
                            <a title="Edit" href="{{URL::to('/agency/edit-activity')}}/information/{{$value['id']}}"  class="btn btn-circle">
                              <i class="fa fa-pencil"></i>
                            </a>
                            <a title="View" href="{{URL::to('/agency/view-activity')}}/{{$value['id']}}"  class="btn btn-circle">
                              <i class="fa fa-eye"></i>
                            </a>
                            <a title="Delete" href="javascript:void(0);" class="btn btn-icon-only confirm_button" data-href="{{URL::to('/agency/delete-activity')}}?id={{$value['id']}}">
                              <i class="fa fa-trash"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                    <?php $i++; ?>
                    @endforeach
                  @else
                  <tr>
                    <td colspan="8"><center>Sorry, No Result Found</center></td>
                  </tr>
                @endif
              </tbody>
            </table>
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