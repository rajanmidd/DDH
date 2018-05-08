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
         <h3 class="page-title">
            Add New Activity
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
                    <a href="javascript:void(0);">Add New Activity</a>
                </li>
            </ul>
         </div>
       
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS -->
                
                    <div class="row">
                        <div class="col-md-10">
                        {!! Form::open(array('route' => 'agency.save-activity-basic-info', 'class' => 'form','id'=>'activity-form','enctype'=>'multipart/form-data')) !!}
                            
                                <div class="form-horizontal">
                                    <div class="form-body">
                            <div class="form">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Select Activity</label>
                                        <div class="col-md-9">
                                            {{ Form::select('activity_id', $activities, null, ['id' => 'activity_id','class' => 'form-control','placeholder'=>'Select Activity']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Title</label>
                                        <div class=" col-md-9">
                                            {{ Form::text('title', null, ['id' => 'title','class' => 'form-control','placeholder'=>'Enter Activity Title']) }}
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label col-md-3">Description</label>
                                        <div class="col-md-9">
                                            {{ Form::textarea('description', null, ['id' => 'description','class' => 'form-control','placeholder'=>'Enter Description','rows'=>5]) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Location</label>
                                        <div class="col-md-9">
                                            {{ Form::text('location', null, ['id' => 'location','class' => 'form-control','placeholder'=>'Enter Location']) }}
                                        </div>
                                    </div>                                        

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Select Activity Unit Type</label>
                                        <div class="col-md-9">
                                            <div class="checkbox-list row">
                                                @foreach ( $unitType as $i => $unit_type )
                                                <div class="col-md-4">
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

                                    <!-- <div class="form-group">
                                        <label class="control-label col-md-3">Minimum % amount to book this activity</label>
                                        <div class="col-md-9">
                                            {{ Form::text('minimum_amount_percent', null, ['id' => 'minimum_amount_percent','class' => 'form-control','placeholder'=>'Enter Minimum % amount to book this activity']) }}
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Price Per Person</label>
                                        <div class="col-md-9">
                                            {{ Form::text('price_per_person', null, ['id' => 'price_per_person','class' => 'form-control','placeholder'=>'Enter Price Per Person']) }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Select Season</label>
                                        <div class=" col-md-9">
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
                                        <label class="control-label col-md-3">Difficulty Level</label>
                                        <div class="col-md-9">
                                            {{ Form::select('difficult_level', $levels, null, ['id' => 'difficult_level','class' => 'form-control','placeholder'=>'Select Difficulty Level']) }}
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="latitude" id="latitude" />
                                <input type="hidden" name="longitude" id="longitude" />
                            </div>
                            
                            
                            <!-- Top form -->
                           <!-- Add Images --> 
                            <div class="form">
                                <h3 class="heading_form">Images
                                    <button type="button" title="Add Images" class="btn btn-success btn-add pull-right add_field_button" >
                                       Add Images
                                    </button>
                                </h3>
                                
                                <div class="form-body">                                        
                                    <div class="input_fields_wrap row"></div>
                                </div>
                            </div>   
                            
                            <!-- Add Images -->
                            <!-- Add Videos -->            
                                        
                            <!-- <div class="form">
                                <h3 class="heading_form">
                                 Videos
                                 <button type="button" title="Add Videos" class="btn btn-success btn-add pull-right add_video_button" >
                                   Add Videos
                                </button>
                                </h3>
                                
                                <div class="form-body">                                        
                                    <div class="input_fields_wrap_video row"></div>
                                </div>
                            </div> -->
                            <!-- Add Videos -->  
                                        
                             <!--Terms & Conditions -->           
                            <div class="form">
                                <div class="portlet-title">
                                    <h3 class="heading_form">
                                        Terms & Conditions 
                                        <button type="button" title="Add Terms & Condition" class="btn btn-success btn-add pull-right add_terms_button" >
                                           Add Terms & Conditions
                                        </button>
                                    </h3>
                                </div>
                                <div class="form-body">                                        
                                    <div class="input_fields_wrap_terms row"></div>
                                </div>
                            </div>
                            
                             <!--Terms & Conditions -->
                                        
                             <!--Special Notes -->
      
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
                                <div class="form_btn">
                                    <button type="button" class="btn default">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn blue">
                                        <i class="fa fa-check"></i> 
                                        Submit
                                    </button>
                                </div>
                                
                            </div> 
                            {{ Form::close() }}
                            
                        </div>
                    </div>
                            
                        </div>
                    </div>
            </div>
        </div>
<!-- END CONTENT -->
@endsection