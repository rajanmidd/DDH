@extends('admin.mainLayout.template')
@section('title')
@lang('quantityUnit.add_quantity_unit')
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
                    <a href="javascript:void(0);">@lang('quantityUnit.add_quantity_unit')</a>
                </li>
            </ul>

        </div>

        <div class="page-title">
            <div class="title_left">
                <h3> @lang('quantityUnit.add_quantity_unit')</h3>
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
                        <i class="fa fa-table"></i> @lang('quantityUnit.add_quantity_unit')
                    </div>
                </div>
               
                <div class="portlet-body flip-scroll">
                    <!-- BEGIN FORM-->
                    {!! Form::open(['route' => 'admin.add-quantity-unit','id'=>'addQuantityUnit','class'=>'form-horizontal form-row-seperated','enctype'=>'multipart/form-data']) !!}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">@lang('quantityUnit.name')</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="@lang('quantityUnit.name')" class="form-control" name="name"   />
                            </div>
                        </div>
                    </div>


                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Status</label>
                            <div class="col-md-9">
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                  
                                </select>
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