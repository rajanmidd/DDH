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
               <a href="javascript:void(0);">Activities</a>
            </li>
         </ul>
      </div>
      <div class="page-title">
         <div class="title_left">
            <h3>Activities</h3>
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
                           <div class="manage_data_wrap @if($value['is_blocked']==2  ) pending_bg @elseif($value['status']==0) not_active_bg @elseif($value['status']==1) active_bg   @endif">
                              <div class="data_row clearfix action">
                                 <a title="Edit" href="{{URL::to('/admin/edit-agency-activity')}}/{{$value['agency_id']}}/{{$value['id']}}"  class=" btn-circle">
                                    <i class="fa fa-pencil"></i>
                                    Edit
                                 </a>
                                 <a title="View" href="{{URL::to('/admin/view-activity')}}/{{$value['id']}}" class="btn btn-circle">
                                    <i class="fa fa-eye"></i>
                                    View
                                 </a>
                                 <!-- <a title="Delete" class="btn btn-circle confirm_button" href="{{URL::to('/admin/delete-activity')}}/{{Request::segment(3)}}/{{$value['id']}}">
                                    <i class="fa fa-trash"></i>
                                    Delete
                                 </a> -->
                                 @if(app('request')->input('status') != 3)
                                    @if($value['status']==0)
                                    <a href="{{URL::to('/admin/update-activity-status')}}/1/{{$value['agency_id']}}/{{$value['id']}}" class="btn btn-circle btn-xs green">
                                       Activate
                                    </a>
                                    @else
                                    <a href="{{URL::to('/admin/update-activity-status')}}/0/{{$value['agency_id']}}/{{$value['id']}}" class="btn btn-circle btn-xs red">
                                       De-activate
                                    </a>
                                    @endif
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
                              <div class="data_row clearfix">
                                 <label>Goweeks Status</label>
                                 <span>@if($value['status']==0)
                                          Pending
                                       @else
                                          Active
                                       @endif</span>
                              </div>

                              <div class="data_row clearfix">
                                 <label>Agency Status</label>
                                 <span>@if($value['is_blocked']==1)
                                          Not Blocked
                                       @else
                                          Blocked
                                       @endif</span>
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
<!-- END CONTENT -->
</div>
@endsection