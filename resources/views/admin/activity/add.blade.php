@extends('admin.mainLayout.template')
  @section('title')
    Add Activity
  @endsection
@section('content')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <div class="page-bar">
      <ul class="page-breadcrumb">
        <li>
          <i class="fa fa-home"></i>
          <a href="{{URL::to('/admin/admin-dashboard')}}">Home</a>
          <i class="fa fa-angle-right"></i>
        </li>
        <li>
          <a href="javascript:void(0);">Add Activity</a>
        </li>
      </ul>
    </div>
    <div class="row">
      <div class="portlet box">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <!-- BEGIN REGISTRATION FORM -->
          {!! Form::open(['class'=>'register-form form-horizontal form-row-seperated','route'=>'admin.save-activity','id'=>'addActivity','enctype'=>'multipart/form-data']) !!}
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Activity Name</label>
              <div class="col-md-9">
                <input required class="form-control placeholder-no-fix" type="text" placeholder="Activity Name" name="name" value="" />
              </div>
            </div>
          </div>
<!--          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Activity Unit Type</label>
              <div class="col-md-9">
                <select required class="form-control" name="unit_type">
                  <option value="">Select Unity Type</option>
                  @if(count($unit_type_list)>0)
                    @foreach($unit_type_list as $key=>$value)
                      <option value="{{$value['id']}}">{{$value['unit_name']}}</option>
                    @endforeach
                  @endif
                </select>
              </div>
            </div>
          </div>          -->
          <div class="form-actions">
            <div class="row">      
              <div class="col-md-4">
                <a href="{{URL::to('/admin/list-activity')}}" class="btn btn-success uppercase pull-right">Back</a>
              </div>
              <div class="col-md-5">
                <button type="submit" id="register-submit-btn" class="btn btn-success uppercase">Submit</button>
              </div>              
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection