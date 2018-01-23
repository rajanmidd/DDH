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
      <div class="col-xs-12 "> 
        <form class="form-inline " id="search_frm" name="search_frm" method="get" action="">
          <div class="pull-right">
            <div class="form-group">              
              <input value="<?php if (isset($_GET['search_text'])) { echo $_GET['search_text'];} ?>" type="text" name="search_text" class="form-control" placeholder="Search For..."> 
            </div>
            <div class=" form-group">
              <select class="form-control" name="status">
                <option value="">Select Option</option>
                <option value="0" <?php if (isset($_GET['status']) && $_GET['status'] == '0') { echo 'selected';} ?>>Pending</option>
                <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') { echo 'selected';} ?>>Verified</option>
                <option value="2" <?php if (isset($_GET['status']) && $_GET['status'] == '2') { echo 'selected';} ?>>Rejected</option>
              </select> 
            </div>
            <div class=" form-group">
              <button style=" margin-bottom: 0px;margin-right: 0px;" type="submit" class="btn btn-default">Go</button>
            </div>
            <div class=" form-group">
              <a href="list-agency" style=" margin-bottom: 0px;margin-right: 0px;"  class="btn btn-default">Reset</a>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row form-group">
      <!-- BEGIN SAMPLE TABLE PORTLET-->
      <div class="portlet box green">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-table"></i>Manage Agency
          </div>
        </div>
        <div class="portlet-body flip-scroll">
          <table class="table table-bordered table-striped table-condensed flip-content">
            <thead class="flip-content">
              <tr>
                <th width="5%">
                  Sr No.
                </th>
                <th>
                  Date
                </th>
                <th>
                  Owner Name
                </th>
                <th class="numeric">
                  Email
                </th>
                <th class="numeric">
                  Mobile
                </th>
                <th class="numeric">
                  Email Verified
                </th>
                <th class="numeric">
                  Account Verified
                </th>
                <th class="numeric">
                  Documents Verified
                </th>
                <th class="numeric">
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              @if(count($agency_list)>0)
                <?php $i = $agency_list->perPage() * ($agency_list->currentPage() - 1) + 1; ?>
                  @foreach($agency_list as $key=>$value)
                    <tr>
                      <td>
                        {{$i}}
                      </td>
                      <td>  
                        {{date('d M, Y h:i A', strtotime($value['created_at']))}}
                      </td>
                      <td>  
                        {{$value['owner_name']}}
                      </td>
                      <td>
                        {{$value['email']}}
                      </td>
                      <td class="numeric">
                        {{$value['mobile']}}
                      </td>
                      <td>
                        @if($value['is_email_verified']==0)
                          Pending
                        @else
                          Verified
                        @endif
                      </td>
                      <td>
                        @if($value['status']==0)
                          Pending
                        @else
                          Verified
                        @endif
                      </td>
                      <td class="numeric">
                        @if($value['is_document_verified']==0)
                          Pending
                        @endif
                        @if($value['is_document_verified']==1)
                          Verified
                        @endif
                        @if($value['is_document_verified']==2)
                          Rejected
                        @endif
                      </td>
                      <td class="numeric">
                        <div class="actions">
                          <a title="View" href="{{URL::to('/admin/agency-profile')}}?id={{$value['id']}}"  class="btn btn-circle">
                            <i class="fa fa-eye"></i>
                          </a>
                          <?php if ($value['is_block'] == 0) { ?>
                            <a title="Block" class="btn btn-icon-only" style="color:green;" onclick="return confirm('Are you sure want to block this agency?');" href="{{URL::to('/admin/block-agency')}}?id={{$value['id']}}">
                              <i class="fa icon-ban"></i>
                            </a>
                          <?php } else { ?>
                            <a title="Unblock" class="btn btn-icon-only" style="color:red;" onclick="return confirm('Are you sure want to unblock this agency?');" href="{{URL::to('/admin/unblock-agency')}}?id={{$value['id']}}">
                              <i class="fa icon-ban"></i>
                            </a>
                          <?php } ?>
                        </div>
                      </td>
                    </tr>
                  <?php $i++; ?>
                  @endforeach
                @else
                <tr>
                  <td colspan="9"><center>Sorry, No Result Found</center></td>
                </tr>
              @endif
            </tbody>
          </table>
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
  <!-- END CONTENT -->
</div>
</div>
@endsection