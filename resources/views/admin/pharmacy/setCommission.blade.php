    @extends('admin.mainLayout.template')
@section('title')
   @lang('sidebar.set_commision')
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
               <a href="javascript:void(0);">@lang('sidebar.set_commision')</a>
            </li>
         </ul>
      </div>

      <div class="page-title">
         <div class="title_left">
            <h3> @lang('sidebar.set_commision')</h3>
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
                     @endif
                     @if($pharmacyDetail['status']==1)
                        <li role="presentation" class="<?php echo $status4; ?>"><a href="{{URL::to('/admin/set-comission')}}?id={{$pharmacyDetail['id']}}" id="tab4" role="tab" aria-expanded="true">@lang('profile.set_commission')</a>
                        </li>
                     @endif
                  </ul>
               </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
               <!-- BEGIN REGISTRATION FORM -->
               {!! Form::open(['route' => 'add-tax','class'=>'set_commision form-horizontal form-row-seperated','id'=>'','enctype'=>'multipart/form-data']) !!}
              
                  <input type="hidden" name="phar_id" value="<?php  if(isset($_GET['id']) & !empty($_GET['id'])) { echo $_GET['id']; }?>" />
                  <div class="form-body">
                     <div class="form-group">
                        <label class="control-label col-md-2">@lang('sidebar.set_commission')</label>
                        <div class="col-md-4">
                           <input type="text" class="form-control" id="admin_commision" name="admin_commision" value="{{($phar_discount)?$phar_discount->discount:''}}"  />
                        </div>
                     </div>
                  </div>
               

                  <div class="form-body">
                     <div class="form-group">
                        <label class="control-label col-md-2">@lang('sidebar.deliver_charges')</label>
                        <div class="col-md-4">
                           <input type="text" class="form-control" id="delivery_charges" name="delivery_charges" value="{{(isset($pharmacyTax[0]) && !empty($pharmacyTax[0]['label'] =='Delivery')) ?$pharmacyTax[0]['amount']:''}}"/>
                        </div>
                     </div>
                  </div>
                  <div class="form-body">
                     <div class="form-group">
                        <label class="control-label col-md-2">@lang('sidebar.add_tax')</label>
                        <div class="col-md-9">
                           <span><a href="javascript:void(0);" class="add_more">Add</a></span>
                           <div class="controlss">    
                              @if(count($pharmacyTax) > 1)
                              <?php $i=0;?>
                                 @foreach($pharmacyTax as $key=>$sub_array)
                                    @if($sub_array['label'] != 'Commission' && $sub_array['label'] != 'Delivery')
                                       <div class="form-group timingss">
                                          <div class="col-md-4">
                                             <input type="text" class="form-control" id="label_{{$i}}" name="label[]" placeholder="label" value="{{$sub_array['label']}}" >
                                          </div>
                                          <div class="col-md-3">
                                             <input type="text" class="form-control" id="value_{{$i}}" name="value[]" placeholder="value" value="{{$sub_array['amount']}}">
                                          </div>
                                          <div class="col-md-3">
                                             <select class="form-control" id="type_{{$i}}" name="type[]">
                                                <option value="">Select Type</option>
                                                <option value="1" @if($sub_array['type'] =='1') {{'selected'}} @endif >Percentage</option>
                                                <option value="2" @if($sub_array['type'] =='2') {{'selected'}} @endif >Fixed</option>
                                             </select>
                                          </div>
                                          <div class="col-md-2">
                                             <span><a href="javascript:void(0);" class="remove_more"> Remove</a></span>
                                          </div>
                                       </div>
                                    <?php $i++;?>
                                    @endif
                                 @endforeach
                              @endif
                           </div>
                        </div>
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
@endsection