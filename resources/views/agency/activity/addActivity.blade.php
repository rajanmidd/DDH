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
                    <div class="row">
                        <div class="col-md-12">
                        {!! Form::open(array('route' => 'agency.save-activity-basic-info', 'class' => 'form','id'=>'activity-form','enctype'=>'multipart/form-data')) !!}
                            <div class="portlet box yellow">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i> Activity Information 
                                    </div>
                                </div>
                                <div class="portlet-body form">
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
                                            <label class="control-label">Select Activity Unit Type</label>
                                            <div class="form-group">
                                                <div class="checkbox-list">
                                                    @foreach ( $unitType as $i => $unit_type )
                                                    <div class="col-md-12">
                                                        <label class="control-label">{{$unit_type}}</label>
                                                        <input type="checkbox" name="unit_type[]" id="inlineCheckbox21" class="unit_type_check" value="{{$i}}">  
                                                        <span style="display:none;" id="unit_type_value_div_{{$i}}" >
                                                            <input type="text" class="unit_type_value" name="unit_type_value[{{$i}}]" id="unit_type_value_{{$i}}" value="" disabled >                                                      
                                                        </span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Select Season</label>
                                            <div class="form-group">
                                            <?php $working_season = CustomHelper::getMonths();?>
                                                <div class="checkbox-list row">
                                                    @foreach ( $working_season as $i => $working_season )
                                                    <label class="checkbox-inline col-md-3">
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
                                                    <label class="checkbox-inline col-md-3">
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
                                    <div class="form-body">                                        
                                        <div class="input_fields_wrap row"></div>
                                    </div>
                                </div>
                            </div>             
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Activity Videos
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
                                        <div class="input_fields_wrap_terms row"></div>
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
                                    <div class="form-actions right">
                                        <button type="button" class="btn default">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn blue">
                                            <i class="fa fa-check"></i> 
                                            Submit
                                        </button>
                                    </div>
                                </div>
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