@extends('admin.mainLayout.template') @section('title') Manage Activity @endsection @section('content')
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

      @if (session()->has('success'))
      <div class="row">
         <div class="col-xs-12">
            <div class="alert alert-success">
               <p>{!! session()->get('success') !!}</p>
            </div>
         </div>
      </div>
      @endif @if (session()->has('error'))
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
            <a href="{{URL::to('/admin/agency-profile')}}?id={{Request::segment(3)}}">Profile </a>
         </li>
         <li class="active">
            <a href="javascript:void(0);"> Activities </a>
         </li>
         <li class="">
            <a href="{{URL::to('/admin/list-camping-packages')}}/{{Request::segment(3)}}"> Camping Packages </a>
         </li>
         <li class="">
            <a href="{{URL::to('/admin/list-combo-packages')}}/{{Request::segment(3)}}"> Combo Packages </a>
         </li>
      </ul>
      <div class="tab-content">
         <!-- BEGIN PAGE CONTENT-->
         <div class="row form-group">
            <div class="col-xs-10">
               <form class="form-inline " id="search_frm" name="search_frm" method="get" action="">
                  <div class="pull-right">
                     <div class=" form-group">
                        <select class="form-control" name="status">
                           <option value="">All</option>
                           <option value="0" <?php if (isset($_GET[ 'status']) && $_GET[ 'status']=='0' ) { echo 'selected';} ?>>Not Active</option>
                           <option value="1" <?php if (isset($_GET[ 'status']) && $_GET[ 'status']=='1' ) { echo 'selected';} ?>>Active</option>
                        </select>
                     </div>
                  </div>
               </form>
            </div>
         </div>

         <div class="row form-group">
            <div class="col-xs-10">
               <div class="clearfix"></div>
               <!-- BEGIN SAMPLE TABLE PORTLET-->
               <div class="">
                  <div class="flip-scroll">
                     <div class="flip-content">
                        @if(count($activity_list)>0)
                           <?php $i = $activity_list->perPage() * ($activity_list->currentPage() - 1) + 1; ?> 
                           @foreach($activity_list as $key=>$value)
                              <div class="manage_data_wrap @if($value['status']==0) not_active_bg  @elseif($value['status']==1) active_bg @else pending_bg @endif">
                                 <div class="data_row clearfix action">
                                    <a title="View" href="{{URL::to('/admin/view-activity')}}/{{$value['id']}}" class="btn btn-circle">
                                       <i class="fa fa-eye"></i>
                                       View
                                    </a>
                                    <a title="Delete" class="btn btn-circle confirm_button" href="{{URL::to('/admin/delete-activity')}}/{{Request::segment(3)}}/{{$value['id']}}">
                                       <i class="fa fa-trash"></i>
                                       Delete
                                    </a>
                                    @if($value['status']==0)
                                    <a href="{{URL::to('/admin/update-activity-status')}}/1/{{Request::segment(3)}}/{{$value['id']}}" class="btn btn-circle btn-xs green">
                                       Activate
                                    </a>
                                    @else
                                    <a href="{{URL::to('/admin/update-activity-status')}}/0/{{Request::segment(3)}}/{{$value['id']}}" class="btn btn-circle btn-xs red">
                                       De-activate
                                    </a>
                                    @endif
                                 </div>
                                 <div class="data_row clearfix">
                                    <label>Activity Name</label>
                                    <span>{{ucfirst($value->activityName['name'])}} </span>
                                 </div>
                                 <div class="data_row clearify">
                                    <label> Title</label>
                                    <span>{{ucfirst($value['title'])}}</span>
                                 </div>
                                 <div class="data_row clearify">
                                    <label> Location</label>
                                    <span>{{$value['location']}}</span>
                                 </div>
                                 <div class="data_row clearify">
                                    <label>Price/Person</label>
                                    <span>{{$value['price_per_person']}}</span>
                                 </div>
                              </div>
                              <?php $i++; ?> 
                           @endforeach 
                        @else
                           <div class="no-data">
                              <center>Sorry, No Result Found</center>
                           </div>
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
   </div>
<!-- END CONTENT -->
</div>
@endsection