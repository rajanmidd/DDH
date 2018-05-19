@extends('agency.mainLayout.template')
  @section('title')
    Combo Packages
  @endsection
@section('content')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <div class="page-content">
    <div class="page-title">
      <div class="title_left">
        <h3>Combo Packages</h3>
      </div>
    </div>
      
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
    
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row form-group">
      <div class="col-md-10"> 
        <form class="form-inline" id="search_frm" name="search_frm" method="get" action="">
          <div class="pull-right">
            <div class=" form-group">
              <select class="form-control" name="status">
              <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') { echo 'selected';} ?>>All Packages</option>
              <option value="2" <?php if (isset($_GET['status']) && $_GET['status'] == '2') { echo 'selected';} ?>>Active Packages</option>
              <option value="3" <?php if (isset($_GET['status']) && $_GET['status'] == '3') { echo 'selected';} ?>>Packages Blocked by Agency</option>
              <option value="4" <?php if (isset($_GET['status']) && $_GET['status'] == '4') { echo 'selected';} ?>>Packages in Goweeks Review</option>
              <option value="5" <?php if (isset($_GET['status']) && $_GET['status'] == '5') { echo 'selected';} ?>>Packages Cancelled by Goweeks</option>
              </select> 
            </div>
            <div class=" form-group">
              <a href="add-combo-packages" style=" margin-bottom: 0px;margin-right: 0px;"  class="btn btn-default">Add Combo Packages</a>
            </div>
          </div>
        </form>
      </div>
    </div>
    
    <div class="row form-group">
      <div class="col-md-10"> 
        <div class="clearfix"></div>
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="">
          <div class=" flip-scroll">
            <div class="flip-content">
              
                @if(count($combo_packages)>0)
                  <?php $i = $combo_packages->perPage() * ($combo_packages->currentPage() - 1) + 1; ?>
                    @foreach($combo_packages as $key=>$value)
                  
                  
                  <div class="manage_data_wrap @if($value['is_blocked']==2) pending_bg @elseif($value['status']==0) not_active_bg @elseif($value['status']==1) active_bg @endif">
                      <div class="data_row action clearfix">
                        <a title="Edit" href="{{URL::to('/agency/edit-combo-package')}}/{{$value['id']}}"  class="btn-circle">
                              <i class="fa fa-pencil"></i>
                            Edit
                        </a>
                        <a title="View" href="{{URL::to('/agency/view-combo-package')}}/{{$value['id']}}"  class="btn-circle">
                            <i class="fa fa-eye"></i>
                            View
                        </a>
                        <a title="Delete" href="javascript:void(0);" class="confirm_button" data-href="{{URL::to('/agency/delete-combo-package')}}?id={{$value['id']}}">
                            <i class="fa fa-trash"></i>
                            Delete
                        </a>
                            <?php if ($value['is_blocked'] == 1) { ?>
                         <a title="Block" class="" style="color:green;" onclick="return confirm('Are you sure want to block this package?');" href="{{URL::to('/agency/update-combo-block')}}/2/{{$value['id']}}">
                            <i class="fa icon-ban"></i>
                             Block
                          </a>
                            <?php } else { ?>
                          <a title="Unblock" class="" style="color:red;" onclick="return confirm('Are you sure want to unblock this package?');" href="{{URL::to('/agency/update-combo-block')}}/1/{{$value['id']}}">
                              <i class="fa icon-ban"></i>
                              Unblock
                          </a>
                            <?php } ?>
                      </div>
                      <div class="data_row clearfix">
                        <label>Combo Title</label>
                        <span>{{ucfirst($value['combo_title'])}}</span>
                      </div>
                      <div class="data_row clearfix">
                        <label>Location</label>
                        <span>{{ucfirst($value['combo_location'])}}</span>
                      </div>
                      <div class="data_row clearfix">
                        <label>Goweeks Status</label>
                        <span>
                          @if($value['status']==0)
                            Pending
                          @else
                            Active
                          @endif  
                        </span>
                      </div>
                      <div class="data_row clearfix">
                        <label>Agency Status</label>
                        <span>
                          @if($value['is_blocked']==1)
                            Active
                          @else
                            Blocked
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
                  {{$combo_packages->appends(Request::only('status'))->links()}}
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