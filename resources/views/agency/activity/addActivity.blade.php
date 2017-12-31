@extends('agency.mainLayout.template')
  @section('title')
    Add New Activity
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
                    <a href="javascript:void(0);">Add New Activity</a>
                </li>
            </ul>
         </div>
        <h3 class="page-title">
            Add New Activity
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS -->
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line boxless tabbable-reversed">
                    <ul class="nav nav-tabs">
                        <li class="@if($page == 'information') active @endif">
                            <a href="#basic_information" data-toggle="tab"> Activity Information </a>
                        </li>
                        <li class="@if($page == 'images') active @endif">
                            <a href="#images" data-toggle="tab"> Images </a>
                        </li>
                        <li class="@if($page == 'videos') active @endif">
                            <a href="#videos" data-toggle="tab"> Videos </a>
                        </li>
                        <li class="@if($page == 'terms') active @endif">
                            <a href="#terms" data-toggle="tab"> Terms & Conditions </a>
                        </li>
                        <li class="@if($page == 'notes') active @endif">
                            <a href="#notes" data-toggle="tab"> Special Notes </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane @if($page == 'information') active @endif" id="basic_information">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="portlet box yellow">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i> Activity Information 
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <!-- BEGIN FORM-->
                                            {!! Form::open(array('route' => 'agency.save-activity-basic-info', 'class' => 'form','id'=>'activity-form')) !!}
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label class="control-label">Select Activity</label>
                                                        <div class="form-group">
                                                            {{ Form::select('activity_id', $activities, null, ['id' => 'activity_id','class' => 'form-control','placeholder'=>'Select Activity']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Title</label>
                                                        <div class="form-group">
                                                            {{ Form::text('title', null, ['id' => 'title','class' => 'form-control','placeholder'=>'Enter Activity Title']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Location</label>
                                                        <div class="form-group">
                                                            {{ Form::text('location', null, ['id' => 'location','class' => 'form-control','placeholder'=>'Enter Location']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Select Activity Unit Type</label>
                                                        <div class="form-group">
                                                            {{ Form::select('unit_type', $unitType, null, ['id' => 'unit_type','class' => 'form-control','placeholder'=>'Select Activity Unit Type']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Capacity</label>
                                                        <div class="form-group">
                                                            {{ Form::text('capacity', null, ['id' => 'capacity','class' => 'form-control','placeholder'=>'Enter Capacity']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Difficulty Level</label>
                                                        <div class="form-group">
                                                            {{ Form::select('difficult_level', $levels, null, ['id' => 'difficult_level','class' => 'form-control','placeholder'=>'Select Difficulty Level']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Minimum % amount to book this activity</label>
                                                        <div class="form-group">
                                                            {{ Form::text('minimum_amount_percent', null, ['id' => 'minimum_amount_percent','class' => 'form-control','placeholder'=>'Enter Minimum % amount to book this activity']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Price Per Person</label>
                                                        <div class="form-group">
                                                            {{ Form::text('price_per_person', null, ['id' => 'price_per_person','class' => 'form-control','placeholder'=>'Enter Price Per Person']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Select Season</label>
                                                        <div class="form-group">
                                                        <?php $working_season = CustomHelper::getMonths();?>
                                                            <div class="checkbox-list row">
                                                                @foreach ( $working_season as $i => $working_season )
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" name="season[]" id="inlineCheckbox21" value="{{$i}}">
                                                                    {{$working_season}}
                                                                </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Open Days</label>
                                                        <div class="form-group">
                                                            <?php $working_days = CustomHelper::getDays();?>
                                                            <div class="checkbox-list row">
                                                                @foreach ( $working_days as $i => $working_day )
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" name="days[]" id="inlineCheckbox21" value="{{$i}}">
                                                                    {{$working_day}}
                                                                </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Open Time</label>
                                                        <div class="form-group">
                                                            {{ Form::text('open_time', null, ['id' => 'open_time','class' => 'form-control timepicker timepicker-no-seconds','placeholder'=>'Enter Open Time']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Close Time</label>
                                                        <div class="form-group">
                                                            {{ Form::text('close_time', null, ['id' => 'close_time','class' => 'form-control timepicker timepicker-no-seconds','placeholder'=>'Enter Close Time']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Description</label>
                                                        <div class="form-group">
                                                            {{ Form::textarea('description', null, ['id' => 'description','class' => 'form-control','placeholder'=>'Enter Description','rows'=>5]) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="latitude" id="latitude" value="" />
                                                <input type="hidden" name="longitude" id="longitude" value="" />
                                                <div class="form-actions right">
                                                    <button type="button" class="btn default">Cancel</button>
                                                    <button type="submit" class="btn blue">
                                                        <i class="fa fa-check"></i> Save</button>
                                                </div>
                                            {{ Form::close() }}
                                            <!-- END FORM-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane @if($page == 'images') active @endif" id="images">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>
                                        Activity Images
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    {!! Form::open(array('route' => 'agency.save-activity-images', 'class' => 'horizontal-form','id'=>'upload-images-form','enctype'=>'multipart/form-data')) !!}
                                        <div class="form-body">                                        
                                            <div class="input_fields_wrap row">  
                                                <div>                                              
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">File input</label>
                                                            <div class="form-group">
                                                                <input type="file" id="file-upload-1" name="activityImages[]"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" />
                                                                <img id="blah" src="http://placehold.it/50x50" alt="your image" width="50" height="50" />
                                                                <button type="button" class="btn btn-success btn-add pull-right add_field_button" >
                                                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                                                </button>
                                                            </div>
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
                                                Save
                                            </button>
                                        </div>
                                        <input type="hidden" name="agency_activity_id" value="{{Request::segment(4)}}" />
                                    {{ Form::close() }}
                                    <!-- END FORM-->
                                </div>
                            </div>                            
                        </div>
                        <div class="tab-pane @if($page == 'videos') active @endif" id="videos">
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Activity Videos
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    {!! Form::open(array('route' => 'agency.save-activity-videos', 'class' => 'horizontal-form','id'=>'upload-videos-form','enctype'=>'multipart/form-data')) !!}
                                        <div class="form-body">                                        
                                            <div class="input_fields_wrap_video row">  
                                                <div>                                              
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">File input</label>
                                                            <div class="form-group">
                                                                <input type="file" id="video-upload-1" name="activityVideos[]">
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-success btn-add pull-right add_video_button" >
                                                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                                        </button>
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
                                                Save
                                            </button>
                                        </div>
                                        <input type="hidden" name="agency_activity_id" value="{{Request::segment(4)}}" />
                                    {{ Form::close() }}
                                    <!-- END FORM-->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane @if($page == 'terms') active @endif" id="terms">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Terms & Conditions 
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    {!! Form::open(array('route' => 'agency.save-activity-terms', 'class' => 'horizontal-form','id'=>'upload-terms-form','enctype'=>'multipart/form-data')) !!}
                                        <div class="form-body">                                        
                                            <div class="input_fields_wrap_terms row">  
                                                <div>                                              
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Terms & Conditions</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="terms-1" name="terms[]">
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-success btn-add pull-right add_terms_button" >
                                                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                                        </button>
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
                                                Save
                                            </button>
                                        </div>
                                        <input type="hidden" name="agency_activity_id" value="{{Request::segment(4)}}" />
                                    {{ Form::close() }}
                                    <!-- END FORM-->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane  @if($page == 'notes') active @endif" id="notes">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>
                                        Special Notes 
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    {!! Form::open(array('route' => 'agency.save-activity-notes', 'class' => 'horizontal-form','id'=>'upload-notes-form','enctype'=>'multipart/form-data')) !!}
                                        <div class="form-body">                                        
                                            <div class="input_fields_wrap_notes row">  
                                                <div>                                              
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Special Notes</label>
                                                            <div class="form-group">
                                                            <input type="text" class="form-control" id="notes-1" name="notes[]">
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-success btn-add pull-right add_notes_button" >
                                                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                                        </button>
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
                                                Save
                                            </button>
                                        </div>
                                        <input type="hidden" name="agency_activity_id" value="{{Request::segment(4)}}" />
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
</div>
<!-- END CONTENT -->
@endsection