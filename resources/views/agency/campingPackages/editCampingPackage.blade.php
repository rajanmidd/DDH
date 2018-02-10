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
        
        <h3 class="page-title">
            Edit Camping Package : {{ucfirst($campingDetail['camping_name'])}}
        </h3>
        
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
        
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS -->
        
        <div class="form-horizontal">
            <div class="row">
                <div class="col-md-10">                                
                <!-- BEGIN FORM-->
                {!! Form::open(array('route' => 'agency.update-camping-package', 'class' => 'form','id'=>'activity-form','enctype'=>'multipart/form-data')) !!}
                                    
                                    <div class="form">
                                             <h3 class="heading_form">
                                                Add Camping Packages
                                            </h3>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Camping Name</label>
                                                    <div class="col-md-9">
                                                        {{ Form::text('camping_name', $campingDetail['camping_name'], ['id' => 'camping_name','class' => 'form-control','placeholder'=>'Enter Camping Name']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Camping Title</label>
                                                    <div class="col-md-9">
                                                        {{ Form::text('camping_title', $campingDetail['camping_title'], ['id' => 'camping_title','class' => 'form-control','placeholder'=>'Enter Camping Title']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Description</label>
                                                    <div class="col-md-9">
                                                        {{ Form::textarea('camping_description', $campingDetail['camping_description'], ['id' => 'camping_description','class' => 'form-control','placeholder'=>'Enter Description','rows'=>5]) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Camping Location</label>
                                                    <div class="col-md-9">
                                                        {{ Form::text('camping_location', $campingDetail['camping_location'], ['id' => 'location','class' => 'form-control','placeholder'=>'Camping Location']) }}
                                                        <input type="hidden" name="latitude" id="latitude" value="{{$campingDetail['latitude']}}" />
                                                        <input type="hidden" name="longitude" id="longitude" value="{{$campingDetail['longitude']}}" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Days</label>
                                                    <div class="col-md-9">
                                                        {{ Form::selectRange('days', 1, 15,$campingDetail['days'],['id' => 'days','class' => 'form-control']) }}
                                                    </div>
                                                </div>    
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Night</label>
                                                    <div class="col-md-9">
                                                        {{ Form::selectRange('night', 0, 14,$campingDetail['night'],['id' => 'night','class' => 'form-control']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                
                                    <div class="form">
                                        <h3 class="heading_form">
                                            Camp Itinerary
                                        </h3>
                                        
                                        <div class="form-body">                                        
                                            <div class="input_fields_wrap_itenory">
                                                @if(count($campingDetail->campItinerary)>0 )
                                                    @foreach($campingDetail->campItinerary as $key=>$value)
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Day {{$key+1}}</label>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" id="itinerary-1" name="itinerary[]" placeholder="itinerary">{{$value['day_text']}}</textarea>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif                                                    
                                            </div>
                                        </div>
                                    </div>   
                    
                                    <div class="form">
                                        <h3 class="heading_form">
                                            Rafting
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="rafting" id="inlineCheckbox21" class="services" data-service="rafting">
                                            </label>
                                        </h3>
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
                                        
<<<<<<< HEAD
                                            <div class="form-body"> 
                                                <div class="row">
                                                    <div class="col-md-12 rafting">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Title</label>
                                                            <div class="col-md-9">
                                                                {{ Form::text('service[rafting][title]', $rafting['title'], ['id' => 'rafting_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Length In KM</label>
                                                            <div class=" col-md-9">
                                                                {{ Form::text('service[rafting][length]', $rafting['length'], ['id' => 'rafting_length','class' => 'form-control','placeholder'=>'Length In KM','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Duration In Min.</label>
                                                            <div class="col-md-9">
                                                                {{ Form::text('service[rafting][duration]', $rafting['duration'], ['id' => 'rafting_duration','class' => 'form-control','placeholder'=>'Duration In Min.','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">From Location</label>
                                                            <div class="col-md-9">
                                                                {{ Form::text('service[rafting][from_location]', $rafting['from_location'],['id' => 'from_location','class' => 'form-control','placeholder'=>'From Location','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">To Location</label>
                                                            <div class="col-md-9">
                                                                {{ Form::text('service[rafting][to_location]',$rafting['to_location'],['id' => 'to_location','class' => 'form-control','placeholder'=>'To Location','disabled'=>'disabled']) }}
                                                            </div>
=======
                                        <div class="form-body"> 
                                            <div class="row">
                                                <div class="col-md-12 rafting">
                                                    <div class="form-group">
                                                    <label class="control-label col-md-3">Title</label>
                                                    <div class="col-md-9">
                                                        {{ Form::text('service[rafting][title]', $rafting['title'], ['id' => 'rafting_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Length In KM</label>
                                                        <div class="col-md-9">
                                                            {{ Form::text('service[rafting][length]', $rafting['length'], ['id' => 'rafting_length','class' => 'form-control','placeholder'=>'Length In KM','disabled'=>'disabled']) }}
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Duration In Min.</label>
                                                        <div class="col-md-9">
                                                        {{ Form::text('service[rafting][duration]', $rafting['duration'], ['id' => 'rafting_duration','class' => 'form-control','placeholder'=>'Duration In Min.','disabled'=>'disabled']) }}
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">From Location</label>
                                                        <div class=" col-md-9">
                                                        {{ Form::text('service[rafting][from_location]', $rafting['from_location'],['id' => 'from_location','class' => 'form-control','placeholder'=>'From Location','disabled'=>'disabled']) }}
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">To Location</label>
                                                        <div class="col-md-9">
                                                        {{ Form::text('service[rafting][to_location]',$rafting['to_location'],['id' => 'to_location','class' => 'form-control','placeholder'=>'To Location','disabled'=>'disabled']) }}
>>>>>>> amit_dev
                                                        </div>
                                                    </div>
                                                    
                                                </div>        
                                            </div>
                                        </div>                    
                                    </div>
                    
                                    <div class="form">
                                        <h3 class="heading_form">
                                            Bunjee
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="bunjee" id="inlineCheckbox21" class="services" data-service="bunjee">
                                            </label>
                                        </h3>
                                                
                                        <div class="form-body">
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
                                                        <label class="control-label col-md-3">Title</label>
                                                        <div class="col-md-9">
                                                            {{ Form::text('service[bunjee][title]', $bunjee['title'], ['id' => 'bunjee_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Height In Meter</label>
                                                        <div class="col-md-9">
                                                        {{ Form::text('service[bunjee][height]', $bunjee['height'], ['id' => 'bunjee_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            
                                            </div>
                                        </div>
                                            
                                    <div class="form">
                                        <h3 class="heading_form">
                                            Flying Fox Tandom
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="flying_fox_tandom" id="inlineCheckbox21" class="services" data-service="flying_fox_tandom">
                                            </label>
                                        </h3>
                                        <div class="form-body">
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
                                                    <label class="control-label col-md-3">Title</label>
                                                    <div class="col-md-9">
                                                        {{ Form::text('service[flying_fox_tandom][title]', $flying_fox_tandom['title'], ['id' => 'flying_fox_tandom_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Length In Meter</label>
                                                    <div class="col-md-9">
                                                    {{ Form::text('service[flying_fox_tandom][length]', $flying_fox_tandom['length'], ['id' => 'flying_fox_tandom_length','class' => 'form-control','placeholder'=>'Length In Meter','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Height In Meter</label>
                                                    <div class="col-md-9">
                                                    {{ Form::text('service[flying_fox_tandom][height]', $flying_fox_tandom['height'], ['id' => 'flying_fox_tandom_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                    
                                    <div class="form">
                                        <h3 class="heading_form">
                                            Flying Fox Solo
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="flying_fox_solo" id="inlineCheckbox21" class="services" data-service="flying_fox_solo">
                                            </label>
                                        </h3>
                                        <div class="form-body">
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
                                                    <label class="control-label col-md-3">Title</label>
                                                    <div class="form-group col-md-9">
                                                        {{ Form::text('service[flying_fox_solo][title]', $flying_fox_solo['title'], ['id' => 'flying_fox_solo_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Length In Meter</label>
                                                    <div class="form-group col-md-9">
                                                        {{ Form::text('service[flying_fox_solo][length]', $flying_fox_solo['length'], ['id' => 'flying_fox_solo_length','class' => 'form-control','placeholder'=>'Length In Meter','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Height In Meter</label>
                                                    <div class="form-group col-md-9">
                                                        {{ Form::text('service[flying_fox_solo][height]', $flying_fox_solo['height'], ['id' => 'flying_fox_solo_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>                          
                    
                                    <div class="form">
                                        <h3 class="heading_form">
                                            Swing
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="swing" id="inlineCheckbox21" class="services" data-service="swing">
                                            </label>  
                                        </h3>
                                                
                                        <div class="form-body">
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
                                                    <label class="control-label col-md-3">Title</label>
                                                    <div class="col-md-9">
                                                        {{ Form::text('service[swing][title]', $swing['title'], ['id' => 'swing_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Height In Meter</label>
                                                    <div class="col-md-9">
                                                    {{ Form::text('service[swing][height]', $swing['height'], ['id' => 'swing_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>                           
                                              
                                    <div class="form">
                                        <h3 class="heading_form">
                                            Air Safari
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="air_safari" id="inlineCheckbox21" class="services" data-service="air_safari"> 
                                            </label>
                                        </h3>

                                        <div class="form-body">
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
                                                    <label class="control-label col-md-3">Title</label>
                                                    <div class="col-md-9">
                                                        {{ Form::text('service[air_safari][title]', $air_safari['title'], ['id' => 'air_safari_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Durtion In Minutes</label>
                                                    <div class="col-md-9">
                                                    {{ Form::text('service[air_safari][duration]', $air_safari['duration'], ['id' => 'air_safari_duration','class' => 'form-control','placeholder'=>'Durtion In Minutes','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        </div>
                                    </div>
                    
                                    <div class="form">
                                        <h3 class="heading_form">
                                            Air Balloon
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="air_balloon" id="inlineCheckbox21" class="services" data-service="air_balloon">
                                            </label>
                                        </h3>
                                        <div class="form-body">
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
                                                    <label class="control-label col-md-3">Title</label>
                                                    <div class="col-md-9">
                                                        {{ Form::text('service[air_balloon][title]', $air_balloon['title'], ['id' => 'air_balloon_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Durtion In Minutes</label>
                                                    <div class="col-md-9">
                                                    {{ Form::text('service[air_balloon][duration]', $air_balloon['duration'], ['id' => 'air_balloon_duration','class' => 'form-control','placeholder'=>'Durtion In Minutes','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                                
                                    <div class="form">
                                        <h3 class="heading_form">
                                        Cycling
                                       <label class="checkbox-inline">
                                            <input type="checkbox" name="cycling" id="inlineCheckbox21" class="services" data-service="cycling">
                                        </label>
                                       </h3>

                                       <div class="form-body">
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
                                                <label class="control-label col-md-3">Title</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('service[cycling][title]', $cycling['title'], ['id' => 'cycling_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Length In KM</label>
                                                <div class=" col-md-9">
                                                {{ Form::text('service[cycling][length]', $cycling['title'], ['id' => 'cycling_length','class' => 'form-control','placeholder'=>'Length In KM','disabled'=>'disabled']) }}
                                                </div>
                                                </div>
                                            <div class="form-group">
                                                    <label class="control-label col-md-3">Durtion In Minutes</label>
                                                    <div class="col-md-9">
                                                    {{ Form::text('service[cycling][duration]', $cycling['title'], ['id' => 'cycling_duration','class' => 'form-control','placeholder'=>'Durtion In Minutes','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                                
                                        </div>
                                    </div>
                                                
                                    <div class="form">
                                                   <h3 class="heading_form">
                                                     ZipLine
                                                   <label class="checkbox-inline">
                                                        <input type="checkbox" name="zip_line" id="inlineCheckbox21" class="services" data-service="zip_line">
                                                    </label>
                                                   </h3>
                                                    <div class="form-body">
                                                        
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
                                                            <label class="control-label col-md-3">Title</label>
                                                            <div class="col-md-9">
                                                                {{ Form::text('service[zip_line][title]', $zip_line['title'], ['id' => 'zip_line_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Length In Meter</label>
                                                            <div class="col-md-9">
                                                            {{ Form::text('service[zip_line][length]', $zip_line['length'], ['id' => 'zip_line_length','class' => 'form-control','placeholder'=>'Length In Meter','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Height In Meter</label>
                                                            <div class="col-md-9">
                                                            {{ Form::text('service[zip_line][height]', $zip_line['height'], ['id' => 'zip_line_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                    </div>
                                                </div>
                                                
                                    <div class="form">
                                                    <h3 class="heading_form">
                                                        Trekking
                                                    <label class="checkbox-inline">    
                                                        <input type="checkbox" name="trekking" id="inlineCheckbox21" class="services" data-service="trekking">
                                                    </label>
                                                    </h3>
                                                    <div class="form-body">
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
                                                            <label class="control-label col-md-3">Title</label>
                                                            <div class="col-md-9">
                                                                {{ Form::text('service[trekking][title]', $trekking['title'], ['id' => 'trekking_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Length In KM</label>
                                                            <div class="col-md-9">
                                                            {{ Form::text('service[trekking][length]', $trekking['length'], ['id' => 'trekking_length','class' => 'form-control','placeholder'=>'Length In KM','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Duration In Minutes</label>
                                                            <div class="col-md-9">
                                                            {{ Form::text('service[trekking][duration]', $trekking['duration'], ['id' => 'trekking_duration','class' => 'form-control','placeholder'=>'Duration In Minutes','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                                                                
                                                    </div>
                                                </div>
                    
                                    <div class="form">
                                                    <h3 class="heading_form">
                                                        Paint Ball
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="pain_ball" id="inlineCheckbox21" class="services" data-service="pain_ball">
                                                    </label>
                                                    </h3>
                                                    <div class="form-body">
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
                                                            <label class="control-label col-md-3">Number Of Round</label>
                                                            <div class="col-md-9">
                                                                {{ Form::text('service[pain_ball][no_of_round]', $pain_ball['no_of_round'], ['id' => 'no_of_round','class' => 'form-control','placeholder'=>'Number Of Round','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Number Of Ball</label>
                                                            <div class="col-md-9">
                                                            {{ Form::text('service[pain_ball][no_of_ball]', $pain_ball['no_of_ball'], ['id' => 'no_of_ball','class' => 'form-control','placeholder'=>'Number Of Ball','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                    </div>
                                                </div>
                    
                                    <div class="form">
                                                    <h3 class="heading_form">
                                                    Paragliding
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="paragliding" id="inlineCheckbox21" class="services" data-service="paragliding">
                                                    </label>
                                                    </h3>
                                                    
                                                    <div class="form-body">
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
                                                            <label class="control-label col-md-3">Height In Meter</label>
                                                            <div class="col-md-9">
                                                                {{ Form::text('service[paragliding][height]', $paragliding['height'], ['id' => 'paragliding_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Duration In Minutes</label>
                                                            <div class="col-md-9">
                                                            {{ Form::text('service[paragliding][duration]', $paragliding['duration'], ['id' => 'paragliding_duration','class' => 'form-control','placeholder'=>'Duration In Minutes','disabled'=>'disabled']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                    </div>
                                                </div>

                                    <div class="form">
                                        
                                        <h3 class="heading_form">
                                           Meal
                                            <button type="button" title="Add Meal" class="btn btn-success btn-add pull-right add_field_button_meal" >
                                               Add Meal
                                            </button>
                                        </h3>
                                            
                                        <div class="form-body">                                        
                                            <div class="input_fields_wrap_meal">  
                                                @if(count($campingDetail->campingMeal)>0 )
                                                    @foreach($campingDetail->campingMeal as $key=>$value)
                                                        <div class="form-group">
                                                            <div class="col-md-10">
                                                                <textarea class="form-control" id="meal-{{$key+1}}" name="meal[]" placeholder="Meal">{{$value['file_url']}}</textarea>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="button" class="btn pull-right btn-danger btn-remove remove_field_button_meal">
                                                                    Remove
                                                                </button>
                                                            </div>
                                                        </div>

                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form">
                                        <h3 class="heading_form">
                                           Inclusions Details If Any 
                                            <button type="button" title="Inclusion Details" class="btn btn-success btn-add pull-right add_field_button_inclusion" >
                                               Add Details
                                            </button>
                                        </h3>
                                        
                                        
                                        <div class="form-body">                                        
                                            <div class="input_fields_wrap_inclusion row">  
                                                @if(count($campingDetail->campingInclusion)>0 )
                                                    @foreach($campingDetail->campingInclusion as $key=>$value)
                                                        
                                                        <div class="form-group">
                                                            <div class="col-md-10">
                                                                <textarea class="form-control" id="inclusion-{{$key+1}}" name="inclusion[]" placeholder="Add Inclusion Detail">{{$value['file_url']}}</textarea>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="button" class="btn pull-right btn-danger btn-remove remove_field_button_inclusion">
                                                                    Remove 
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="form">
                                        <h3 class="heading_form">
                                            Exclusions Details If Any
                                             <button type="button" title="Exclusion Details" class="btn btn-success btn-add pull-right add_field_button_exclusion" >
                                                    Add Details
                                             </button>
                                        </h3>
                                                                                    
                                        <div class="form-body">                                        
                                            <div class="input_fields_wrap_exclusion row">  
                                                @if(count($campingDetail->campingExclusion)>0 )
                                                    @foreach($campingDetail->campingExclusion as $key=>$value)
                                                    <div class="form-group">
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" id="exclusion-{{$key+1}}" name="exclusion[]" placeholder="Add Exclusion Detail">{{$value['file_url']}}</textarea>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn pull-right btn-danger btn-remove remove_field_button_exclusion">
                                                                Remove
                                                            </button>
                                                        </div>
                                                    </div>

                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="form">
                                        <h3 class="heading_form">
                                            Images   
                                            <button type="button" title="Add Images" class="btn btn-success btn-add pull-right add_field_button" >
                                               Add Images
                                            </button>
                                        </h3>
                                       
                                    
                                        <!-- BEGIN FORM-->
                                        <div class="form-body">
                                            <div class="input_fields_wrap"></div>
                                            <div class="img_gallery">
                                                @if(count($campingDetail->campingImages)>0 )
                                                    @foreach($campingDetail->campingImages as $key=>$value)
                                                        <div class="clearfix">
                                                            <label class="upload_img">
                                                                <img src="{{$value['file_url']}}" />
                                                                <button type="button" class="remove_img btn-remove remove_field" data-href="{{URL::to('/agency/delete-activity-image')}}/{{$value['id']}}/{{$value['agency_activity_id']}}">X</button>
                                                            </label> 
                                                        </div>
                                                    @endforeach
                                                @endif                                                
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="form">
                                        <h3 class="heading_form">
                                           Videos
                                             <button type="button"  title="Add Videos" class="btn btn-success btn-add pull-right add_video_button" >
                                                Add Videos
                                            </button>
                                        </h3>
                                        
                                        
                                        <div class="form-body">                                        
                                            <div class="input_fields_wrap_video"></div>
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

                                    <div class="form">
                                        <h3 class="heading_form">
                                            Terms & Conditions
                                            <button type="button" title="Add Terms & Condition" class="btn btn-success btn-add pull-right add_terms_button" >
                                                Add Terms & Consitions
                                            </button>
                                        </h3>
                                        
                                        
                                        
                                        <div class="form-body">                                        
                                            <div class="input_fields_wrap_terms">  
                                                @if(count($campingDetail->campingTerms)>0 )
                                                    @foreach($campingDetail->campingTerms as $key=>$value)
                                                    <div class="form-group">
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" id="terms-{{$key+1}}" name="terms[]" placeholder="Terms & Condition">{{$value['file_url']}}</textarea>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn pull-right btn-danger btn-remove remove_terms_field">
                                                                Remove
                                                            </button>
                                                        </div>
                                                    </div>
                                                                
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="form">
                                        <h3 class="heading_form">
                                            Special Notes 
                                            <button type="button" title="Add Special Notes" class="btn btn-success btn-add pull-right add_notes_button" >
                                                Add Notes
                                            </button>
                                        </h3>
                                            
                                        
                                        
                                            <div class="form-body">                                        
                                                <div class="input_fields_wrap_notes"> 
                                                    @if(count($campingDetail->campingNotes)>0 )
                                                        @foreach($campingDetail->campingNotes as $key=>$value)
                                                            <div class="form-group">
                                                                <div class="col-md-10">
                                                                    <textarea class="form-control" id="notes-{{$key+1}}" name="notes[]" placeholder="Special Notes" >{{$value['file_url']}}</textarea>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="button" class="btn pull-right btn-danger btn-remove remove_notes_field">
                                                                        Add Notes
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        
                                    </div>

                                    <div class="form">
                                        <h3 class="heading_form">
                                            Price
                                        </h3>
                                        
                                        <div class="form-body">                                        
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Triple/Quarter Sharing Price</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('triple_sharing', $campingDetail['triple_sharing'], ['id' => 'triple_sharing','class' => 'form-control','placeholder'=>'Triple/Quarter Sharing Price']) }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-body">                                        
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Double Sharing Price</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('double_sharing', $campingDetail['double_sharing'], ['id' => 'double_sharing','class' => 'form-control','placeholder'=>'Double Sharing Price']) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <input type="hidden" name="camping_id" value="{{Request::segment(3)}}" />
                                    <div class="form_btn right">
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