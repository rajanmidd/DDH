@extends('merchant.mainLayout.template')
@section('title')
   @lang('account.manage_bank_account')
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
               <a href="javascript:void(0);">@lang('profile.manage_profile')</a>
            </li>
         </ul>
      </div>
      <h3 class="page-title">
         @lang('profile.manage_profile')
      </h3>
      <!-- END PAGE HEADER-->
      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
         <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="fa fa-table"></i>@lang('profile.manage_profile')
                  </div>
               </div>
               <div class="portlet-body form">
                  <!-- BEGIN FORM-->
                  {!! Form::model($profileDetail, ['method' => 'PATCH', 'route' => ['profile'], 'class'=>'form-horizontal form-row-seperated update-profile-form','files'=>true]) !!}
                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.pharmacy_name')</label>
                           <div class="col-md-9">
                              <input type="text" placeholder="@lang('signup.pharmacy_name')" class="form-control" name="name" value="{{ (!empty($profileDetail->name)) ? $profileDetail->name:'' }}"  />
                              <div class="error">{{ $errors->first('name') }}</div>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.description')</label>
                           <div class="col-md-9">
                              <input type="text" placeholder="@lang('signup.description')" class="form-control" name="description" value="{{ (!empty($profileDetail->description)) ? $profileDetail->description:'' }}"  />
                              <div class="error">{{ $errors->first('description') }}</div>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.email')</label>
                           <div class="col-md-9">
                              <input type="text" placeholder="@lang('signup.email')" class="form-control" name="email" value="{{ (!empty($profileDetail->email)) ? $profileDetail->email:'' }}"  />
                              <div class="error">{{ $errors->first('email') }}</div>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.mobile')</label>
                           <div class="col-md-9">
                              <input type="text" placeholder="@lang('signup.mobile')" class="form-control" name="mobile" value="{{ (!empty($profileDetail->mobile)) ? $profileDetail->mobile:'' }}"  />
                              <div class="error">{{ $errors->first('mobile') }}</div>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.city')</label>
                           <div class="col-md-9">
                              <input type="text" placeholder="@lang('signup.city')" class="form-control" name="city" value="{{ (!empty($profileDetail->city)) ? $profileDetail->city:'' }}"  />
                              <div class="error">{{ $errors->first('city') }}</div>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.address')</label>
                           <div class="col-md-9">
                              <input type="text" placeholder="@lang('signup.address')" class="form-control" id="address" name="address" value="{{ (!empty($profileDetail->address)) ? $profileDetail->address:'' }}"  />
                              <div class="error">{{ $errors->first('address') }}</div>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.latitude')</label>
                           <div class="col-md-9">
                              <input type="text" placeholder="@lang('signup.latitude')" class="form-control" id="latitude" name="latitude" value="{{ (!empty($profileDetail->latitude)) ? $profileDetail->latitude:'' }}"  />
                              <div class="error">{{ $errors->first('latitude') }}</div>
                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.longitude')</label>
                           <div class="col-md-9">
                              <input type="text" placeholder="@lang('signup.longitude')" class="form-control" id="longitude" name="longitude" value="{{ (!empty($profileDetail->longitude)) ? $profileDetail->longitude:'' }}"  />
                              <div class="error">{{ $errors->first('longitude') }}</div>
                           </div>
                        </div>
                     </div>
                  
                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('pharmacy.delivery_charge')</label>
                           <div class="col-md-9">
                              <input type="text" placeholder="@lang('pharmacy.delivery_charge')" class="form-control" id="delivery_charges" name="delivery_charges" value="{{ ($profileDetail->getDeliveryCharge) ? $profileDetail->getDeliveryCharge->amount:'' }}"  />
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
                                       <div class="col-md-4">
                                          {!! Form::select('day[]', array(''=>'Day')+$days,$value->day, ['class' => 'form-control','id'=>'day_'.$key]) !!}
                                       </div>
                                       <div class="col-md-3">
                                          <input type="text" placeholder="@lang('signup.open_time_format')" value="{{date("H:i",strtotime($value->open_time))}}" class="form-control" id="open_time_{{$key}}" name="open_time[]"  />
                                       </div>
                                       <div class="col-md-3">
                                          <input type="text" placeholder="@lang('signup.close_time_format')" value="{{date("H:i",strtotime($value->close_time))}}" class="form-control" id="close_time_{{$key}}" name="close_time[]"  />
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
                                       <input type="text" placeholder="@lang('signup.open_time_format')" class="form-control" id="open_time_0" name="open_time[]"  />
                                    </div>
                                    <div class="col-md-3">
                                       <input type="text" placeholder="@lang('signup.close_time_format')" class="form-control" id="close_time_0" name="close_time[]"  />
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

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.pharmacy_image')</label>
                           <div class="col-md-9">
                              <input type="file" name="phar_image" id="phar_image">

                           </div>
                        </div>
                     </div>

                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">@lang('signup.license_image')</label>
                           <div class="col-md-9">
                              <input type="file" name="license_image" id="license_image">
                           </div>
                        </div>
                     </div>

                     <div class="form-actions">
                        <div class="row">
                           <div class="col-md-offset-3 col-md-9">
                              <button type="submit" class="btn green">@lang('signup.submit')</button>
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