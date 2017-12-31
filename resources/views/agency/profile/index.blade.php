@extends('agency.mainLayout.template')
@section('title')
   Manage Profile
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
               <a href="javascript:void(0);">Manage Profile</a>
            </li>
         </ul>
      </div>
      <h3 class="page-title">
         Manage Profile
      </h3>
      <!-- END PAGE HEADER-->
      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
         <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="fa fa-table"></i>Manage Profile
                  </div>
               </div>
               <div class="portlet-body form">
                  <!-- BEGIN FORM-->
                  {!! Form::model($profileDetail, ['method' => 'PATCH', 'route' => ['profile'], 'class'=>'form-horizontal form-row-seperated update-profile-form','files'=>true]) !!}
                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">Owner Name</label>
                           <div class="col-md-9">
                              <input type="text" placeholder="Owner Name" class="form-control" name="owner_name" value="{{ (!empty($profileDetail->owner_name)) ? $profileDetail->owner_name:'' }}"  />
                              <div class="error">{{ $errors->first('owner_name') }}</div>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">Address</label>
                           <div class="col-md-9">
                              <input type="text" placeholder=Address" class="form-control" name="address" value="{{ (!empty($profileDetail->address)) ? $profileDetail->address:'' }}"  />
                              <div class="error">{{ $errors->first('address') }}</div>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">Email</label>
                           <div class="col-md-9">
                              <input type="text" placeholder="Email" class="form-control" name="email" value="{{ (!empty($profileDetail->email)) ? $profileDetail->email:'' }}"  />
                              <div class="error">{{ $errors->first('email') }}</div>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">Mobile</label>
                           <div class="col-md-9">
                              <input type="text" placeholder="Mobile" class="form-control" name="mobile" value="{{ (!empty($profileDetail->mobile)) ? $profileDetail->mobile:'' }}"  />
                              <div class="error">{{ $errors->first('mobile') }}</div>
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

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">Certificate Image</label>
                           <div class="col-md-9">
                              <input type="file" name="certificate_image" id="certificate_image">

                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">Id Proof</label>
                           <div class="col-md-9">
                              <input type="file" name="id_proof" id="id_proof">
                           </div>
                        </div>
                     </div>

                     <div class="form-actions">
                        <div class="row">
                           <div class="col-md-offset-3 col-md-9">
                              <button type="submit" class="btn green">Save Profile</button>
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