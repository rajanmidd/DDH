@extends('admin.mainLayout.template')
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
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#basic_information" data-toggle="tab"> Activity Information </a>
                        </li>
                        <li>
                            <a href="#images" data-toggle="tab"> Images </a>
                        </li>
                        <li>
                            <a href="#videos" data-toggle="tab"> Videos </a>
                        </li>
                        <li>
                            <a href="#terms" data-toggle="tab"> Terms & Conditions </a>
                        </li>
                        <li>
                            <a href="#notes" data-toggle="tab"> Special Notes </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="basic_information">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="portlet box yellow">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i> Activity Information 
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
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
                                                            <dt>Capacity :</dt>
                                                            <dd>{{ucfirst($activityDetail['capacity'])}}</dd>
                                                            <dt>Level :</dt>
                                                            <dd>{{ucfirst($activityDetail->difficultyLevel['name'])}}</dd>
                                                        </dl>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <dl class="dl-horizontal">
                                                            <dt>Min. % Amount :</dt>
                                                            <dd>{{$activityDetail['minimum_amount_percent']}}</dd>
                                                            <dt>Price Per Person</dt>
                                                            <dd>{{$activityDetail['price_per_person']}}</dd>
                                                            <dt>Open Days :</dt>
                                                            <dd>
                                                                <?php 
                                                                    $open_days=CustomHelper::getOpenDays($activityDetail['days']); 
                                                                    echo $open_days;
                                                                ?>
                                                            </dd>
                                                            <dt>Season Months :</dt>
                                                            <dd>
                                                            <?php 
                                                                $seaons_months=CustomHelper::getSeasonMonths($activityDetail['season']); 
                                                                echo $seaons_months;
                                                            ?>
                                                            </dd>
                                                            <dt>Open/Close Time :</dt>
                                                            <dd>{{date('h:i A',strtotime($activityDetail['open_time']))}} - {{date('h:i A',strtotime($activityDetail['close_time']))}}</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="images">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>
                                        Activity Images
                                    </div>
                                </div>
                                <div class="portlet-body form">                                    
                                    <div class="form-body actimages">
                                        <div class="row">
                                            @if(count($activityDetail->activityImages)>0 )
                                                @foreach($activityDetail->activityImages as $key=>$value)
                                                    <div class="col-md-4 col-sm-4">
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
                        </div>
                        <div class="tab-pane" id="videos">
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Activity Videos
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <div class="form-body actimages">
                                        <div class="row">
                                            @if(count($activityDetail->activityVideos)>0 )
                                                @foreach($activityDetail->activityVideos as $key=>$value)
                                                    <div class="col-md-4 col-sm-4">                                                        
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
                        <div class="tab-pane" id="terms">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Terms & Conditions 
                                    </div>
                                </div>
                                <div class="portlet-body form">
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
                                                    <div class="form-group">                                                    
                                                        <center>Sorry, No Terms & Conditions Found </center>
                                                    </div>
                                                </div>
                                            @endif
                                        </ul>
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="notes">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>
                                        Special Notes 
                                    </div>
                                </div>
                                <div class="portlet-body form">
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
                                                    <div class="form-group">                                                    
                                                        <center>Sorry, No Notes Found </center>
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
<!-- END CONTENT -->
@endsection