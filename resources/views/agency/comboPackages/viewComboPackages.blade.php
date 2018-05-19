@extends('agency.mainLayout.template')
  @section('title')
    View Package :: {{ucfirst($comboDetail['combo_title'])}}
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
            View Combo Package : {{ucfirst($comboDetail['combo_title'])}}
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
                                                        <dd>{{ucfirst($comboDetail['combo_title'])}}</dd>
                                                        @if($comboDetail['camping'] ==1)
                                                            <dt>Days :</dt>
                                                            <dd>{{$comboDetail['days']}}</dd>
                                                            <dt>Night :</dt>
                                                            <dd>{{$comboDetail['night']}}</dd>
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
                                                            
                                                        @else
                                                            <dt>Price :</dt>
                                                            <dd>{{$comboDetail['price']}}</dd>
                                                        @endif
                                                    </dl>
                                                </div>
                                                <div class="col-md-12">
                                                    <dl class="dl-horizontal">
                                                        <dt>Description :</dt>
                                                        <dd>@if($comboDetail['combo_description']) {{$comboDetail['combo_description']}} @else NA @endif</dd>
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
                                                @if(count($comboDetail->comboItinerary)>0 )
                                                    @foreach($comboDetail->comboItinerary as $key=>$value)
                                                        <div class="col-md-6 col-sm-6">
                                                            <h4>Day {{$key+1}}</h4>
                                                            {{$value['day_text']}}
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 col-sm-12">    
                                                        <div class="alert alert-warning">
                                                            Sorry, No Itenary Found
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
                                                @if(count($comboDetail->comboService)>0 )
                                                    @foreach($comboDetail->comboService as $key=>$value)                                                        
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
                                        <div class="form-body">
                                            <ul class="list-group">
                                                @if(count($comboDetail->comboMeal)>0 )
                                                    @foreach($comboDetail->comboMeal as $key=>$value)
                                                        <li class="list-group-item">
                                                            {{$value['file_url']}}
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="list-group-item">
                                                        Sorry, No Meal Found
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="view_data">
                                    <h3 class="heading_form"> Inclusions Details</h3>
                                    <div class="form">                                    
                                        <div class="form-body">
                                            <ul class="list-group">
                                                @if(count($comboDetail->comboInclusion)>0 )
                                                    @foreach($comboDetail->comboInclusion as $key=>$value)
                                                        <li class="list-group-item">
                                                            {{$value['file_url']}}
                                                        </li>
                                                    @endforeach
                                                @else   
                                                    <li class="list-group-item">
                                                        Sorry, No Inclusion Details Found
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="view_data">
                                    <h3 class="heading_form"> Exclusion Details</h3>
                                    <div class="form">                                    
                                        <div class="form-body">
                                            <ul class="list-group">
                                                @if(count($comboDetail->comboExclusion)>0 )
                                                    @foreach($comboDetail->comboExclusion as $key=>$value)
                                                        <li class="list-group-item">
                                                            {{$value['file_url']}}
                                                        </li>
                                                    @endforeach
                                                @else 
                                                    <li class="list-group-item">
                                                        Sorry, No Exclusion Details Found
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="view_data">
                                    <h3 class="heading_form"> Images</h3>
                                    <div class="form">                                    
                                        <div class="form-body actimages">
                                            <div class="row">
                                                @if(count($comboDetail->comboImages)>0 )
                                                    @foreach($comboDetail->comboImages as $key=>$value)
                                                        <div class="col-md-2 col-sm-2">
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
                                                @if(count($comboDetail->comboTerms)>0 )
                                                    @foreach($comboDetail->comboTerms as $key=>$value)
                                                        <li class="list-group-item">                                                   
                                                            {{$value['file_url']}}
                                                        </li>
                                                    @endforeach
                                                @else   
                                                    <li class="list-group-item">
                                                        Sorry, No Terms & Conditions Found
                                                    </li>
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
                                                @if(count($comboDetail->comboNotes)>0 )
                                                    @foreach($comboDetail->comboNotes as $key=>$value)
                                                        <li class="list-group-item">                                                   
                                                            {{$value['file_url']}}
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="list-group-item">
                                                        Sorry, No Notes Found
                                                    </li>
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
        <!-- BEGIN DASHBOARD STATS -->
    </div>
</div>
<!-- END CONTENT -->
@endsection