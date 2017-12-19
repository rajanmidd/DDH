@extends('admin.mainLayout.template')
@section('title')
{{trans('sidebar.' . $pageDetail->slug )}}
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
                    <a href="javascript:void(0);">{{trans('sidebar.' . $pageDetail->slug )}}</a>
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
            {{trans('sidebar.'.$pageDetail->slug)}}
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN SAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <ul class="nav nav-tabs" style="float:left">
                            <li @if($pageDetail->slug=='about-us') class="active" @endif><a href="{{URL::to('/admin/cms-pharmacy/about-us')}}">@lang('sidebar.about_us')</a></li>
                            <li @if($pageDetail->slug=='faq') class="active" @endif><a href="{{URL::to('/admin/cms-pharmacy/faq')}}">@lang('sidebar.faq')</a></li>
                            <!--<li @if($slug=='cms-contact-support') class="active" @endif><a href="{{URL::to('/admin/cms-contact-support')}}">@lang('sidebar.contact_support')</a></li>-->
                            <li @if($pageDetail->slug=='terms-condition') class="active" @endif><a href="{{URL::to('/admin/cms-pharmacy/terms-condition')}}">@lang('sidebar.terms_condition')</a></li>
                            <li @if($slug=='pharmacy-feedback') class="active" @endif><a href="{{URL::to('/admin/pharmacy-feedback')}}">@lang('sidebar.feedback')</a></li>
                        </ul>
                    </div>
                    <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-body">

                                    <div class="col-sm-12 well">
                                        {!! Form::open(['route' => 'admin.update-cms','role'=>'form','method'=>'post']) !!}

                                        <textarea class="form-control" id="text" name="text" placeholder="Type in your message" rows="5">{{$pageDetail->content}}</textarea>
                                        <div class="clearfix"></div>
                                        <input type="hidden" value="{{$pageDetail->id}}" name="id" />

                                        <button style="float:right;margin-top:20px" class="btn btn-info" type="submit">Update</button>

                                        {!! Form::close() !!}
                                    </div>       


<!--                <textarea rows="5" name="comment" form="usrform">{{$pageDetail->content}}</textarea>-->
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