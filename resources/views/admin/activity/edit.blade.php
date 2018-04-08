@extends('admin.mainLayout.template')
  @section('title')
    Add Activity
  @endsection
@section('content')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        Edit Activity : {{ucfirst($activityDetail->name)}}
    </h3>        
    <div class="page-bar">
      <ul class="page-breadcrumb">
        <li>
          <i class="fa fa-home"></i>
          <a href="{{URL::to('/admin/admin-dashboard')}}">Home</a>
          <i class="fa fa-angle-right"></i>
        </li>
        <li>
          <a href="javascript:void(0);">Edit Activity</a>
        </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-10">
          <div class="form-horizontal">
              <div class="form-body">
                  <div class="row">
                      <div class="col-md-12">                                
                          <!-- BEGIN FORM-->
                          {!! Form::open(['class'=>'register-form form-horizontal form-row-seperated','route'=>'admin.update-activity','id'=>'addActivity','enctype'=>'multipart/form-data']) !!}
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Activity Name</label>
                                    <div class="col-md-9">
                                        {{ Form::text('name', $activityDetail->name, ['id' => 'name','class' => 'form-control','placeholder'=>'Enter Activity Name']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group">
                                <label class="control-label col-md-3">Activity Image</label>
                                <div class="col-md-9">
                                    <input type="file" name="activity_image"  />
                                </div>
                                </div>
                            </div>
                          <input type="hidden" name="id" value="{{$activityDetail->id}}" />
                          <div class="form_btn">
                              <button type="button" class="btn default" onclick="location.href='{{URL::to('admin/list-activity')}}'">
                                  Cancel
                              </button>
                              <button type="submit" class="btn blue">
                                  <i class="fa fa-check"></i> 
                                  Update
                              </button>
                          </div>
                          {!! Form::close() !!}
                          <!-- END FORM-->
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  </div>
</div>
@endsection