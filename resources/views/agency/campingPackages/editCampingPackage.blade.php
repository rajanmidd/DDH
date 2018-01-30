@extends('agency.mainLayout.template')
  @section('title')
    Edit Camping Package
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
                    <a href="javascript:void(0);">Edit Camping Package</a>
                </li>
            </ul>
         </div>
        <h3 class="page-title">
            Edit Camping Package : {{ucfirst($campingDetail['camping_name'])}}
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS -->
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line boxless tabbable-reversed">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-12">                                
                                <!-- BEGIN FORM-->
                                {!! Form::open(array('route' => 'agency.update-camping-package', 'class' => 'form','id'=>'activity-form','enctype'=>'multipart/form-data')) !!}
                                    <div class="portlet box yellow">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i> Add Camping Packages
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label">Camping Name</label>
                                                    <div class="form-group">
                                                        {{ Form::text('camping_name', $campingDetail['camping_name'], ['id' => 'camping_name','class' => 'form-control','placeholder'=>'Enter Camping Name']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Camping Title</label>
                                                    <div class="form-group">
                                                        {{ Form::text('camping_title', $campingDetail['camping_title'], ['id' => 'camping_title','class' => 'form-control','placeholder'=>'Enter Camping Title']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Description</label>
                                                    <div class="form-group">
                                                        {{ Form::textarea('camping_description', $campingDetail['camping_description'], ['id' => 'camping_description','class' => 'form-control','placeholder'=>'Enter Description','rows'=>5]) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Days</label>
                                                    <div class="form-group">
                                                        {{ Form::selectRange('days', 1, 15,$campingDetail['days'],['id' => 'days','class' => 'form-control']) }}
                                                    </div>
                                                </div>    
                                                <div class="form-group">
                                                    <label class="control-label">Night</label>
                                                    <div class="form-group">
                                                        {{ Form::selectRange('night', 0, 14,$campingDetail['night'],['id' => 'night','class' => 'form-control']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="portlet box blue">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>
                                                Camp Itinerary
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <div class="form-body">                                        
                                                <div class="input_fields_wrap_itenory row">
                                                    @if(count($campingDetail->campItinerary)>0 )
                                                        @foreach($campingDetail->campItinerary as $key=>$value)
                                                            <div>                                              
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Day {{$key+1}}</label>
                                                                        <div class="form-group">
                                                                            <textarea class="form-control" id="itinerary-1" name="itinerary[]" placeholder="itinerary" rows="3">{{$value['day_text']}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="portlet box green">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>
                                                Services
                                            </div>
                                        </div>
                                        
                                        <?php
                                        $camp_serivces=$campingDetail->campService->toArray();
                                        $rafting=array(
                                            'title'=>'','length'=>'','duration'=>'','from_location'=>'','to_location'=>''
                                        );
                                        if(checkService($camp_serivces,'rafting') >=0)
                                        {
                                            $rafting_key=($camp_serivces[checkService($camp_serivces,'rafting')]['service_value']);
                                            $rafting=json_decode($rafting_key,true);
                                        }
                                        ?>
                                        <div class="portlet-body form">
                                            <div class="form-body"> 
                                                <div class="row">
                                                    <div class="col-md-12 rafting">
                                                        <div class="form-group">
                                                            <div class="checkbox-list row">
                                                                <label class="checkbox-inline col-md-3">
                                                                    <h3>
                                                                        Rafting
                                                                        <input type="checkbox" name="rafting" id="inlineCheckbox21" class="services" data-service="rafting">                                                            
                                                                    </h3>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Title</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[rafting][title]', $rafting['title'], ['id' => 'rafting_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Length In KM</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[rafting][length]', $rafting['length'], ['id' => 'rafting_length','class' => 'form-control','placeholder'=>'Length In KM','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Duration In Min.</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[rafting][duration]', $rafting['duration'], ['id' => 'rafting_duration','class' => 'form-control','placeholder'=>'Duration In Min.','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">From Location</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[rafting][from_location]', $rafting['from_location'],['id' => 'from_location','class' => 'form-control','placeholder'=>'From Location','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">To Location</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[rafting][to_location]',$rafting['to_location'],['id' => 'to_location','class' => 'form-control','placeholder'=>'To Location','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                                <?php
                                                $bunjee=array(
                                                    'title'=>'','height'=>''
                                                );
                                                if(checkService($camp_serivces,'bunjee') >=0)
                                                {
                                                    $bunjee_key=($camp_serivces[checkService($camp_serivces,'bunjee')]['service_value']);
                                                    $bunjee=json_decode($bunjee_key,true);
                                                }
                                                ?>      
                                                <div class="row">
                                                    <div class="col-md-12 bunjee">
                                                        <div class="form-group">
                                                            <div class="checkbox-list row">
                                                                <label class="checkbox-inline col-md-3">
                                                                    <h3>
                                                                        Bunjee
                                                                        <input type="checkbox" name="bunjee" id="inlineCheckbox21" class="services" data-service="bunjee">                                                            
                                                                    </h3>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Title</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[bunjee][title]', $bunjee['title'], ['id' => 'bunjee_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Height In Meter</label>
                                                            <div class="form-group">
                                                            {{ Form::text('service[bunjee][height]', $bunjee['height'], ['id' => 'bunjee_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <hr />
                                                <?php
                                                $flying_fox_tandom=array(
                                                    'title'=>'','height'=>'','length'=>''
                                                );
                                                if(checkService($camp_serivces,'flying_fox_tandom') >=0)
                                                {
                                                    $flying_fox_tandom_key=($camp_serivces[checkService($camp_serivces,'flying_fox_tandom')]['service_value']);
                                                    $flying_fox_tandom=json_decode($flying_fox_tandom_key,true);
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-12 flying_fox_tandom">
                                                        <div class="form-group">
                                                            <div class="checkbox-list row">
                                                                <label class="checkbox-inline col-md-3">
                                                                    <h3>
                                                                        Flying Fox Tandom
                                                                        <input type="checkbox" name="flying_fox_tandom" id="inlineCheckbox21" class="services" data-service="flying_fox_tandom">                                                            
                                                                    </h3>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Title</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[flying_fox_tandom][title]', $flying_fox_tandom['title'], ['id' => 'flying_fox_tandom_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Length In Meter</label>
                                                            <div class="form-group">
                                                            {{ Form::text('service[flying_fox_tandom][length]', $flying_fox_tandom['length'], ['id' => 'flying_fox_tandom_length','class' => 'form-control','placeholder'=>'Length In Meter','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Height In Meter</label>
                                                            <div class="form-group">
                                                            {{ Form::text('service[flying_fox_tandom][height]', $flying_fox_tandom['height'], ['id' => 'flying_fox_tandom_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                                <?php
                                                $flying_fox_solo=array(
                                                    'title'=>'','height'=>'','length'=>''
                                                );
                                                if(checkService($camp_serivces,'flying_fox_solo') >=0)
                                                {
                                                    $flying_fox_solo_key=($camp_serivces[checkService($camp_serivces,'flying_fox_solo')]['service_value']);
                                                    $flying_fox_solo=json_decode($flying_fox_solo_key,true);
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-12 flying_fox_solo">
                                                        <div class="form-group">
                                                            <div class="checkbox-list row">
                                                                <label class="checkbox-inline col-md-3">
                                                                    <h3>
                                                                        Flying Fox Solo
                                                                        <input type="checkbox" name="flying_fox_solo" id="inlineCheckbox21" class="services" data-service="flying_fox_solo">                                                            
                                                                    </h3>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Title</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[flying_fox_solo][title]', $flying_fox_solo['title'], ['id' => 'flying_fox_solo_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Length In Meter</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[flying_fox_solo][length]', $flying_fox_solo['length'], ['id' => 'flying_fox_solo_length','class' => 'form-control','placeholder'=>'Length In Meter','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Height In Meter</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[flying_fox_solo][height]', $flying_fox_solo['height'], ['id' => 'flying_fox_solo_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                                <?php
                                                $swing=array(
                                                    'title'=>'','height'=>''
                                                );
                                                if(checkService($camp_serivces,'swing') >=0)
                                                {
                                                    $swing_key=($camp_serivces[checkService($camp_serivces,'swing')]['service_value']);
                                                    $swing=json_decode($swing_key,true);
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-12 swing">
                                                        <div class="form-group">
                                                            <div class="checkbox-list row">
                                                                <label class="checkbox-inline col-md-3">
                                                                    <h3>
                                                                        Swing
                                                                        <input type="checkbox" name="swing" id="inlineCheckbox21" class="services" data-service="swing">                                                            
                                                                    </h3>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Title</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[swing][title]', $swing['title'], ['id' => 'swing_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Height In Meter</label>
                                                            <div class="form-group">
                                                            {{ Form::text('service[swing][height]', $swing['height'], ['id' => 'swing_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                                <?php
                                                $air_safari=array(
                                                    'title'=>'','duration'=>''
                                                );
                                                if(checkService($camp_serivces,'air_safari') >=0)
                                                {
                                                    $air_safari_key=($camp_serivces[checkService($camp_serivces,'air_safari')]['service_value']);
                                                    $air_safari=json_decode($air_safari_key,true);
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-12 air_safari">
                                                        <div class="form-group">
                                                            <div class="checkbox-list row">
                                                                <label class="checkbox-inline col-md-3">
                                                                    <h3>
                                                                        Air Safari
                                                                        <input type="checkbox" name="air_safari" id="inlineCheckbox21" class="services" data-service="air_safari">                                                            
                                                                    </h3>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Title</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[air_safari][title]', $air_safari['title'], ['id' => 'air_safari_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Durtion In Minutes</label>
                                                            <div class="form-group">
                                                            {{ Form::text('service[air_safari][duration]', $air_safari['duration'], ['id' => 'air_safari_duration','class' => 'form-control','placeholder'=>'Durtion In Minutes','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                                <?php
                                                $air_balloon=array(
                                                    'title'=>'','duration'=>''
                                                );
                                                if(checkService($camp_serivces,'air_balloon') >=0)
                                                {
                                                    $air_balloon_key=($camp_serivces[checkService($camp_serivces,'air_balloon')]['service_value']);
                                                    $air_balloon=json_decode($air_balloon_key,true);
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-12 air_balloon">
                                                        <div class="form-group">
                                                            <div class="checkbox-list row">
                                                                <label class="checkbox-inline col-md-3">
                                                                    <h3>
                                                                        Air Balloon
                                                                        <input type="checkbox" name="air_balloon" id="inlineCheckbox21" class="services" data-service="air_balloon">                                                            
                                                                    </h3>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Title</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[air_balloon][title]', $air_balloon['title'], ['id' => 'air_balloon_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Durtion In Minutes</label>
                                                            <div class="form-group">
                                                            {{ Form::text('service[air_balloon][duration]', $air_balloon['duration'], ['id' => 'air_balloon_duration','class' => 'form-control','placeholder'=>'Durtion In Minutes','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                                <?php
                                                $cycling=array(
                                                    'title'=>'','length'=>'','duration'=>''
                                                );
                                                if(checkService($camp_serivces,'cycling') >=0)
                                                {
                                                    $cycling_key=($camp_serivces[checkService($camp_serivces,'cycling')]['service_value']);
                                                    $cycling=json_decode($cycling_key,true);
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-12 cycling">
                                                        <div class="form-group">
                                                            <div class="checkbox-list row">
                                                                <label class="checkbox-inline col-md-3">
                                                                    <h3>
                                                                        Cycling
                                                                        <input type="checkbox" name="cycling" id="inlineCheckbox21" class="services" data-service="cycling">                                                            
                                                                    </h3>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Title</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[cycling][title]', $cycling['title'], ['id' => 'cycling_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Length In KM</label>
                                                            <div class="form-group">
                                                            {{ Form::text('service[cycling][length]', $cycling['title'], ['id' => 'cycling_length','class' => 'form-control','placeholder'=>'Length In KM','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Durtion In Minutes</label>
                                                            <div class="form-group">
                                                            {{ Form::text('service[cycling][duration]', $cycling['title'], ['id' => 'cycling_duration','class' => 'form-control','placeholder'=>'Durtion In Minutes','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                                <?php
                                                $zip_line=array(
                                                    'title'=>'','height'=>'','length'=>''
                                                );
                                                if(checkService($camp_serivces,'zip_line') >=0)
                                                {
                                                    $zip_line_key=($camp_serivces[checkService($camp_serivces,'zip_line')]['service_value']);
                                                    $zip_line=json_decode($zip_line_key,true);
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-12 zip_line">
                                                        <div class="form-group">
                                                            <div class="checkbox-list row">
                                                                <label class="checkbox-inline col-md-3">
                                                                    <h3>
                                                                        ZipLine
                                                                        <input type="checkbox" name="zip_line" id="inlineCheckbox21" class="services" data-service="zip_line">                                                            
                                                                    </h3>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Title</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[zip_line][title]', $zip_line['title'], ['id' => 'zip_line_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Length In Meter</label>
                                                            <div class="form-group">
                                                            {{ Form::text('service[zip_line][length]', $zip_line['length'], ['id' => 'zip_line_length','class' => 'form-control','placeholder'=>'Length In Meter','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Height In Meter</label>
                                                            <div class="form-group">
                                                            {{ Form::text('service[zip_line][height]', $zip_line['height'], ['id' => 'zip_line_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                                <?php
                                                $trekking=array(
                                                    'title'=>'','length'=>'','duration'=>''
                                                );
                                                if(checkService($camp_serivces,'trekking') >=0)
                                                {
                                                    $trekking_key=($camp_serivces[checkService($camp_serivces,'trekking')]['service_value']);
                                                    $trekking=json_decode($trekking_key,true);
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-12 trekking">
                                                        <div class="form-group">
                                                            <div class="checkbox-list row">
                                                                <label class="checkbox-inline col-md-3">
                                                                    <h3>
                                                                        Trekking
                                                                        <input type="checkbox" name="trekking" id="inlineCheckbox21" class="services" data-service="trekking">                                                            
                                                                    </h3>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Title</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[trekking][title]', $trekking['title'], ['id' => 'trekking_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Length In KM</label>
                                                            <div class="form-group">
                                                            {{ Form::text('service[trekking][length]', $trekking['length'], ['id' => 'trekking_length','class' => 'form-control','placeholder'=>'Length In KM','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Duration In Minutes</label>
                                                            <div class="form-group">
                                                            {{ Form::text('service[trekking][duration]', $trekking['duration'], ['id' => 'trekking_duration','class' => 'form-control','placeholder'=>'Duration In Minutes','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                                <?php
                                                $pain_ball=array(
                                                    'no_of_round'=>'','no_of_ball'=>''
                                                );
                                                if(checkService($camp_serivces,'pain_ball') >=0)
                                                {
                                                    $pain_ball_key=($camp_serivces[checkService($camp_serivces,'pain_ball')]['service_value']);
                                                    $pain_ball=json_decode($pain_ball_key,true);
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-12 pain_ball">
                                                        <div class="form-group">
                                                            <div class="checkbox-list row">
                                                                <label class="checkbox-inline col-md-3">
                                                                    <h3>
                                                                        Pain Ball
                                                                        <input type="checkbox" name="pain_ball" id="inlineCheckbox21" class="services" data-service="pain_ball">                                                            
                                                                    </h3>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Number Of Round</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[pain_ball][no_of_round]', $pain_ball['no_of_round'], ['id' => 'no_of_round','class' => 'form-control','placeholder'=>'Number Of Round','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Number Of Ball</label>
                                                            <div class="form-group">
                                                            {{ Form::text('service[pain_ball][no_of_ball]', $pain_ball['no_of_ball'], ['id' => 'no_of_ball','class' => 'form-control','placeholder'=>'Number Of Ball','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                                <?php
                                                $paragliding=array(
                                                    'duration'=>'','height'=>''
                                                );
                                                if(checkService($camp_serivces,'paragliding') >=0)
                                                {
                                                    $paragliding_key=($camp_serivces[checkService($camp_serivces,'paragliding')]['service_value']);
                                                    $paragliding=json_decode($paragliding_key,true);
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-12 paragliding">
                                                        <div class="form-group">
                                                            <div class="checkbox-list row">
                                                                <label class="checkbox-inline col-md-3">
                                                                    <h3>
                                                                        Paragliding
                                                                        <input type="checkbox" name="paragliding" id="inlineCheckbox21" class="services" data-service="paragliding">                                                            
                                                                    </h3>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Height In Meter</label>
                                                            <div class="form-group">
                                                                {{ Form::text('service[paragliding][height]', $paragliding['height'], ['id' => 'paragliding_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Duration In Minutes</label>
                                                            <div class="form-group">
                                                            {{ Form::text('service[paragliding][duration]', $paragliding['duration'], ['id' => 'paragliding_duration','class' => 'form-control','placeholder'=>'Duration In Minutes','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="portlet box grey">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>Meal
                                            </div>
                                            <div class="caption pull-right">
                                                <button type="button" title="Add Meal" class="btn btn-success btn-add pull-right add_field_button_meal" >
                                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <div class="form-body">                                        
                                                <div class="input_fields_wrap_meal row">  
                                                    @if(count($campingDetail->campingMeal)>0 )
                                                        @foreach($campingDetail->campingMeal as $key=>$value)
                                                            <div>                                              
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Meal</label>
                                                                        <div class="form-group">
                                                                            <textarea class="form-control" id="terms-{{$key+1}}" name="terms[]" placeholder="Meal" rows="3">{{$value['file_url']}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_field_button_meal">
                                                                        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> 
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="portlet box grey">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>Inclusions Details If Any 
                                            </div>
                                            <div class="caption pull-right">
                                                <button type="button" title="Inclusion Details" class="btn btn-success btn-add pull-right add_field_button_inclusion" >
                                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <div class="form-body">                                        
                                                <div class="input_fields_wrap_inclusion row">  
                                                    @if(count($campingDetail->campingInclusion)>0 )
                                                        @foreach($campingDetail->campingInclusion as $key=>$value)
                                                            <div>                                              
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Inclusions Details If Any </label>
                                                                        <div class="form-group">
                                                                            <textarea class="form-control" id="terms-{{$key+1}}" name="terms[]" placeholder="Inclusions Details If Any " rows="3">{{$value['file_url']}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_field_button_inclusion">
                                                                        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> 
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="portlet box grey">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>Exclusions Details If Any 
                                            </div>
                                            <div class="caption pull-right">
                                                <button type="button" title="Exclusion Details" class="btn btn-success btn-add pull-right add_field_button_exclusion" >
                                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <div class="form-body">                                        
                                                <div class="input_fields_wrap_exclusion row">  
                                                    @if(count($campingDetail->campingExclusion)>0 )
                                                        @foreach($campingDetail->campingExclusion as $key=>$value)
                                                            <div>                                              
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Terms & Conditions</label>
                                                                        <div class="form-group">
                                                                            <textarea class="form-control" id="terms-{{$key+1}}" name="terms[]" placeholder="Terms & Condition" rows="3">{{$value['file_url']}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_field_button_exclusion">
                                                                        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> 
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="portlet box blue">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>
                                                Activity Images                                                
                                            </div>
                                            <div class="caption pull-right">
                                                <button type="button" title="Add Images" class="btn btn-success btn-add pull-right add_field_button" >
                                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <!-- BEGIN FORM-->
                                            <div class="form-body">
                                                <div class="input_fields_wrap row"></div>
                                                <div class="row img_gallery">
                                                    @if(count($campingDetail->campingImages)>0 )
                                                        @foreach($campingDetail->campingImages as $key=>$value)
                                                            <div class="col-md-3 form-group">
                                                                <img src="{{$value['file_url']}}" />
                                                                <center>
                                                                    <span class="btn-group btn-group-xs btn-group-solid">
                                                                        <button type="button" class="btn red confirm_button" class="confirm" data-href="{{URL::to('/agency/delete-activity-image')}}/{{$value['id']}}/{{$value['agency_activity_id']}}">Delete</button>
                                                                    </span>
                                                                </center>
                                                            </div>
                                                        @endforeach
                                                    @endif                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="portlet box green">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>Activity Videos
                                            </div>
                                            <div class="caption pull-right">
                                                <button type="button"  title="Add Videos" class="btn btn-success btn-add pull-right add_video_button" >
                                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <div class="form-body">                                        
                                                <div class="input_fields_wrap_video row"></div>
                                                <div class="row video_gallery">
                                                    @if(count($campingDetail->campingVideos)>0 )
                                                        @foreach($campingDetail->campingVideos as $key=>$value)
                                                            <div class="col-md-3 form-group">
                                                                <video width="100%" controls>
                                                                    <source src="{{$value['file_url']}}" type="video/mp4">
                                                                </video>
                                                                <center>
                                                                    <span class="btn-group btn-group-xs btn-group-solid">
                                                                        <button type="button" class="btn red confirm_button" class="confirm" data-href="{{URL::to('/agency/delete-activity-video')}}/{{$value['id']}}/{{$value['agency_activity_id']}}">Delete</button>
                                                                    </span>
                                                                </center>
                                                            </div>
                                                        @endforeach
                                                    @endif                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="portlet box grey">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>Terms & Conditions 
                                            </div>
                                            <div class="caption pull-right">
                                                <button type="button" title="Add Terms & Condition" class="btn btn-success btn-add pull-right add_terms_button" >
                                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <div class="form-body">                                        
                                                <div class="input_fields_wrap_terms row">  
                                                    @if(count($campingDetail->campingTerms)>0 )
                                                        @foreach($campingDetail->campingTerms as $key=>$value)
                                                            <div>                                              
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Terms & Conditions</label>
                                                                        <div class="form-group">
                                                                            <textarea class="form-control" id="terms-{{$key+1}}" name="terms[]" placeholder="Terms & Condition" rows="3">{{$value['file_url']}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_terms_field">
                                                                        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> 
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="portlet box red">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>
                                                Special Notes 
                                            </div>
                                            <div class="caption pull-right">
                                                <button type="button" title="Add Special Notes" class="btn btn-success btn-add pull-right add_notes_button" >
                                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <div class="form-body">                                        
                                                <div class="input_fields_wrap_notes row"> 
                                                    @if(count($campingDetail->campingNotes)>0 )
                                                        @foreach($campingDetail->campingNotes as $key=>$value)
                                                            <div>                                              
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Special Notes</label>
                                                                        <div class="form-group">
                                                                            <textarea class="form-control" id="notes-{{$key+1}}" name="notes[]" placeholder="Special Notes" rows="3">{{$value['file_url']}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_notes_field">
                                                                        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> 
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="portlet box purple">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>Price
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <div class="form-body">                                        
                                                <div class="form-group">
                                                    <label class="control-label">Triple/Quarter Sharing Price</label>
                                                    <div class="form-group">
                                                        {{ Form::text('triple_sharing', $campingDetail['triple_sharing'], ['id' => 'triple_sharing','class' => 'form-control','placeholder'=>'Triple/Quarter Sharing Price']) }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-body">                                        
                                                <div class="form-group">
                                                    <label class="control-label">Double Sharing Price</label>
                                                    <div class="form-group">
                                                        {{ Form::text('double_sharing', $campingDetail['double_sharing'], ['id' => 'double_sharing','class' => 'form-control','placeholder'=>'Double Sharing Price']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <input type="hidden" name="camping_id" value="{{Request::segment(3)}}" />
                                    <div class="form-actions right">
                                        <button type="button" class="btn default">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn blue">
                                            <i class="fa fa-check"></i> 
                                            Update
                                        </button>
                                    </div>
                                {{ Form::close() }}
                                <!-- END FORM-->
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


<?php
function checkService($camp_serives,$value)
{
    if(array_search($value, array_column($camp_serives, 'service_name')) !== False) {
        return array_search($value, array_column($camp_serives, 'service_name'));
    } 
    else 
    {
        return -1;
    }
    
}

?>