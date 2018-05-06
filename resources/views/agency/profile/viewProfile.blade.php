@extends('agency.mainLayout.template')
@section('title')
   View Profile
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
               <a href="{{URL::to('/agency/agency-dashboard')}}">Home</a>
               <i class="fa fa-angle-right"></i>
            </li>
            <li>
               <a href="javascript:void(0);">View Profile</a>
            </li>
         </ul>
      </div>
      <h3 class="page-title">
      View Profile
      </h3>
      <!-- END PAGE HEADER-->
      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
         <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="fa fa-table"></i>View Profile
                  </div>
               </div>
               <div class="portlet-body form">
                  <!-- BEGIN FORM-->
                  {!! Form::model($profileDetail, ['method' => 'PATCH', 'route' => ['profile'], 'class'=>'form-horizontal form-row-seperated view-profile-form','files'=>true]) !!}
                    <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">Agency Name</label>
                           <div class="col-md-9">
                              <label class="control-label">{{ (!empty($profileDetail->company)) ? $profileDetail->company:'' }}</label>
                           </div>
                        </div>
                     </div> 

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">Agency Address</label>
                           <div class="col-md-9">
                              <label class="control-label view_lable">{{ (!empty($profileDetail->address)) ? $profileDetail->address:'' }}</label>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">Agency Logo</label>
                           <div class="col-md-9">
                             @if($profileDetail->agency_image)
                                <img src="{{$profileDetail->agency_image}}" height="200px" width="200px" />
                              @else
                                No Logo found
                              @endif
                           </div>
                        </div>
                     </div>
                  
                      <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">Owner Name</label>
                           <div class="col-md-9">
                              <label class="control-label">{{ (!empty($profileDetail->owner_name)) ? $profileDetail->owner_name:'' }}</label>
                           </div>
                        </div>
                     </div>                     

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">Email</label>
                           <div class="col-md-9">
                              <label class="control-label view_lable">{{ (!empty($profileDetail->email)) ? $profileDetail->email:'' }}</label>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">Mobile</label>
                           <div class="col-md-9">
                              <label class="control-label view_lable">{{ (!empty($profileDetail->mobile)) ? $profileDetail->mobile:'' }}</label>
                           </div>
                        </div>
                     </div>

                     @if($profileDetail->agencyDocuments)
                        <div class="form-body">
                           <div class="form-group">
                              <label class="control-label col-md-3">Documents</label>
                              <div class="col-md-9">
                                 <div class="row">
                                    @if($profileDetail->agencyDocuments->certificate_image)
                                       <div class="col-md-2">
                                          <a href="{{$profileDetail->agencyDocuments->certificate_image}}" class="mix-preview fancybox-button view_img">
                                             <img style="height:100px; width:100px;" class="img-responsive" src="{{$profileDetail->agencyDocuments->certificate_image}}" />
                                             <center>View Document</center>
                                          </a>
                                       </div>
                                     @endif

                                      @if($profileDetail->agencyDocuments->id_proof)
                                       <div class="col-md-2">
                                          <a href="{{$profileDetail->agencyDocuments->id_proof}}" class="mix-preview fancybox-button view_img">
                                             <img style="height:100px; width:100px;" class="img-responsive" src="{{$profileDetail->agencyDocuments->id_proof}}" />
                                             <center>View Document</center>
                                          </a>
                                       </div>
                                     @endif
                                 </div>
                              </div>
                           </div>
                        </div>
                     @endif

                     <div class="form-actions">
                        <div class="row">
                           <div class="col-md-offset-3 col-md-9">
                              <a href="{{URL::to('agency/profile')}}" class="btn green">Edit Profile</a>
                           </div>
                        </div>
                     </div>
                  {!! Form::close() !!}
                  <!-- END FORM-->
               </div>
            </div>
         </div>
         <!-- END CONTENT -->
      </div>
   </div>
</div>
@endsection