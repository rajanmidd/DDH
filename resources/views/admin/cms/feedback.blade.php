@extends('admin.mainLayout.template')
@section('title')
{{trans('sidebar.' . $slug )}}
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
                    <a href="javascript:void(0);">@lang('sidebar.feedback')</a>
                </li>
            </ul>
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



        <h3 class="page-title">
            @lang('sidebar.feedback')
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN SAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <ul class="nav nav-tabs" style="float:left">
                            <li @if($slug=='about-us') class="active" @endif><a href="{{URL::to('/admin/cms-pharmacy/about-us')}}">@lang('sidebar.about_us')</a></li>
                            <li @if($slug=='faq') class="active" @endif><a href="{{URL::to('/admin/cms-pharmacy/faq')}}">@lang('sidebar.faq')</a></li>
                            <li @if($slug=='terms-condition') class="active" @endif><a href="{{URL::to('/admin/cms-pharmacy/terms-condition')}}">@lang('sidebar.terms_condition')</a></li>
                            <li @if($slug=='pharmacy-feedback') class="active" @endif><a href="{{URL::to('/admin/pharmacy-feedback')}}">@lang('sidebar.feedback')</a></li>
                        </ul>
                    </div>
                    <div class="portlet-body form">
                        <div class="row">
                            @if(count($feedback)>0)
                            @foreach($feedback as $key=>$value)
                            <div class="col-md-12">
                                <div class="form-body">
                                    <div class="media">
                                        <div class="media-body">
                                           <h4 class="media-heading"><b>{{$value->pharDetails['name']}}</b><span>
                                                     {{date('d/m/Y',strtotime($value['created_at']))}} <a href="javascript:;">
                                                        </a>
                                                </span>
                                            </h4>
                                            <p>
                                                {{$value['feedback']}}
                                            </p>
                                        </div>
                                    </div>         
                                </div>
                            </div>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8"><center>@lang('user.result_not_found')</center></td>
                             </tr>
                             @endif
                            
                        </div>  
                        
                         <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="dataTables_paginate paging_bootstrap_full_number pull-right" id="sample_1_paginate">
                           {{$feedback->links() }}
                            </div>
                        </div>
                    </div>
                        
                        
                        
                    </div>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
    </div>
</div>
@endsection