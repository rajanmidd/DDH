@extends('admin.mainLayout.template')
@section('title')
@lang('pharmacy.manage_profile')
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
               <a href="{{URL::to('/admin/admin-dashboard')}}">@lang('sidebar.home')</a>
               <i class="fa fa-angle-right"></i>
            </li>
            <li>
               <a href="javascript:void(0);">@lang('pharmacy.manage_profile')</a>
            </li>
         </ul>
      </div>

      <div class="page-title">
         <div class="title_left">
            <h3> @lang('pharmacy.manage_profile')</h3>
         </div>
      </div>

      @if (session()->has('success'))
      <div class="row">
         <div class="col-xs-1"></div> 
         <div class="col-xs-10"> 
            <div class="alert alert-success">      
               <p>{!! session()->get('success') !!}</p>
            </div>
         </div>
         <div class="col-xs-1"></div>
      </div>
      @endif

      @if (session()->has('error'))
      <div class="row">
         <div class="col-xs-1"></div> 
         <div class="col-xs-10"> 
            <div class="alert alert-error">      
               <p>{!! session()->get('error') !!}</p>
            </div>
         </div>
         <div class="col-xs-1"></div>
      </div>
      @endif

      <div class="row">
         <?php //echo "<pre>"; print_r($pharmacyDetail['name']); die; ?>
         <div class="portlet box">
            <div class="col-xs-12 green"> 
               <div class="" role="tabpanel" data-example-id="togglable-tabs">
                  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                     <li role="presentation" class="<?php echo $status1; ?>">
                        <a href="{{URL::to('/admin/pharmacy-profile')}}?id={{$pharmacyDetail['id']}}" id="tab1" role="tab" aria-expanded="true">@lang('profile.profile')</a>
                     </li>
                     @if($pharmacyDetail['status']==1)
                        <li role="presentation" class="<?php echo $status2; ?>"><a href="{{URL::to('/admin/medicines')}}?id={{$pharmacyDetail['id']}}" id="tab2" role="tab" aria-expanded="true">@lang('profile.medicines')</a>
                        </li>
                        <li role="presentation" class="<?php echo $status3; ?>"><a href="{{URL::to('/admin/pharmacy-orders')}}?id={{$pharmacyDetail['id']}}" role="tab" id="tab3" aria-expanded="false">@lang('profile.orders')</a>
                        </li>
                        <li role="presentation" class="<?php echo $status4; ?>"><a href="{{URL::to('/admin/set-comission')}}?id={{$pharmacyDetail['id']}}" id="tab4" role="tab" aria-expanded="true">@lang('profile.set_commission')</a>
                        </li>
                     @endif
                  </ul>
               </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="profile_img form-group">
                        <div id="crop-avatar" >
                           <img class="img-responsive avatar-view" style="max-height: 150px;"src="{{$image['phar_image']}}" alt="Avatar" title="Change the avatar">
                        </div>
                        </br>                  
                        <div id="crop-avatar">
                           @if ($pharmacyDetail['status']== 0)
                              <a data-toggle="modal" data-target="#IDModalReason-{{$pharmacyDetail['id']}}" onclick="return acceptPharmacy({{$pharmacyDetail['id']}})" class="btn btn-success add_field_button_skype">@lang('profile.accept')</a>
                              <a data-toggle="modal" data-target="#IDModalReason-{{$pharmacyDetail['id']}}" onclick="return rejectPharmacy({{$pharmacyDetail['id']}})" class="btn btn-danger add_field_button_skype">@lang('profile.reject')</a>
                           @elseif ($pharmacyDetail['status']== 1)
                              <a data-toggle="modal" data-target="#IDModalReason-{{$pharmacyDetail['id']}}" onclick="return rejectPharmacy({{$pharmacyDetail['id']}})" class="btn btn-danger add_field_button_skype">@lang('profile.reject')</a>
                           @else
                              <a data-toggle="modal" data-target="#IDModalReason-{{$pharmacyDetail['id']}}" onclick="return acceptPharmacy({{$pharmacyDetail['id']}})" class="btn btn-success add_field_button_skype">@lang('profile.accept')</a>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
               
               
            </div>

            <div class="col-md-9 col-sm-9 col-xs-12">
               <!-- BEGIN REGISTRATION FORM -->
               {!! Form::open(['route' => 'admin.update-pharmacy','class'=>'register-form form-horizontal form-row-seperated','id'=>'addPharmacy','enctype'=>'multipart/form-data']) !!}
               <input type="hidden" name="phar_id" value="<?php if(isset($_GET['id']) & !empty($_GET['id'])) { echo $_GET['id']; }?>" />
               <div class="form-body">
                  <div class="form-group">
                     <label class="control-label col-md-3">@lang('pharmacy.pharmacy_name')</label>
                     <div class="col-md-9">
                        <input class="form-control placeholder-no-fix" type="text" placeholder="@lang('signup.pharmacy_name')" name="name" value="{{$pharmacyDetail['name']}}" />
                     </div>
                  </div>
               </div>

               <div class="form-body">
                  <div class="form-group">
                     <label class="control-label col-md-3">@lang('pharmacy.description')</label>
                     <div class="col-md-9">
                        <textarea class="form-control placeholder-no-fix" placeholder="@lang('signup.description')" name="description">{{$pharmacyDetail['description']}}</textarea>
                     </div>
                  </div>
               </div>

               <div class="form-body">
                  <div class="form-group">
                     <label class="control-label col-md-3">@lang('pharmacy.mobile_number')</label>
                     <div class="col-md-9">
                        <input  class="form-control placeholder-no-fix"  type="number" placeholder="@lang('signup.mobile')" name="mobile" value="{{$pharmacyDetail['mobile']}}"/>
                     </div>
                  </div>
               </div>

               <div class="form-body">
                  <div class="form-group">
                     <label class="control-label col-md-3">@lang('pharmacy.email')</label>
                     <div class="col-md-9">
                        <input disabled class="form-control placeholder-no-fix" type="text" placeholder="@lang('signup.email')" id="email" value="{{$pharmacyDetail['email']}}"/>
                     </div>
                  </div>
               </div>

               <div class="form-body">
                  <div class="form-group">
                     <label class="control-label col-md-3">@lang('pharmacy.address')</label>
                     <div class="col-md-9">
                        <input class="form-control placeholder-no-fix" type="text" id="address" placeholder="@lang('signup.address')" name="address" value="{{$pharmacyDetail['address']}}"/>
                     </div>
                  </div>
               </div>

               <div class="form-body">
                  <div class="form-group">
                     <label class="control-label col-md-3">@lang('pharmacy.city')</label>
                     <div class="col-md-9">
                        <input  class="form-control placeholder-no-fix" type="text" placeholder="@lang('signup.city')" name="city" value="{{$pharmacyDetail['city']}}"/>
                     </div>
                  </div>
               </div>

               <div class="form-body">
                  <div class="form-group">
                     <label class="control-label col-md-3">@lang('signup.latitude')</label>
                     <div class="col-md-9">
                        <input class="form-control placeholder-no-fix" type="text" id="latitude" placeholder="@lang('signup.latitude')" name="latitude" value="{{$pharmacyDetail['latitude']}}"/>
                     </div>
                  </div>  
               </div>  

               <div class="form-body">
                  <div class="form-group">
                     <label class="control-label col-md-3">@lang('signup.longitude')</label>
                     <div class="col-md-9">
                        <input class="form-control placeholder-no-fix" type="text" id="longitude" placeholder="@lang('signup.longitude')" name="longitude" value="{{$pharmacyDetail['longitude']}}"/>
                     </div>
                  </div> 
               </div> 


               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">@lang('pharmacy.licence_image')</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">

                     @if ($image['license_image']!='')
                     <a href="{{$image['license_image']}}" title="Licence Image" target="_blank"><button type="button" class="btn btn-info btn-xs">View</button></a>
                     <a href="{{URL::to('/admin/delete-image')}}?id={{app('request')->input('id') }}&type=license_image" title="Delete licence image" onclick="return confirm('Are you sure you want to delete this uploaded image?');"> <button type="button" class="btn btn-danger btn-xs">Delete</button></a> 
                     @endif
                     <button type="button" class="btn btn-success btn-xs  SetModel" data-toggle="modal" data-target="#IDModal-{{ app('request')->input('id') }}" onclick="setModel('license_image')">Upload</button>
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">@lang('pharmacy.pharmacy_image')</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                     @if ($image['phar_image']!='')
                     <a href="{{$image['phar_image']}}" title="Pharmacy Image" target="_blank"><button type="button" class="btn btn-info btn-xs">View</button></a>
                     <a href="{{URL::to('/admin/delete-image')}}?id={{app('request')->input('id') }}&type=phar_image" title="delete uploaded doc" onclick="return confirm('Are you sure you want to delete this uploaded Image?');"> <button type="button" class="btn btn-danger btn-xs">Delete</button></a>
                     @endif
                     <button type="button" class="btn btn-success btn-xs  SetModel" data-toggle="modal" data-target="#IDModal-{{ app('request')->input('id') }}" onclick="setModel('phar_image')">Upload</button>
                  </div>
               </div>
               
               <div class="form-group">
                  <label class="control-label col-md-3">@lang('signup.select_shop_timings')</label>
                  <div class="col-md-9 shop controls">
                     @if(count($pharmacyDetail->pharTimings) >0)
                        @foreach($pharmacyDetail->pharTimings as $key=>$value)
                           <div class="form-group timings">
                              <div class="col-md-4">
                                 {!! Form::select('day[]', array(''=>'Day')+$days,$value->day, ['class' => 'form-control','id'=>'day_'.$key]) !!}
                              </div>
                              <div class="col-md-3">
                                 <input type="text" placeholder="@lang('signup.open_time')" value="{{date("H:i",strtotime($value->open_time))}}" class="form-control" id="open_time_{{$key}}" name="open_time[]"  />
                              </div>
                              <div class="col-md-3">
                                 <input type="text" placeholder="@lang('signup.close_time')" value="{{date("H:i",strtotime($value->close_time))}}" class="form-control" id="close_time_{{$key}}" name="close_time[]"  />
                              </div>
                              <div class="col-md-1">         
                                 @if($key==0)
                                    <button type="button" class="btn btn-success btn-add-2 pull-right" >
                                       <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                    </button>
                                 @else
                                    <button type="button" class="btn btn-success pull-right btn-danger btn-remove-2">
                                       <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> 
                                    </button>
                                 @endif
                              </div>
                           </div>
                        @endforeach
                     @else
                        <div class="form-group">
                           <div class="col-md-4">
                              {!! Form::select('day[]', array(''=>'Day')+$days,null, ['class' => 'form-control','id'=>'day_0']) !!}
                           </div>
                           <div class="col-md-3">
                              <input type="text" placeholder="@lang('signup.open_time')" class="form-control" id="open_time_0" name="open_time[]"  />
                           </div>
                           <div class="col-md-3">
                              <input type="text" placeholder="@lang('signup.close_time')" class="form-control" id="close_time_0" name="close_time[]"  />
                           </div>
                           <div class="col-md-1">  
                              <button type="button" class="btn btn-success btn-add-2 pull-right" >
                                 <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                              </button>
                           </div>
                        </div>
                     @endif
                  </div>
               </div>

               <div class="form-actions">
                  <div class="row">
                     <div class="col-md-5">
                        <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">@lang('signup.submit')</button>
                     </div>
                  </div>
               </div>
               {!! Form::close() !!}
            </div>
         </div>
      </div>
   </div>
</div>


<!-- END CONTENT -->
</div>
</div>

<!-- Modal for image --> 
<div id="IDModal-{{ app('request')->input('id') }}" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      {!! Form::open(['route' => 'admin.upload-image','class'=>'register-form form-horizontal form-row-seperated', 'onSubmit'=>'return checkUplaodDocs("IDProof");','enctype'=>'multipart/form-data']) !!}
      <!--<form class="form-horizontal form-label-left" enctype="multipart/form-data" onsubmit="return checkUplaodDocs('IDProof');" action="{{URL::to('/admin/upload-image')}}" method="post">-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Upload</h4>
         </div>
         <div class="modal-body">


            <div class="form-group">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="file" class="form-control filestyle IDProof" name="IDProof" value="upload ID" data-size="sm" id="IDProof">
                  <input type="hidden" name="ID" value="{{ app('request')->input('id') }}" id="pharmacyId">
                  <input type="hidden" name="uploadType" value="" id="uploadType">
                  <img src="" id="blah" style="display:none;">
               </div>
            </div>

         </div>
         <div class="modal-footer">

            <button type="submit" class="btn btn-default">Upload</button> 

            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>

      </div>
      {!! Form::close() !!}
   </div>
</div>

<!-- Modal for ID docs --> 
<div id="IDModalReason-{{ app('request')->input('id') }}" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <!--<form class="form-horizontal form-label-left" id="carBlock" enctype="multipart/form-data"  action="block-unblock-car" method="post">-->
      {!! Form::open(['route' => 'admin.pharmacy-accept','class'=>'register-form form-horizontal form-row-seperated','enctype'=>'multipart/form-data']) !!}

      <input type="hidden" name="pharmacy_id_field" id="pharmacy_id_field" value="" />
      <input type="hidden" name="pharmacy_status" id="pharmacy_status" value="" />
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@lang('pharmacy.message')</h4>
         </div>
         <div class="modal-body">


            <div class="form-group">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">@lang('pharmacy.reason')</label>
                     <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea name="reason" required="" data-parsley-required-message="Please enter reason" id="reason" class="resizable_textarea form-control" placeholder="enter reason.." style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 54px;"></textarea>
                     </div>
                  </div>
               </div>
            </div>

         </div>
         <div class="modal-footer">

            <button type="submit" class="btn btn-default">@lang('pharmacy.submit')</button> 

            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('pharmacy.close')</button>
         </div>

      </div>
      {!! Form::close() !!}
   </div>
</div>

<!-- end -->


@endsection