@extends('agency.mainLayout.template')
  @section('title')
    Edit Activity
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
                    <a href="javascript:void(0);">Edit Activity</a>
                </li>
            </ul>
         </div>
        <h3 class="page-title">
            Edit Activity : {{ucfirst($activityDetail['title'])}}
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
                                {!! Form::open(array('route' => 'agency.update-activity-basic-info', 'class' => 'form','id'=>'activity-form','enctype'=>'multipart/form-data')) !!}
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
                                                        {{ Form::select('activity_id', $activities, $activityDetail['activity_id'], ['id' => 'activity_id','class' => 'form-control','placeholder'=>'Select Activity']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Title</label>
                                                    <div class="form-group">
                                                        {{ Form::text('title', $activityDetail['title'], ['id' => 'title','class' => 'form-control','placeholder'=>'Enter Activity Title']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Description</label>
                                                    <div class="form-group">
                                                        {{ Form::textarea('description', $activityDetail['description'], ['id' => 'description','class' => 'form-control','placeholder'=>'Enter Description','rows'=>5]) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Location</label>
                                                    <div class="form-group">
                                                        {{ Form::text('location', $activityDetail['location'], ['id' => 'location','class' => 'form-control','placeholder'=>'Enter Location']) }}
                                                    </div>
                                                </div>                                                
                                                
                                                <div class="form-group">
                                                    <label class="control-label">Select Activity Unit Type</label>
                                                    <div class="form-group">
                                                        <?php 
                                                        $selected_unit_type=explode(',',$activityDetail['unit_type']);
                                                        $selected_unit_type_value=json_decode($activityDetail['unit_type_value'],true);
                                                        ?>
                                                        <div class="checkbox-list">
                                                            @foreach ( $unitType as $i => $unit_type )
                                                            <div class="col-md-12">
                                                                <label class="control-label">{{$unit_type}}</label>
                                                                <input type="checkbox" name="unit_type[]" id="inlineCheckbox21" class="unit_type_check" value="{{$i}}" @if(in_array($i,$selected_unit_type)) checked @endif>                                                        
                                                                <span style="@if(!in_array($i,$selected_unit_type)) display:none;  @endif" id="unit_type_value_div_{{$i}}" >
                                                                    <input type="text" class="unit_type_value" name="unit_type_value[{{$i}}]" id="unit_type_value_{{$i}}" value="@if(in_array($i,$selected_unit_type)){{trim($selected_unit_type_value[$i])}}@endif" @if(!in_array($i,$selected_unit_type)) disabled  @endif >                                                      
                                                                </span>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">Minimum % amount to book this activity</label>
                                                    <div class="form-group">
                                                        {{ Form::text('minimum_amount_percent', $activityDetail['minimum_amount_percent'], ['id' => 'minimum_amount_percent','class' => 'form-control','placeholder'=>'Enter Minimum % amount to book this activity']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Total Cost Per Person</label>
                                                    <div class="form-group">
                                                        {{ Form::text('price_per_person', $activityDetail['price_per_person'], ['id' => 'price_per_person','class' => 'form-control','placeholder'=>'Enter Price Per Person']) }}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">Total Cost After Discount Per Person</label>
                                                    <div class="form-group">
                                                        {{ Form::text('total_cost_after_discount', $activityDetail['total_cost_after_discount'], ['id' => 'total_cost_after_discount','class' => 'form-control','placeholder'=>'Enter Total Cost After Discount Per Person']) }}
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label">Select Season</label>
                                                    <div class="form-group">
                                                    <?php 
                                                    $working_season = CustomHelper::getMonths();
                                                    $selected_seaons=explode(',',$activityDetail['season']);
                                                    ?>
                                                        <div class="checkbox-list row">
                                                            @foreach ( $working_season as $i => $working_season )
                                                                <label class="checkbox-inline col-md-3">
                                                                    <input type="checkbox" name="season[]" id="inlineCheckbox21" value="{{$i}}" @if(in_array($i,$selected_seaons)) checked @endif />
                                                                    {{$working_season}}
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Open Days</label>
                                                    <div class="form-group">
                                                        <?php 
                                                        $working_days = CustomHelper::getDays();
                                                        $selected_days=explode(',',$activityDetail['days']);
                                                        ?>
                                                        <div class="checkbox-list row">
                                                            @foreach ( $working_days as $i => $working_day )
                                                                <label class="checkbox-inline col-md-3">
                                                                    <input type="checkbox" name="days[]" id="inlineCheckbox21" value="{{$i}}" @if(in_array($i,$selected_days)) checked @endif>
                                                                    {{$working_day}}
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Open Time</label>
                                                    <div class="form-group">
                                                        {{ Form::text('open_time', date('h:i A',strtotime($activityDetail['open_time'])), ['id' => 'open_time','class' => 'form-control timepicker timepicker-no-seconds','placeholder'=>'Enter Open Time']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Close Time</label>
                                                    <div class="form-group">
                                                        {{ Form::text('close_time', date('h:i A',strtotime($activityDetail['close_time'])), ['id' => 'close_time','class' => 'form-control timepicker timepicker-no-seconds','placeholder'=>'Enter Close Time']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Difficulty Level</label>
                                                    <div class="form-group">
                                                        {{ Form::select('difficult_level', $levels, $activityDetail['difficult_level'], ['id' => 'difficult_level','class' => 'form-control','placeholder'=>'Select Difficulty Level']) }}
                                                    </div>
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
                                                    @if(count($activityDetail->activityImages)>0 )
                                                        @foreach($activityDetail->activityImages as $key=>$value)
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
                                                    @if(count($activityDetail->activityVideos)>0 )
                                                        @foreach($activityDetail->activityVideos as $key=>$value)
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
                                                    @if(count($activityDetail->activityTerms)>0 )
                                                        @foreach($activityDetail->activityTerms as $key=>$value)
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
                                                    @if(count($activityDetail->activityNotes)>0 )
                                                        @foreach($activityDetail->activityNotes as $key=>$value) 
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
                                    <input type="hidden" name="latitude" id="latitude" value="{{$activityDetail['latitude']}}" />
                                    <input type="hidden" name="longitude" id="longitude" value="{{$activityDetail['longitude']}}" />
                                    <input type="hidden" name="agency_activity_id" value="{{Request::segment(4)}}" />
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