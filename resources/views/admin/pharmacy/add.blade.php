@extends('admin.mainLayout.template')
@section('title')
@lang('pharmacy.add_pharmacy')
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
                    <a href="javascript:void(0);">@lang('pharmacy.add_pharmacy')</a>
                </li>
            </ul>

        </div>

        <div class="page-title">
            <div class="title_left">
                <h3> @lang('pharmacy.add_pharmacy')</h3>
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



        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->

        <div class="row">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-table"></i>@lang('pharmacy.add_pharmacy')
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                
                    <!-- BEGIN REGISTRATION FORM -->
      {!! Form::open(['route' => 'admin.save-pharmacy','class'=>'register-form form-horizontal form-row-seperated','id'=>'addPharmacy','enctype'=>'multipart/form-data']) !!}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">@lang('pharmacy.pharmacy_name')</label>
                                <div class="col-md-9">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="@lang('signup.pharmacy_name')" name="name"/>
                                     @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif 
                                    <div class="error"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">@lang('pharmacy.description')</label>
                                <div class="col-md-9">
                                    <textarea  class="form-control placeholder-no-fix" placeholder="@lang('signup.description')" name="description"></textarea>
                                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('description') }}</p> @endif 
                                </div>
                            </div>
                        </div>

                         <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">@lang('pharmacy.mobile_number')</label>
                                <div class="col-md-9">
                                    <input  class="form-control placeholder-no-fix"  type="number" placeholder="@lang('signup.mobile')" name="mobile"/>
                                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('mobile') }}</p> @endif
                                    <div class="error"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">@lang('pharmacy.email')</label>
                                <div class="col-md-9">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="@lang('signup.email')" name="email" id="email"/>
                                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                                    <div style="color:red" id="email_exist"></div>
                                </div>
                            </div>
                        </div>

                       

                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">@lang('pharmacy.password')</label>
                                <div class="col-md-9">
                                  <input  class="form-control placeholder-no-fix" type="password" autocomplete="off" id="password" placeholder="@lang('signup.password')" name="password"/>
                                  @if ($errors->has('name')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                                    <div class="error"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">@lang('pharmacy.address')</label>
                                <div class="col-md-9">
                                    <input  class="form-control placeholder-no-fix" type="text" id="address" placeholder="@lang('signup.address')" name="address"/>
                                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
                                    <div class="error"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">@lang('pharmacy.city')</label>
                                <div class="col-md-9">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="@lang('signup.city')" name="city"/>
                                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
                                    <div class="error"></div>
                                </div>
                            </div>
                        </div>
      
      
      
       <div class="form-body">
         <div class="form-group">
             <label class="control-label col-md-3">@lang('signup.latitude')</label>
           <div class="col-md-9">
            <input required="" data-parsley-required-message="@lang('pharmacy.please_enter_latitude')" class="form-control placeholder-no-fix" type="text" id="latitude" placeholder="@lang('signup.latitude')" name="latitude"/>
            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('latitude') }}</p> @endif
           </div>
         </div>  
        </div>  
         
       <div class="form-body">
         <div class="form-group">
              <label class="control-label col-md-3">@lang('signup.longitude')</label>
            <div class="col-md-9">
            <input required="" data-parsley-required-message="@lang('pharmacy.please_enter_longitude')" class="form-control placeholder-no-fix" type="text" id="longitude" placeholder="@lang('signup.longitude')" name="longitude"/>
            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('longitude') }}</p> @endif
            </div>
         </div> 
        </div>      <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">@lang('pharmacy.licence_image')</label>
                                <div class="col-md-9">
                                    <input  class="btn btn-success btn-m id-docs" type="file" placeholder="Licence image" name="licence_image">
                                    <div class="error"></div>
                                </div>
                            </div>
                        </div>
                        
                        
                         <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">@lang('pharmacy.pharmacy_image')</label>
                                <div class="col-md-9">
                                    <input required="" data-parsley-required-message="@lang('pharmacy.please_select_pharmacy_image')" class="btn btn-success btn-m id-docs" type="file" placeholder="pharmacy image" name="pharmacy_image">
                                    <div class="error"></div>
                                </div>
                            </div>
                        </div>
                        <input  class="btn btn-success btn-m id-docs" type="hidden" value="1" name="is_email_verified">
                        <input  class="btn btn-success btn-m id-docs" type="hidden" value="1" name="status">
                        
                      
                        
                        <div class="form-body">      
                           <div class="form-group">
                              <label class="control-label col-md-3">@lang('pharmacy.pharmacy_timing')</label>
                              <div class="col-md-9 controls">
                                 <div class="form-group row voca">
                                    <label class="control-label visible-ie8 visible-ie9">@lang('signup.open_time')</label>
                                    <div class="col-md-4">
                                       {!! Form::select('day[]', array(''=>'Day')+$days,null, ['class' => 'form-control','id'=>'day_0','required'=>'required','data-parsley-required-message'=>'Please select day']) !!}
                                    </div>
                                    <div class="col-md-3">
                                       <label class="control-label visible-ie8 visible-ie9">@lang('signup.open_time')</label>
                                       <input required="" data-parsley-required-message="please enter open time" class="form-control placeholder-no-fix" id="open_time_0" type="text" placeholder="@lang('signup.open_time_format')" name="open_time[]"/>
                                    </div>
                                    <div class="col-md-3">
                                       <label class="control-label visible-ie8 visible-ie9">@lang('signup.close_time')</label>
                                       <input required="" data-parsley-required-message="please enter close time" class="form-control placeholder-no-fix" id="close_time_0" type="text" placeholder="@lang('signup.close_time_format')" name="close_time[]"/>
                                    </div>
                                    <div class="col-md-1">                                       
                                       <button type="button" class="btn btn-success btn-add pull-right" >
                                          <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                       </button>
                                    </div>
                                 </div>
                              </div>            
                           </div>
                        </div>
                        
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">@lang('signup.submit')</button>
<!--                                    <button type="submit" class="btn green">Submit</button>-->
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
  
    <!-- END CONTENT -->
</div>
</div>

@endsection