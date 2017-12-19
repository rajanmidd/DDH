@extends('merchant.mainLayout.template')
@section('title')
   @lang('profile.view_profile')
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
               <a href="{{URL::to('/merchant/merchant-dashboard')}}">@lang('sidebar.home')</a>
               <i class="fa fa-angle-right"></i>
            </li>
            <li>
               <a href="javascript:void(0);">@lang('profile.view_profile')</a>
            </li>
         </ul>
      </div>
      <h3 class="page-title">
         @lang('profile.view_profile')
      </h3>
      <!-- END PAGE HEADER-->
      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
         <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="fa fa-table"></i>@lang('profile.view_profile')
                  </div>
               </div>
               <div class="portlet-body form">
                  <!-- BEGIN FORM-->
                  {!! Form::model($profileDetail, ['method' => 'PATCH', 'route' => ['profile'], 'class'=>'form-horizontal form-row-seperated view-profile-form','files'=>true]) !!}
                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.pharmacy_name')</label>
                           <div class="col-md-9">
                              <label class="control-label">{{ (!empty($profileDetail->name)) ? $profileDetail->name:'' }}</label>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.description')</label>
                           <div class="col-md-9">
                              <label class="control-label view_lable">{{ (!empty($profileDetail->description)) ? $profileDetail->description:'' }}</label>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.email')</label>
                           <div class="col-md-9">
                              <label class="control-label view_lable">{{ (!empty($profileDetail->email)) ? $profileDetail->email:'' }}</label>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.mobile')</label>
                           <div class="col-md-9">
                              <label class="control-label view_lable">{{ (!empty($profileDetail->mobile)) ? $profileDetail->mobile:'' }}</label>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.city')</label>
                           <div class="col-md-9">
                              <label class="control-label view_lable">{{ (!empty($profileDetail->city)) ? $profileDetail->city:'' }}</label>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.address')</label>
                           <div class="col-md-9">
                              <label class="control-label view_lable">{{ (!empty($profileDetail->address)) ? $profileDetail->address:'' }}</label>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.latitude')</label>
                           <div class="col-md-9">
                              <label class="control-label view_lable">{{ (!empty($profileDetail->latitude)) ? $profileDetail->latitude:'' }}</label>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.longitude')</label>
                           <div class="col-md-9">
                              <label class="control-label view_lable">{{ (!empty($profileDetail->longitude)) ? $profileDetail->longitude:'' }}</label>
                           </div>
                        </div>
                     </div>
                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('pharmacy.delivery_charge')</label>
                           <div class="col-md-9">
                              <label class="control-label view_lable">{{ ($profileDetail->getDeliveryCharge) ? $profileDetail->getDeliveryCharge->amount:'' }}</label>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.select_shop_timings')</label>
                           <div class="col-md-9 shop controls">
                              @if(count($profileDetail->pharTimings) >0)
                                 @foreach($profileDetail->pharTimings as $key=>$value)
                                    <div class="form-group timings">
                                       <div class="row">
                                          <div class="col-md-4">
                                             {{ucfirst($value->day)}}
                                          </div>
                                          <div class="col-md-3">
                                             {{date("H:i",strtotime($value->open_time))}}
                                          </div>
                                          <div class="col-md-3">
                                             {{date("H:i",strtotime($value->close_time))}}
                                          </div>
                                       </div>
                                    </div>
                                 @endforeach
                              @endif
                           </div>
                        </div>
                     </div>
                     
                     @if($profileDetail->pharDocuments)
                        <div class="form-body">
                           <div class="form-group">
                              <label class="control-label col-md-3">@lang('sidebar.documents')</label>
                              <div class="col-md-9">
                                 <div class="row">
                                    @if($profileDetail->pharDocuments->phar_image)
                                       <div class="col-md-2">
                                          <a href="{{$profileDetail->pharDocuments->phar_image}}" class="mix-preview fancybox-button view_img">
                                             <img style="height:100px; width:100px;" class="img-responsive" src="{{$profileDetail->pharDocuments->phar_image}}" />
                                             <center>@lang('sidebar.phar_image_view')</center>
                                          </a>
                                       </div>
                                     @endif

                                      @if($profileDetail->pharDocuments->license_image)
                                       <div class="col-md-2">
                                          <a href="{{$profileDetail->pharDocuments->license_image}}" class="mix-preview fancybox-button view_img">
                                             <img style="height:100px; width:100px;" class="img-responsive" src="{{$profileDetail->pharDocuments->license_image}}" />
                                             <center>@lang('sidebar.license_image_view')</center>
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
                              <a href="{{URL::to('merchant/profile')}}" class="btn green">@lang('profile.edit_profile')</a>
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