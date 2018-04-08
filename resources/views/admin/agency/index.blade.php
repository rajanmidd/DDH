@extends('admin.mainLayout.template')
  @section('title')
    Manage Agency
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
          <a href="javascript:void(0);">Manage Agency</a>
        </li>
      </ul>
    </div>
    <div class="page-title">
      <div class="title_left">
        <h3>Manage Agency</h3>
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
    <!-- BEGIN PAGE CONTENT-->
    <div class="row form-group">
      <div class="col-xs-10 "> 
        <form class="form-inline " id="search_frm" name="search_frm" method="get" action="">
          <div class="pull-right">
            <div class=" form-group">
              <select class="form-control" name="status">
                <option value="">Select Option</option>
                <option value="0" <?php if (isset($_GET['status']) && $_GET['status'] == '0') { echo 'selected';} ?>>Pending</option>
                <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') { echo 'selected';} ?>>Verified</option>
                <option value="2" <?php if (isset($_GET['status']) && $_GET['status'] == '2') { echo 'selected';} ?>>Rejected</option>
              </select> 
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
                @if(count($agency_list)>0)
                    <?php $i = $agency_list->perPage() * ($agency_list->currentPage() - 1) + 1; ?>
                      @foreach($agency_list as $key=>$value)
                        <div class="manage_data_wrap @if($value['status']==2) not_active_bg  @elseif($value['status']==1) active_bg @else pending_bg @endif">
                            <div class="data_row clearfix action">
                                <a title="View" href="{{URL::to('/admin/agency-profile')}}?id={{$value['id']}}"  class="btn btn-circle">
                                  <i class="fa fa-eye"></i>
                                  View Profile
                                </a>
                                <?php if ($value['is_block'] == 0) { ?>
                                  <a title="Block" class="btn btn-icon-only" style="color:red;" onclick="return confirm('Are you sure want to block this agency?');" href="{{URL::to('/admin/block-agency')}}?id={{$value['id']}}">
                                    <i class="fa icon-ban"></i>
                                    Block
                                  </a>
                                <?php } else { ?>
                                  <a title="Unblock" class="btn btn-icon-only" style="color:green;" onclick="return confirm('Are you sure want to unblock this agency?');" href="{{URL::to('/admin/unblock-agency')}}?id={{$value['id']}}">
                                    <i class="fa icon-ban"></i>
                                    Unblock
                                  </a>
                                <?php } ?>
                            </div>                          
                            <div class="data_row clearfix">
                              <label>Owner Name</label>
                              <span>{{$value['owner_name']}} </span>
                            </div>
                            <div class="data_row clearify">
                              <label> Email</label>
                              <span>{{$value['email']}}</span>
                            </div>
                            <div class="data_row clearify">
                              <label> Mobile</label>
                              <span>{{$value['mobile']}}</span>
                            </div>
                            <div class="data_row clearify">
                              <label>Account Status</label>
                              <span>
                                @if($value['is_email_verified']==0)
                                  Pending
                                @else
                                  Verified
                                @endif
                              </span>
                            </div>
                            <div class="data_row clearfix">
                              <label>Go Week Status</label>
                              <span>@if($value['status']==0) Pending  @elseif($value['status']==1) Verified @else Rejected @endif</span>
                            </div>
                            <div class="data_row clearfix">
                              <label>Document Status</label>
                              <span>
                                @if($value['is_document_verified']==0)
                                  Pending
                                @endif
                                @if($value['is_document_verified']==1)
                                  Verified
                                @endif
                                @if($value['is_document_verified']==2)
                                  Rejected
                                @endif
                              </span>
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
                    {{$agency_list->links() }}
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