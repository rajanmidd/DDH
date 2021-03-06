@extends('agency.mainLayout.template')
  @section('title')
    Camping Packages
  @endsection
@section('content')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <div class="page-content">
    <div class="page-title">
      <div class="title_left">
        <h3>Camping Packages</h3>
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
          <a href="javascript:void(0);">Camping Packages</a>
        </li>
      </ul>
    </div>
    
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row form-group">
      <div class="col-md-10"> 
        <form class="form-inline " id="search_frm" name="search_frm" method="get" action="">
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
              <a href="add-camping-packages" style=" margin-bottom: 0px;margin-right: 0px;"  class="btn btn-default">Add Camping Packages</a>
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
                @if(count($camping_packages)>0)
                  <?php $i = $camping_packages->perPage() * ($camping_packages->currentPage() - 1) + 1; ?>
                    @foreach($camping_packages as $key=>$value)
                  
                  <div class="manage_data_wrap @if($value['status']==0) not_active_bg @elseif($value['status']==1) active_bg @else pending_bg @endif">
                    
                      <div class="data_row action clearfix">
                        <a title="Edit" href="{{URL::to('/agency/edit-camping-package')}}/{{$value['id']}}"  class="btn-circle">
                          <i class="fa fa-pencil"></i>
                            Edit
                        </a>
                        <a title="View" href="{{URL::to('/agency/view-camping-package')}}/{{$value['id']}}"  class=" btn-circle">
                          <i class="fa fa-eye"></i>
                            View
                        </a>
                        <a title="Delete" href="javascript:void(0);" class="confirm_button" data-href="{{URL::to('/agency/delete-camping-package')}}?id={{$value['id']}}">
                          <i class="fa fa-trash"></i>
                            Delete
                        </a>
                        <?php if ($value['is_blocked'] == 1) { ?>
                          <a title="Block" class="" style="color:green;" onclick="return confirm('Are you sure want to block this package?');" href="{{URL::to('/agency/update-camping-block')}}/2/{{$value['id']}}">
                            <i class="fa icon-ban"></i>
                              Block
                          </a>
                        <?php } else { ?>
                          <a title="Unblock" class="" style="color:red;" onclick="return confirm('Are you sure want to unblock this package?');" href="{{URL::to('/agency/update-camping-block')}}/1/{{$value['id']}}">
                            <i class="fa icon-ban"></i>
                              Unblock
                          </a>
                        <?php } ?>
                    </div>
                      
                      <div class="clearfix">
                            <div class="data_row col-md-6">
                                <label>Camping Name</label>
                                <span>{{ucfirst($value['camping_name'])}}</span>
                            </div>
                          
                              <div class="data_row col-md-6">
                                <label>Title</label>
                                <span>{{ucfirst($value['camping_title'])}}</span>
                              </div>
                      </div>
                      
                      <div class="clearfix">
                        <div class="data_row col-md-6">
                            <label>goweek Status</label>
                            <span>
                              @if($value['status']==0)
                                Not Active
                              @else
                                Active
                              @endif  
                            </span>
                          </div>
                      
                          <div class="data_row col-md-6">
                            <label>Agency Status</label>
                            <span>
                               Dummy
                            </span>
                          </div>
                          
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
                  {{$camping_packages->appends(Request::only('status'))->links()}}
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