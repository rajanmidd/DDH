@extends('agency.mainLayout.template')
  @section('title')
    View Camping Package :: {{ucfirst($campingDetail['camping_name'])}}
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
                    <a href="javascript:void(0);">View Camping Package</a>
                </li>
            </ul>
         </div>
        <h3 class="page-title">
            View Camping Package : {{ucfirst($campingDetail['camping_name'])}}
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
                                            <i class="fa fa-gift"></i> Camping Package Information 
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body">  
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <dl class="dl-horizontal">
                                                        <dt>Activity Name : </dt>
                                                        <dd>{{ucfirst($campingDetail['camping_name'])}}</dd>
                                                        <dt>Title :</dt>
                                                        <dd>{{ucfirst($campingDetail['camping_title'])}}</dd>
                                                        <dt>Days :</dt>
                                                        <dd>{{$campingDetail['days']}}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-md-6">
                                                    <dl class="dl-horizontal">
                                                        <dt>Double Sharing Price :</dt>
                                                        <dd>{{$campingDetail['double_sharing']}}</dd>
                                                        <dt>Tripe/Quarter Sharing</dt>
                                                        <dd>{{$campingDetail['triple_sharing']}}</dd>
                                                        
                                                        <dt>Night :</dt>
                                                        <dd>{{$campingDetail['night']}}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <dt>Camping Description</dt>
                                                    <dd>{{$campingDetail['camping_description']}}</dd>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> Camp Itinerary
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <ul class="list-group">                                            
                                                @if(count($campingDetail->campItinerary)>0 )
                                                    @foreach($campingDetail->campItinerary as $key=>$value)
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

                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> Camp Services
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <ul class="list-group">                                      
                                                @if(count($campingDetail->campService)>0 )
                                                    @foreach($campingDetail->campService as $key=>$value)                                                        
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
                                                @if(count($campingDetail->campingMeal)>0 )
                                                    @foreach($campingDetail->campingMeal as $key=>$value)
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
                                                @if(count($campingDetail->campingInclusion)>0 )
                                                    @foreach($campingDetail->campingInclusion as $key=>$value)
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
                                                @if(count($campingDetail->campingExclusion)>0 )
                                                    @foreach($campingDetail->campingExclusion as $key=>$value)
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
                                                @if(count($campingDetail->campingTerms)>0 )
                                                    @foreach($campingDetail->campingTerms as $key=>$value)
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
                                                @if(count($campingDetail->campingNotes)>0 )
                                                    @foreach($campingDetail->campingNotes as $key=>$value)
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
                                            Camping Images
                                        </div>
                                    </div>
                                    <div class="portlet-body form">                                    
                                        <div class="form-body actimages">
                                            <div class="row">
                                                @if(count($campingDetail->campingImages)>0 )
                                                    @foreach($campingDetail->campingImages as $key=>$value)
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
                                            <i class="fa fa-gift"></i>Camping Videos
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body actimages">
                                            <div class="row">
                                                @if(count($campingDetail->campingVideos)>0 )
                                                    @foreach($campingDetail->campingVideos as $key=>$value)
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