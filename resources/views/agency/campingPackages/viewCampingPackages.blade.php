@extends('agency.mainLayout.template')
  @section('title')
    View Camping Package :: {{ucfirst($campingDetail['camping_title'])}}
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
            View Camping Package : {{ucfirst($campingDetail['camping_title'])}}
        </h3>
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line boxless tabbable-reversed">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="view_data">
                                    <div class="form">
                                        <div class="form-body">  
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <dl class="dl-horizontal">
                                                        <dt>Package Title :</dt>
                                                        <dd>{{ucfirst($campingDetail['camping_title'])}}</dd>
                                                        <dt>Location : </dt>
                                                        <dd>{{ucfirst($campingDetail['camping_location'])}}</dd>
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
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="view_data">
                                    <h3 class="heading_form"> Itenary</h3>
                                    <div class="form">                                    
                                        <div class="form-body actimages">
                                            <div class="row">
                                                @if(count($campingDetail->campItinerary)>0 )
                                                    @foreach($campingDetail->campItinerary as $key=>$value)
                                                        <div class="col-md-6 col-sm-6">
                                                            <h4>Day {{$key+1}}</h4>
                                                            {{$value['day_text']}}
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 col-sm-12">    
                                                        <div class="alert alert-warning">
                                                            Sorry, No Images Found
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="view_data">
                                    <h3 class="heading_form"> Services</h3>
                                    <div class="form">
                                        <div class="form-body actimages">
                                            <div class="row">
                                                @if(count($campingDetail->campService)>0 )
                                                    @foreach($campingDetail->campService as $key=>$value)                                                        
                                                        <div class="col-md-3 col-sm-3">  
                                                            <h4>{{ucfirst(str_replace('_',' ',$value['service_name']))}}</h4>
                                                            @if($value['service_value'] != null || $value['service_value']!="" )
                                                                <?php $service_value=json_decode($value['service_value'],true);?>
                                                                <ul>
                                                                    @foreach($service_value as $key1=>$value1)
                                                                        <li>{{ucfirst(str_replace('_',' ',$key1))}} : {{$value1}}</li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 col-sm-12">    
                                                        <div class="alert alert-warning">
                                                            Sorry, No Camp Service Found
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="view_data">
                                    <h3 class="heading_form"> Meal</h3>
                                    <div class="form">                                    
                                        <div class="form-body actimages">
                                            <div class="row">
                                                @if(count($campingDetail->campingMeal)>0 )
                                                    @foreach($campingDetail->campingMeal as $key=>$value)
                                                        <div class="col-md-12 col-sm-12">
                                                            {{$value['file_url']}}
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 col-sm-12">    
                                                        <div class="alert alert-warning">
                                                            Sorry, No Meal Found
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="view_data">
                                    <h3 class="heading_form"> Inclusions Details</h3>
                                    <div class="form">                                    
                                        <div class="form-body actimages">
                                            <div class="row">
                                                @if(count($campingDetail->campingInclusion)>0 )
                                                    @foreach($campingDetail->campingInclusion as $key=>$value)
                                                        <div class="col-md-12 col-sm-12">
                                                            {{$value['file_url']}}
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 col-sm-12">    
                                                        <div class="alert alert-warning">
                                                            Sorry, No Meal Found
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="view_data">
                                    <h3 class="heading_form"> Exclusion Details</h3>
                                    <div class="form">                                    
                                        <div class="form-body actimages">
                                            <div class="row">
                                                @if(count($campingDetail->campingExclusion)>0 )
                                                    @foreach($campingDetail->campingExclusion as $key=>$value)
                                                        <div class="col-md-12 col-sm-12">
                                                            {{$value['file_url']}}
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 col-sm-12">    
                                                        <div class="alert alert-warning">
                                                            Sorry, No Meal Found
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="view_data">
                                    <h3 class="heading_form"> Images</h3>
                                    <div class="form">                                    
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
                                                        <div class="alert alert-warning">
                                                            Sorry, No Images Found
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="view_data">
                                    <h3 class="heading_form">Terms & Conditions </h3>
                                    <div class="form">
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
                                                        <div class="alert alert-warning">
                                                            Sorry, No Terms & Conditions Found
                                                        </div>
                                                    </div>
                                                @endif
                                            </ul>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="view_data">
                                    <h3 class="heading_form">Special Notes</h3>
                                    <div class="form">
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
                                                        <div class="alert alert-warning">
                                                            Sorry, No Notes Found
                                                        </div>
                                                    </div>
                                                @endif
                                            </ul>
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