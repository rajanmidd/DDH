@extends('merchant.mainLayout.template')
@section('title')
   @lang('sidebar.add_inventory')
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
               <a href="javascript:void(0);">@lang('sidebar.add_inventory')</a>
            </li>
         </ul>
      </div>
      <h3 class="page-title">
         @lang('sidebar.inventory')
      </h3>
      <!-- END PAGE HEADER-->
      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
         <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="fa fa-table"></i>@lang('sidebar.add_inventory')
                  </div>
               </div>
               <div class="portlet-body form">
               <!-- BEGIN FORM-->
               {!! Form::open(['route' => 'merchant.add-inventory','class'=>'form-horizontal form-row-seperated','files'=>true]) !!}
                  <div class="form-body">
                     <div class="form-group">
                        <label class="control-label col-md-3">@lang('inventory.medicine_name')</label>
                        <div class="col-md-9">
                           <input type="text" placeholder="@lang('inventory.medicine_name')" class="form-control" name="name" value="{{ old('name') }}"  />
                           <div class="error">{{ $errors->first('name') }}</div>
                        </div>
                     </div>
                  </div>
                  
                  <div class="form-body">
                     <div class="form-group">
                        <label class="control-label col-md-3">@lang('inventory.description')</label>
                        <div class="col-md-9">
                           <input type="text" placeholder="@lang('inventory.description')" class="form-control" name="description" value="{{ old('description') }}"/>
                           <div class="error">{{ $errors->first('description') }}</div>
                        </div>
                     </div>
                  </div>
                  
                  <div class="form-body">
                     <div class="form-group">
                        <label class="control-label col-md-3">@lang('inventory.total_quantity')</label>
                        <div class="col-md-9">
                           <input type="text" placeholder="@lang('inventory.total_quantity')" class="form-control" name="quantity" value="{{ old('quantity') }}"/>
                           <div class="error">{{ $errors->first('quantity') }}</div>
                        </div>
                     </div>
                  </div>
               
                  <div class="form-body">
                     <div class="form-group">
                        <label class="control-label col-md-3">@lang('inventory.quantity_unit')</label>
                        <div class="col-md-9">
                           <select class="form-control" name="quantity_unit">
                              <option value="">@lang('inventory.select_quantity_unit')</option>
                              @foreach($units->all() as $key=>$item)
                                <option value="{{$key}}" @if (old('quantity_unit') == $key) selected="selected" @endif >{{$item}}</option>
                              @endforeach
                            </select>
                           <div class="error">{{ $errors->first('quantity_unit') }}</div>
                        </div>
                     </div>
                  </div>
                  
                  <div class="form-body">
                     <div class="form-group">
                        <label class="control-label col-md-3">@lang('inventory.price')</label>
                        <div class="col-md-9">
                           <input type="text" placeholder="@lang('inventory.price')" class="form-control" name="price" value="{{ old('price') }}"/>
                           <div class="error">{{ $errors->first('price') }}</div>
                        </div>
                     </div>
                  </div>
                  
                  <div class="form-body">
                     <div class="form-group">
                        <label class="control-label col-md-3">@lang('inventory.prescription')</label>
                        <div class="col-md-9">
                           <div class="radio-list">
                              <label>
                                 <input type="radio" name="prescription" value="1" @if(old('prescription') =="1") checked @endif />
                                 @lang('inventory.mandetory') 
                              </label>
                              <label>
                                 <input type="radio" name="prescription" value="2" @if(old('prescription') =="2") checked @endif />
                                 @lang('inventory.not_mandetory') 
                              </label>
                           </div>
                           <div class="error">{{ $errors->first('prescription') }}</div>
                        </div>
                     </div>
                  </div>
                  
                  <div class="form-body">
                     <div class="form-group">
                        <label class="control-label col-md-3">@lang('inventory.upload_image')</label>
                        <div class="col-md-9">
                           <input type="file" name="med_image" />
                           <div class="error">{{ $errors->first('med_image') }}</div>
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
@endsection