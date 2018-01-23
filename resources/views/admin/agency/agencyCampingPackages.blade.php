@extends('admin.mainLayout.template')
  @section('title')
  Manage Camping Packages
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
          <a href="javascript:void(0);">Manage Camping Packages</a>
        </li>
      </ul>
    </div>
    <div class="page-title">
      <div class="title_left">
        <h3>Manage Camping Packages</h3>
      </div>
    </div>

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
    <ul class="nav nav-tabs">
      <li class="">
        <a href="{{URL::to('/admin/agency-profile')}}?id={{Request::segment(3)}}">View Profile </a>
      </li>
      <li class="">
        <a href="{{URL::to('/admin/list-agency-activity')}}/{{Request::segment(3)}}"> View Activities </a>
      </li>
      <li class="active">
        <a href="javascript:void(0);"> View Camping Packages </a>
      </li>
      <li class="">
        <a href="{{URL::to('/admin/list-combo-packages')}}/{{Request::segment(3)}}"> View Combo Packages </a>
      </li>
    </ul>
    <div class="tab-content">
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
                <i class="fa fa-table"></i>Manage Camping Packages
              </div>
            </div>
            <div class="portlet-body flip-scroll">
              <table class="table table-bordered table-striped table-condensed flip-content">
                <thead class="flip-content">
                  <tr>
                    <th> Sr No. </th>
                    <th> Name </th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Days</th>
                    <th>Night</th>
                    <th> Status </th>
                    <th> Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($camping_packages)>0)
                  <?php $i = $camping_packages->perPage() * ($camping_packages->currentPage() - 1) + 1; ?>
                    @foreach($camping_packages as $key=>$value)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{ucfirst($value['camping_name'])}}</td>
                        <td> {{ucfirst($value['camping_title'])}}</td>
                        <td width="30%"> {{$value['camping_description']}}</td>
                        <td> {{$value['days']}}</td>
                        <td> {{$value['night']}}</td>
                        <td>
                          @if($value['status']==0)
                            <a href="{{URL::to('/admin/update-camping-package-status')}}/1/{{Request::segment(3)}}/{{$value['id']}}" class="btn btn-xs green">
                              Activate
                            </a>
                          @else
                              <a href="{{URL::to('/admin/update-camping-package-status')}}/0/{{Request::segment(3)}}/{{$value['id']}}" class="btn btn-xs red">
															  De-activate
															</a>
                          @endif
                        </td>
                        <td class="numeric">
                          <div class="actions">
                            <a title="Edit" href="{{URL::to('/admin/edit-camping-package')}}/{{$value['id']}}"  class="btn btn-circle">
                              <i class="fa fa-pencil"></i>
                            </a>
                            <a title="View" href="{{URL::to('/admin/view-camping-package')}}/{{Request::segment(3)}}/{{$value['id']}}"  class="btn btn-circle">
                              <i class="fa fa-eye"></i>
                            </a>
                            <a title="Delete" onclick="return confirm('Are you sure want to delete this package?');" class="btn btn-icon-only" href="{{URL::to('/admin/delete-camping-package')}}/{{Request::segment(3)}}/{{$value['id']}}">
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
                    {{$camping_packages->links() }}
                  </div>
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