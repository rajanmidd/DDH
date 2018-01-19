@extends('agency.mainLayout.template')
  @section('title')
    Combo Packages
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
          <a href="javascript:void(0);">Combo Packages</a>
        </li>
      </ul>
    </div>
    <div class="page-title">
      <div class="title_left">
        <h3>Combo Packages</h3>
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
              <a href="list-combo-packages" style=" margin-bottom: 0px;margin-right: 0px;"  class="btn btn-default">Reset</a>
            </div>
            <div class=" form-group">
              <a href="add-combo-packages" style=" margin-bottom: 0px;margin-right: 0px;"  class="btn btn-default">Add Combo Packages</a>
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
              <i class="fa fa-table"></i>Combo Packages
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
                @if(count($combo_packages)>0)
                  <?php $i = $combo_packages->perPage() * ($combo_packages->currentPage() - 1) + 1; ?>
                    @foreach($combo_packages as $key=>$value)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{ucfirst($value['combo_name'])}}</td>
                        <td> {{ucfirst($value['combo_title'])}}</td>
                        <td width="50%"> {{$value['combo_description']}}</td>
                        <td> {{$value['days']}}</td>
                        <td> {{$value['night']}}</td>
                        <td>
                          @if($value['status']==0)
                            Not Active
                          @else
                            Active
                          @endif
                        </td>
                        <td class="numeric">
                          <div class="actions">
                            <a title="Edit" href="{{URL::to('/agency/edit-combo-package')}}/{{$value['id']}}"  class="btn btn-circle">
                              <i class="fa fa-pencil"></i>
                            </a>
                            <a title="View" href="{{URL::to('/agency/view-combo-package')}}/{{$value['id']}}"  class="btn btn-circle">
                              <i class="fa fa-eye"></i>
                            </a>
                            <a title="Delete" href="javascript:void(0);" class="btn btn-icon-only confirm_button" data-href="{{URL::to('/agency/delete-combo-package')}}?id={{$value['id']}}">
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
                  {{$combo_packages->links() }}
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