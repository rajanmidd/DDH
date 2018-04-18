@extends('agency.mainLayout.template')
  @section('title')
    View  Activity :: {{ucfirst($activityDetail['title'])}}
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
                    <a href="javascript:void(0);">View Activity</a>
                </li>
            </ul>
         </div>
        <h3 class="page-title">
            View Activity : {{ucfirst($activityDetail['title'])}}
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS -->
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
                                                        <dt>Activity Name : </dt>
                                                        <dd>{{ucfirst($activityDetail->activityName['name'])}}</dd>
                                                        <dt>Title :</dt>
                                                        <dd>{{ucfirst($activityDetail['title'])}}</dd>
                                                        <dt>Location :</dt>
                                                        <dd>{{ucfirst($activityDetail['location'])}}</dd>
                                                        <dt>Level :</dt>
                                                        <dd>{{ucfirst($activityDetail->difficultyLevel['name'])}}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-md-6">
                                                    <dl class="dl-horizontal">
                                                        <!-- <dt>Min. % Amount :</dt>
                                                        <dd>{{$activityDetail['minimum_amount_percent']}}</dd> -->
                                                        <dt>Price Per Person</dt>
                                                        <dd>{{$activityDetail['price_per_person']}}</dd>
                                                        <dt>Season Months :</dt>
                                                        <dd>
                                                        <?php 
                                                            $seaons_months=CustomHelper::getSeasonMonths($activityDetail['season']); 
                                                            echo $seaons_months;
                                                        ?>
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="view_data">
                                    <h3 class="heading_form"> Images</h3>
                                    <div class="form">                                    
                                        <div class="form-body actimages">
                                            <div class="row">
                                                @if(count($activityDetail->activityImages)>0 )
                                                    @foreach($activityDetail->activityImages as $key=>$value)
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
                                <!-- <div class="view_data">
                                    <h3 class="heading_form"> Videos</h3>
                                    <div class="form">
                                        <div class="form-body actimages">
                                            <div class="row">
                                                @if(count($activityDetail->activityVideos)>0 )
                                                    @foreach($activityDetail->activityVideos as $key=>$value)
                                                        <div class="col-md-3 col-sm-3">                                                        
                                                            <video width="100%" controls>
                                                                <source src="{{$value['file_url']}}" type="video/mp4">
                                                            </video>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 col-sm-12">    
                                                        <div class="alert alert-warning">
                                                            Sorry, No Videos Found
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="view_data">
                                    <h3 class="heading_form">Terms & Conditions </h3>
                                    <div class="form">
                                        <div class="form-body">
                                            <ul class="list-group">                                            
                                                @if(count($activityDetail->activityTerms)>0 )
                                                    @foreach($activityDetail->activityTerms as $key=>$value)
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
                                                @if(count($activityDetail->activityNotes)>0 )
                                                    @foreach($activityDetail->activityNotes as $key=>$value)
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