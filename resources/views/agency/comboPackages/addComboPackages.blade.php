@extends('agency.mainLayout.template')
  @section('title')
    Add Combo Packages
  @endsection
@section('content')
<?php 
use App\Helpers\CustomHelper;
?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">
            Add Combo Packages
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
                    <a href="javascript:void(0);">Add Combo Packages</a>
                </li>
            </ul>
        </div>        
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS -->           
        <div class="row">
            <div class="col-md-10">
                {!! Form::open(array('route' => 'agency.save-combo-package', 'class' => 'form','id'=>'combo-form','enctype'=>'multipart/form-data')) !!}
                    <div class="form">
                        <div class="form-body">
                            <div class="form-group clearfix">
                                <label class="control-label col-md-3">Package Title</label>
                                <div class="col-md-9">
                                    {{ Form::text('combo_title', null, ['id' => 'combo_title','class' => 'form-control','placeholder'=>'Enter Package Title']) }}
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="control-label col-md-3">Package Description</label>
                                <div class="col-md-9">
                                    {{ Form::textarea('combo_description', null, ['id' => 'combo_description','class' => 'form-control','placeholder'=>'Enter Description','rows'=>5]) }}
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="control-label col-md-3">Location</label>
                                <div class="col-md-9">
                                    {{ Form::text('combo_location', null, ['id' => 'location','class' => 'form-control','placeholder'=>'Enter Location']) }}
                                    <input type="hidden" name="latitude" id="latitude" value="" />
                                    <input type="hidden" name="longitude" id="longitude" value="" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form">
                        <h3 class="heading_form">
                            Camping
                            <label class="checkbox-inline">
                                <input type="checkbox" name="camping" id="inlineCheckbox21" class="services" data-service="camping">
                            </label>
                        </h3>
                        <div class="form-body"> 
                            <div class="row">
                                <div class="col-md-12 camping">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Camp Description</label>
                                        <div class="col-md-9">
                                            {{ Form::textarea('camp_description', null, ['id' => 'camp_description','class' => 'form-control','placeholder'=>'Enter Description','disabled'=>'disabled','rows'=>5]) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Days</label>
                                        <div class="col-md-9">
                                            {{ Form::selectRange('days', 1, 15,null,['id' => 'days','class' => 'form-control','disabled'=>'disabled']) }}
                                        </div>
                                    </div>    
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Night</label>
                                        <div class="col-md-9">
                                            {{ Form::selectRange('night', 0, 14,null,['id' => 'night','class' => 'form-control','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="camItenary" class="form" style="display:none;">
                        <h3 class="heading_form">
                            Combo Package Itinerary
                        </h3>
                        <div class="form-body">                                        
                            <div class="input_fields_wrap_itenory row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Day 1</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="itinerary-1" name="itinerary[]" placeholder="itinerary" rows="3" disabled="disabled"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form">
                        <h3 class="heading_form">
                            Rafting
                            <label class="checkbox-inline ">
                                <input type="checkbox" name="rafting" id="inlineCheckbox21" class="services" data-service="rafting">                                                            
                            </label>
                        </h3>
                        <div class="form-body"> 
                            <div class="row">
                                <div class="col-md-12 rafting">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Title</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[rafting][title]', null, ['id' => 'rafting_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Length</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[rafting][length]',null,['id' => 'rafting_length','class' => 'form-control rafting_service','placeholder'=>'Length','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Duration</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[rafting][duration]', null,['id' => 'rafting_duration','class' => 'form-control rafting_service','placeholder'=>'Duration','disabled'=>'disabled']) }}
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
                            <div class="row">
                                <div class="col-md-12 bunjee">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Title</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[bunjee][title]', null, ['id' => 'bunjee_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Height</label>
                                        <div class="col-md-9">
                                        {{ Form::text('service[bunjee][height]', null, ['id' => 'bunjee_height','class' => 'form-control bunjee_service','placeholder'=>'Height','disabled'=>'disabled']) }}
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
                            <div class="row">
                                <div class="col-md-12 flying_fox_tandom">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Title</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[flying_fox_tandom][title]', null, ['id' => 'flying_fox_tandom_title','class' => 'form-control ','placeholder'=>'Title','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Length</label>
                                        <div class="col-md-9">
                                        {{ Form::text('service[flying_fox_tandom][length]', null, ['id' => 'flying_fox_tandom_length','class' => 'form-control flying_fox_tandom_service','placeholder'=>'Length','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Height</label>
                                        <div class="col-md-9">
                                        {{ Form::text('service[flying_fox_tandom][height]', null, ['id' => 'flying_fox_tandom_height','class' => 'form-control flying_fox_tandom_service','placeholder'=>'Height','disabled'=>'disabled']) }}
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
                            <div class="row">
                                <div class="col-md-12 flying_fox_solo">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Title</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[flying_fox_solo][title]', null, ['id' => 'flying_fox_solo_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Length</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[flying_fox_solo][length]', null, ['id' => 'flying_fox_solo_length','class' => 'form-control flying_fox_solo_service','placeholder'=>'Length','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Height</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[flying_fox_solo][height]', null, ['id' => 'flying_fox_solo_height','class' => 'form-control flying_fox_solo_service','placeholder'=>'Height','disabled'=>'disabled']) }}
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
                            <div class="row">
                                <div class="col-md-12 swing">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Title</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[swing][title]', null, ['id' => 'swing_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Height</label>
                                        <div class="col-md-9">
                                        {{ Form::text('service[swing][height]', null, ['id' => 'swing_height','class' => 'form-control swing_service','placeholder'=>'Height','disabled'=>'disabled']) }}
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
                            <div class="row">
                                <div class="col-md-12 air_safari">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Title</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[air_safari][title]', null, ['id' => 'air_safari_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Duration</label>
                                        <div class="col-md-9">
                                        {{ Form::text('service[air_safari][duration]', null, ['id' => 'air_safari_duration','class' => 'form-control air_safari_service','placeholder'=>'Duration','disabled'=>'disabled']) }}
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
                            <div class="row">
                                <div class="col-md-12 air_balloon">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Title</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[air_balloon][title]', null, ['id' => 'air_balloon_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Duration</label>
                                        <div class="col-md-9">
                                        {{ Form::text('service[air_balloon][duration]', null, ['id' => 'air_balloon_duration','class' => 'form-control air_balloon_service','placeholder'=>'Duration','disabled'=>'disabled']) }}
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
                            <div class="row">
                                <div class="col-md-12 cycling">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Title</label>
                                        <div class=" col-md-9">
                                            {{ Form::text('service[cycling][title]', null, ['id' => 'cycling_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Length</label>
                                        <div class="col-md-9">
                                        {{ Form::text('service[cycling][length]', null, ['id' => 'cycling_length','class' => 'form-control cycling_service','placeholder'=>'Length','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Duration</label>
                                        <div class="col-md-9">
                                        {{ Form::text('service[cycling][duration]', null, ['id' => 'cycling_duration','class' => 'form-control cycling_service','placeholder'=>'Duration','disabled'=>'disabled']) }}
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
                            <div class="row">
                                <div class="col-md-12 zip_line">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Title</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[zip_line][title]', null, ['id' => 'zip_line_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Length</label>
                                        <div class="col-md-9">
                                        {{ Form::text('service[zip_line][length]', null, ['id' => 'zip_line_length','class' => 'form-control zip_line_service','placeholder'=>'Length','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group" clearfix>
                                        <label class="control-label col-md-3">Height</label>
                                        <div class="col-md-9">
                                        {{ Form::text('service[zip_line][height]', null, ['id' => 'zip_line_height','class' => 'form-control zip_line_service','placeholder'=>'Height','disabled'=>'disabled']) }}
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
                            <div class="row">
                                <div class="col-md-12 trekking">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Title</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[trekking][title]', null, ['id' => 'trekking_title','class' => 'form-control trekking_service','placeholder'=>'Title','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Length</label>
                                        <div class="col-md-9">
                                        {{ Form::text('service[trekking][length]', null, ['id' => 'trekking_length','class' => 'form-control trekking_service','placeholder'=>'Length','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Duration</label>
                                        <div class="col-md-9">
                                        {{ Form::text('service[trekking][duration]', null, ['id' => 'trekking_duration','class' => 'form-control','placeholder'=>'Duration','disabled'=>'disabled']) }}
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
                            <div class="row">
                                <div class="col-md-12 pain_ball">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Title</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[pain_ball][title]', null, ['id' => 'pain_ball_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Number Of Round</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[pain_ball][no_of_round]', null, ['id' => 'no_of_round','class' => 'form-control pain_ball_service','placeholder'=>'Number Of Round','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Number Of Ball</label>
                                        <div class="col-md-9">
                                        {{ Form::text('service[pain_ball][no_of_ball]', null, ['id' => 'no_of_ball','class' => 'form-control pain_ball_service','placeholder'=>'Number Of Ball','disabled'=>'disabled']) }}
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
                            <div class="row">
                                <div class="col-md-12 paragliding">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Title</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[paragliding][title]', null, ['id' => 'paragliding_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Height</label>
                                        <div class="col-md-9">
                                            {{ Form::text('service[paragliding][height]', null, ['id' => 'paragliding_height','class' => 'form-control paragliding_service','placeholder'=>'Height','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Duration</label>
                                        <div class="col-md-9">
                                        {{ Form::text('service[paragliding][duration]', null, ['id' => 'paragliding_duration','class' => 'form-control paragliding_service','placeholder'=>'Duration','disabled'=>'disabled']) }}
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
                            <div class="input_fields_wrap_meal row"></div>
                        </div>
                    </div>

                    <div class="form">
                        <h3 class="heading_form">
                            Inclusions Details If Any
                            <button type="button" title="Inclusion Details" class="btn btn-success btn-add pull-right add_field_button_inclusion" >
                                Add Inclusion Details
                            </button>
                        </h3>
                        
                        <div class="form-body">                                        
                            <div class="input_fields_wrap_inclusion row"></div>
                        </div>
                    </div>
                    
                    <div class="form">
                        <h3 class="heading_form">
                            Exclusion Details If Any
                            <button type="button" title="Exclusion Details" class="btn btn-success btn-add pull-right add_field_button_exclusion" >
                                Excusive Details
                            </button>
                        </h3>
                                                            
                        <div class="form-body">                                        
                            <div class="input_fields_wrap_exclusion row"></div>
                        </div>
                    </div>


                    <div class="form">
                        <h3 class="heading_form">
                            Special Notes 
                            <button type="button" title="Add Special Notes" class="btn btn-success btn-add pull-right add_notes_button" >
                                Add Special Notes
                            </button>
                        </h3>
                        
                        <div class="form-body">                                        
                            <div class="input_fields_wrap_notes row"></div>
                        </div>
                    </div>

                    <div class="form">
                        <h3 class="heading_form">
                            Terms & Conditions 
                            <button type="button" title="Add Terms & Condition" class="btn btn-success btn-add pull-right add_terms_button" >
                                Add Terms & conditions
                            </button>
                        </h3>
                        
                        <div class="form-body">                                        
                            <div class="input_fields_wrap_terms row">
                        </div>
                    </div>


                    <div class="form">
                        <h3 class="heading_form">
                            Combo Package Images
                            <button type="button" title="Add Images" class="btn btn-success btn-add pull-right add_field_button">
                                Add Images
                            </button>
                        </h3>
                        
                        <div class="form-body">                                        
                            <div class="input_fields_wrap row"></div>
                        </div>
                    
                    </div>

                    <!-- <div class="form">
                        <h3 class="heading_form">
                            Combo Package Videos
                            <button type="button" title="Add Videos" class="btn btn-success btn-add pull-right add_video_button">
                                Add Videos
                            </button>
                        </h3>
                        <div class="form-body">                                        
                            <div class="input_fields_wrap_video row"></div>
                        </div>
                    </div> -->

                    <div class="form">
                        <h3 class="heading_form">
                            Price
                        </h3>
                        
                            <div id="camping" style="display:none">
                                <div class="form-body">                                        
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Triple/Quarter Sharing Price Per Person</label>
                                        <div class="col-md-9">
                                            {{ Form::text('triple_sharing', null, ['id' => 'triple_sharing','class' => 'form-control','placeholder'=>'Triple/Quarter Sharing Price Per Person','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-body">                                        
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Double Sharing Price Per Person</label>
                                        <div class="col-md-9">
                                            {{ Form::text('double_sharing', null, ['id' => 'double_sharing','class' => 'form-control','placeholder'=>'Double Sharing Price Per Person','disabled'=>'disabled']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        
                            <div id="combo">
                                <div class="form-body">                                        
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Package Price</label>
                                        <div class="col-md-9">
                                            {{ Form::text('price', null, ['id' => 'price','class' => 'form-control','placeholder'=>'Package Price']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                            
                    <div class="form_btn">
                        <button type="button" class="btn default">
                            Cancel
                        </button>
                        <button type="submit" class="btn blue">
                            <i class="fa fa-check"></i> 
                            Submit
                        </button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>        
    </div>
</div>
<!-- END CONTENT -->
@endsection