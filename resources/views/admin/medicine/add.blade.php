@extends('admin.mainLayout.template')
@section('title')
@lang('pharmacy.add_medicine')
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
                    <a href="javascript:void(0);">@lang('pharmacy.add_medicine')</a>
                </li>
            </ul>

        </div>

        <div class="page-title">
            <div class="title_left">
                <h3> @lang('pharmacy.add_medicine')</h3>
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
                        <i class="fa fa-table"></i>@lang('pharmacy.add_medicine')
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                <!-- BEGIN FORM-->
               {!! Form::open(['route' => 'admin.save-medicine','class'=>'form-horizontal form-row-seperated','id'=>'addMedicine','enctype'=>'multipart/form-data']) !!}
                  <div class="form-body">
                     <div class="form-group">
                        <label class="control-label col-md-3">@lang('inventory.medicine_name')</label>
                        <div class="col-md-9">
                           <input type="text" placeholder="@lang('inventory.medicine_name')" class="form-control" name="name" value="{{ old('name') }}"  />
                        </div>
                     </div>
                  </div>
                  
                  <div class="form-body">
                     <div class="form-group">
                        <label class="control-label col-md-3">@lang('inventory.description')</label>
                        <div class="col-md-9">
                           <input type="text" placeholder="@lang('inventory.description')" class="form-control" name="description" value="{{ old('description') }}"/>
                        </div>
                     </div>
                  </div>
                  
                  <div class="form-body">
                     <div class="form-group">
                        <label class="control-label col-md-3">@lang('inventory.total_quantity')</label>
                        <div class="col-md-9">
                           <input  type="text" placeholder="@lang('inventory.total_quantity')" class="form-control" name="quantity" value="{{ old('quantity') }}"/>
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
                          @if ($errors->has('select_quantity_unit')) <p class="help-block">{{ $errors->first('select_quantity_unit') }}</p> @endif 
                        </div>
                     </div>
                  </div>
                  
                  <div class="form-body">
                     <div class="form-group">
                        <label class="control-label col-md-3">@lang('inventory.price')</label>
                        <div class="col-md-9">
                           <input  type="text" placeholder="@lang('inventory.price')" class="form-control" name="price" value="{{ old('price') }}"/>
                        </div>
                     </div>
                  </div>
                  
                  <div class="form-body">
                     <div class="form-group">
                        <label class="control-label col-md-3">@lang('inventory.prescription')</label>
                        <div class="col-md-9">
                           <div class="radio-list">
                              <label>
                                 <input checked type="radio" name="prescription" value="1" @if(old('prescription') =="1") checked @endif />
                                 @lang('inventory.mandetory') 
                              </label>
                              <label>
                                 <input type="radio" name="prescription" value="2" @if(old('prescription') =="2") checked @endif />
                                 @lang('inventory.not_mandetory') 
                              </label>
                           </div>
                          
                        </div>
                     </div>
                  </div>
               <input type="hidden" name="pharmacy_id" value="{{app('request')->input('id') }}" />
                  <div class="form-body">
                     <div class="form-group">
                        <label class="control-label col-md-3">@lang('inventory.upload_image')</label>
                        <div class="col-md-9">
                           <input type="file" name="med_image" />
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
    </div>

    <!-- END CONTENT -->
</div>
</div>

@endsection