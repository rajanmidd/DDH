@extends('agency.mainLayout.template')
  @section('title')
    View Package :: {{ucfirst($comboDetail['combo_name'])}}
  @endsection
@section('content')
<?php 
use App\Helpers\CustomHelper;
?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="{{URL::to('/agency/agency-dashboard')}}">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">View Combo Package</a>
                </li>
            </ul>
         </div>
        <h3 class="page-title">
            View Combo Package : {{ucfirst($comboDetail['combo_name'])}}
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS -->
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line boxless tabbable-reversed">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet box yellow">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> Combo Package Information 
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body">  
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <dl class="dl-horizontal">
                                                        <dt>Package Name : </dt>
                                                        <dd>{{ucfirst($comboDetail['combo_name'])}}</dd>
                                                        <dt>Package Title :</dt>
                                                        <dd>{{ucfirst($comboDetail['combo_title'])}}</dd>
                                                        @if($comboDetail['camping'] ==1)
                                                            <dt>Days :</dt>
                                                            <dd>{{$comboDetail['days']}}</dd>
                                                        @endif
                                                    </dl>
                                                </div>
                                                <div class="col-md-6">
                                                    <dl class="dl-horizontal">
                                                        <dt>Location :</dt>
                                                        <dd>{{$comboDetail['combo_location']}}</dd>
                                                        @if($comboDetail['camping'] ==1)
                                                            <dt>Double Sharing Price :</dt>
                                                            <dd>{{$comboDetail['double_sharing']}}</dd>
                                                            <dt>Tripe/Quarter Sharing</dt>
                                                            <dd>{{$comboDetail['triple_sharing']}}</dd>                                                        
                                                            <dt>Night :</dt>
                                                            <dd>{{$comboDetail['night']}}</dd>
                                                        @endif
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <dt>Package Description</dt>
                                                    <dd>{{$comboDetail['combo_description']}}</dd>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($comboDetail['camping'] ==1)
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> Combo Package Itinerary
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <ul class="list-group">                                            
                                                @if(count($comboDetail->comboItinerary)>0 )
                                                    @foreach($comboDetail->comboItinerary as $key=>$value)
                                                        <li class="list-group-item">  
                                                            <h4>Day {{$key+1}}</h4>                                                 
                                                            {{$value['day_text']}}
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 col-sm-12">    
                                                        <div class="form-group">                                                    
                                                            <center>Sorry, No Itinerary Found </center>
                                                        </div>
                                                    </div>
                                                @endif
                                            </ul>
                                        </div>                                        
                                    </div>
                                </div>
                                @endif
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> Combo Package Services
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <ul class="list-group">                                      
                                                @if(count($comboDetail->comboService)>0 )
                                                    @foreach($comboDetail->comboService as $key=>$value)                                                        
                                                        <li class="list-group-item">  
                                                            <h4>{{ucfirst(str_replace('_',' ',$value['service_name']))}}</h4>
                                                            @if($value['service_value'] != null || $value['service_value']!="" )
                                                                <?php $service_value=json_decode($value['service_value'],true);?>
                                                                <ul>
                                                                    @foreach($service_value as $key1=>$value1)
                                                                        <li>{{ucfirst(str_replace('_',' ',$key1))}} : {{$value1}}</li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 col-sm-12">    
                                                        <div class="form-group">                                                    
                                                            <center>Sorry, No Camp Service Found </center>
                                                        </div>
                                                    </div>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>Meal
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <ul class="list-group">                                            
                                                @if(count($comboDetail->comboMeal)>0 )
                                                    @foreach($comboDetail->comboMeal as $key=>$value)
                                                        <li class="list-group-item">                                                   
                                                            {{$value['file_url']}}
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 col-sm-12">    
                                                        <div class="form-group">                                                    
                                                            <center>Sorry, No Meal Found </center>
                                                        </div>
                                                    </div>
                                                @endif
                                            </ul>
                                        </div>                                        
                                    </div>
                                </div>

                                <div class="portlet box yellow">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>Inclusions Details
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <ul class="list-group">                                            
                                                @if(count($comboDetail->comboInclusion)>0 )
                                                    @foreach($comboDetail->comboInclusion as $key=>$value)
                                                        <li class="list-group-item">                                                   
                                                            {{$value['file_url']}}
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 col-sm-12">    
                                                        <div class="form-group">                                                    
                                                            <center>Sorry, No Inclusions Details Found </center>
                                                        </div>
                                                    </div>
                                                @endif
                                            </ul>
                                        </div>                                        
                                    </div>
                                </div>

                                <div class="portlet box purple-plum">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>Exclusion Details 
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <ul class="list-group">                                            
                                                @if(count($comboDetail->comboExclusion)>0 )
                                                    @foreach($comboDetail->comboExclusion as $key=>$value)
                                                        <li class="list-group-item">                                                   
                                                            {{$value['file_url']}}
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 col-sm-12">    
                                                        <div class="form-group">                                                    
                                                            <center>Sorry, No Exclusion Details Found </center>
                                                        </div>
                                                    </div>
                                                @endif
                                            </ul>
                                        </div>                                        
                                    </div>
                                </div>


                                <div class="portlet box red">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>Terms & Conditions 
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <ul class="list-group">                                            
                                                @if(count($comboDetail->comboTerms)>0 )
                                                    @foreach($comboDetail->comboTerms as $key=>$value)
                                                        <li class="list-group-item">                                                   
                                                            {{$value['file_url']}}
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 col-sm-12">    
                                                        <div class="form-group">                                                    
                                                            <center>Sorry, No Terms & Conditions Found </center>
                                                        </div>
                                                    </div>
                                                @endif
                                            </ul>
                                        </div>                                        
                                    </div>
                                </div>


                                <div class="portlet box yellow">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>
                                            Special Notes 
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <ul class="list-group">                                            
                                                @if(count($comboDetail->comboNotes)>0 )
                                                    @foreach($comboDetail->comboNotes as $key=>$value)
                                                        <li class="list-group-item">                                                   
                                                            {{$value['file_url']}}
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 col-sm-12">    
                                                        <div class="form-group">                                                    
                                                            <center>Sorry, No Notes Found </center>
                                                        </div>
                                                    </div>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="portlet box grey-cascade">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>
                                            Images
                                        </div>
                                    </div>
                                    <div class="portlet-body form">                                    
                                        <div class="form-body actimages">
                                            <div class="row">
                                                @if(count($comboDetail->comboImages)>0 )
                                                    @foreach($comboDetail->comboImages as $key=>$value)
                                                        <div class="col-md-3 col-sm-3">
                                                            <img class="img-responsive" src="{{$value['file_url']}}" />
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 col-sm-12">    
                                                        <div class="form-group">                                                    
                                                            <center>Sorry, No Images Found </center>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>Videos
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body actimages">
                                            <div class="row">
                                                @if(count($comboDetail->comboVideos)>0 )
                                                    @foreach($comboDetail->comboVideos as $key=>$value)
                                                        <div class="col-md-3 col-sm-3">                                                        
                                                            <video width="100%" controls>
                                                                <source src="{{$value['file_url']}}" type="video/mp4">
                                                            </video>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 col-sm-12">    
                                                        <div class="form-group">                                                    
                                                            <center>Sorry, No Videos Found </center>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
@endsection