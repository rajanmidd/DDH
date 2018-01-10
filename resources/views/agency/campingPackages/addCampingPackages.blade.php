@extends('agency.mainLayout.template')
  @section('title')
    Add Camping Packages
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
                    <a href="javascript:void(0);">Add Camping Packages</a>
                </li>
            </ul>
         </div>
        <h3 class="page-title">
        Add Camping Packages
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS -->
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line boxless tabbable-reversed">
                    <div class="row">
                        <div class="col-md-12">
                        {!! Form::open(array('route' => 'agency.save-camping-package', 'class' => 'form','id'=>'activity-form','enctype'=>'multipart/form-data')) !!}
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
                                                {{ Form::text('camping_name', null, ['id' => 'camping_name','class' => 'form-control','placeholder'=>'Enter Camping Name']) }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Camping Title</label>
                                            <div class="form-group">
                                                {{ Form::text('camping_title', null, ['id' => 'camping_title','class' => 'form-control','placeholder'=>'Enter Camping Title']) }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <div class="form-group">
                                                {{ Form::textarea('camping_description', null, ['id' => 'camping_description','class' => 'form-control','placeholder'=>'Enter Description','rows'=>5]) }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Days</label>
                                            <div class="form-group">
                                                {{ Form::selectRange('days', 1, 15,null,['id' => 'days','class' => 'form-control']) }}
                                            </div>
                                        </div>    
                                        <div class="form-group">
                                            <label class="control-label">Night</label>
                                            <div class="form-group">
                                                {{ Form::selectRange('night', 0, 14,null,['id' => 'night','class' => 'form-control']) }}
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
                                            <div>                                              
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Day 1</label>
                                                        <div class="form-group">
                                                            <textarea class="form-control" id="itinerary-1" name="itinerary[]" placeholder="itinerary" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                        {{ Form::text('rafting_title', null, ['id' => 'rafting_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Length In KM</label>
                                                    <div class="form-group">
                                                        {{ Form::selectRange('rafting_length', 1, 15,null,['id' => 'rafting_length','class' => 'form-control','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Duration In Min.</label>
                                                    <div class="form-group">
                                                        {{ Form::selectRange('rafting_duration', 1, 15,null,['id' => 'rafting_duration','class' => 'form-control','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">From Location</label>
                                                    <div class="form-group">
                                                        {{ Form::text('from_location', null,['id' => 'from_location','class' => 'form-control','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">To Location</label>
                                                    <div class="form-group">
                                                        {{ Form::text('to_location',null,['id' => 'to_location','class' => 'form-control','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
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
                                                        {{ Form::text('bunjee_title', null, ['id' => 'bunjee_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Height In Meter</label>
                                                    <div class="form-group">
                                                    {{ Form::text('bunjee_height', null, ['id' => 'bunjee_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <hr />
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
                                                        {{ Form::text('flying_fox_tandom_title', null, ['id' => 'flying_fox_tandom_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Length In Meter</label>
                                                    <div class="form-group">
                                                    {{ Form::text('flying_fox_tandom_length', null, ['id' => 'flying_fox_tandom_length','class' => 'form-control','placeholder'=>'Length In Meter','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Height In Meter</label>
                                                    <div class="form-group">
                                                    {{ Form::text('flying_fox_tandom_height', null, ['id' => 'flying_fox_tandom_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
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
                                                        {{ Form::text('flying_fox_solo_title', null, ['id' => 'flying_fox_solo_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Length In Meter</label>
                                                    <div class="form-group">
                                                    {{ Form::text('flying_fox_solo_length', null, ['id' => 'flying_fox_solo_length','class' => 'form-control','placeholder'=>'Length In Meter','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Height In Meter</label>
                                                    <div class="form-group">
                                                    {{ Form::text('flying_fox_solo_height', null, ['id' => 'flying_fox_solo_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
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
                                                        {{ Form::text('swing_title', null, ['id' => 'swing_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Height In Meter</label>
                                                    <div class="form-group">
                                                    {{ Form::text('swing_height', null, ['id' => 'swing_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
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
                                                        {{ Form::text('air_safari_title', null, ['id' => 'air_safari_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Durtion In Minutes</label>
                                                    <div class="form-group">
                                                    {{ Form::text('air_safari_duration', null, ['id' => 'air_safari_duration','class' => 'form-control','placeholder'=>'Durtion In Minutes','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
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
                                                        {{ Form::text('air_balloon_title', null, ['id' => 'air_balloon_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Durtion In Minutes</label>
                                                    <div class="form-group">
                                                    {{ Form::text('air_balloon_duration', null, ['id' => 'air_balloon_duration','class' => 'form-control','placeholder'=>'Durtion In Minutes','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
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
                                                        {{ Form::text('cycling_title', null, ['id' => 'cycling_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Length In KM</label>
                                                    <div class="form-group">
                                                    {{ Form::text('cycling_length', null, ['id' => 'cycling_length','class' => 'form-control','placeholder'=>'Length In KM','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Durtion In Minutes</label>
                                                    <div class="form-group">
                                                    {{ Form::text('cycling_duration', null, ['id' => 'cycling_duration','class' => 'form-control','placeholder'=>'Durtion In Minutes','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
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
                                                        {{ Form::text('zip_line_title', null, ['id' => 'zip_line_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Length In Meter</label>
                                                    <div class="form-group">
                                                    {{ Form::text('zip_line_length', null, ['id' => 'zip_line_length','class' => 'form-control','placeholder'=>'Length In Meter','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Height In Meter</label>
                                                    <div class="form-group">
                                                    {{ Form::text('zip_line_height', null, ['id' => 'zip_line_height','class' => 'form-control','placeholder'=>'Height In Meter','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
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
                                                        {{ Form::text('trekking_title', null, ['id' => 'trekking_title','class' => 'form-control','placeholder'=>'Title','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Length In KM</label>
                                                    <div class="form-group">
                                                    {{ Form::text('trekking_length', null, ['id' => 'trekking_length','class' => 'form-control','placeholder'=>'Length In KM','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Duration In Minutes</label>
                                                    <div class="form-group">
                                                    {{ Form::text('trekking_duration', null, ['id' => 'trekking_duration','class' => 'form-control','placeholder'=>'Duration In Minutes','disabled'=>'disabled']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>
                                        Meal
                                    </div>
                                    <div class="caption pull-right">
                                        <button type="button" title="Add Meal" class="btn btn-success btn-add pull-right add_field_button_meal" >
                                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <div class="form-body">                                        
                                        <div class="input_fields_wrap_meal row"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="portlet box yellow">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>
                                        Inclusions Details If Any
                                    </div>
                                    <div class="caption pull-right">
                                        <button type="button" title="Inclusion Details" class="btn btn-success btn-add pull-right add_field_button_inclusion" >
                                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <div class="form-body">                                        
                                        <div class="input_fields_wrap_inclusion row"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet box purple-plum">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>
                                        Exclusion Details If Any
                                    </div>
                                    <div class="caption pull-right">
                                        <button type="button" title="Exclusion Details" class="btn btn-success btn-add pull-right add_field_button_exclusion" >
                                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <div class="form-body">                                        
                                        <div class="input_fields_wrap_exclusion row"></div>
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
                                        <div class="input_fields_wrap_notes row"></div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="portlet box yellow">
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
                                        <div class="input_fields_wrap_terms row"></div>
                                    </div>
                                </div>
                            </div>


                            <div class="portlet box grey-cascade">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>
                                        Camping Images
                                    </div>
                                    <div class="caption pull-right">
                                        <button type="button" title="Add Images" class="btn btn-success btn-add pull-right add_field_button" >
                                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <div class="form-body">                                        
                                        <div class="input_fields_wrap row"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Camping Videos
                                    </div>
                                    <div class="caption pull-right">
                                        <button type="button" title="Add Videos" class="btn btn-success btn-add pull-right add_video_button" >
                                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <div class="form-body">                                        
                                        <div class="input_fields_wrap_video row"></div>
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
                                            <label class="control-label">Total Cost</label>
                                            <div class="form-group">
                                                {{ Form::text('total_cost', null, ['id' => 'total_cost','class' => 'form-control','placeholder'=>'Total Cost']) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-body">                                        
                                        <div class="form-group">
                                            <label class="control-label">Total Cost After Discount</label>
                                            <div class="form-group">
                                                {{ Form::text('total_cost_after_discount', null, ['id' => 'total_cost_after_discount','class' => 'form-control','placeholder'=>'Total Cost After Discount']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                            <div class="form-actions right">
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
        </div>
    </div>
</div>
<!-- END CONTENT -->
@endsection