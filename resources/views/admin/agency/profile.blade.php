@extends('admin.mainLayout.template')
  @section('title')
    View Profile
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
          <a href="javascript:void(0);">View Profile</a>
        </li>
      </ul>
    </div>

    <div class="page-title">
      <div class="title_left">
        <h3>View Profile :- {{ucfirst($agencyDetail['owner_name'])}}</h3>
      </div>
    </div>
    
    @if (session()->has('success'))
    <div class="row">
      <div class="col-xs-12"> 
        <div class="alert alert-success">      
          <p>{!! session()->get('success') !!}</p>
        </div>
      </div>
    </div>
    @endif

    @if (session()->has('error'))
    <div class="row">
      <div class="col-xs-12"> 
        <div class="alert alert-error">      
          <p>{!! session()->get('error') !!}</p>
        </div>
      </div>
    </div>
    @endif

    <div class="row">
      <div class="portlet box">
<!--        <div class="col-xs-12 green"> 
          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              
            </ul>
          </div>
        </div>-->

        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="profile_img form-group">                  
                <div id="crop-avatar">
                  @if ($agencyDetail['status']== 0)
                  <a data-toggle="modal" data-target="#IDModalReason-{{$agencyDetail['id']}}" onclick="return acceptAgency({{$agencyDetail['id']}})" class="btn btn-success add_field_button_skype">Accept</a>
                  <a data-toggle="modal" data-target="#IDModalReason-{{$agencyDetail['id']}}" onclick="return rejectAgency({{$agencyDetail['id']}})" class="btn btn-danger add_field_button_skype">Reject</a>
                  @elseif ($agencyDetail['status']== 1)
                  <a data-toggle="modal" data-target="#IDModalReason-{{$agencyDetail['id']}}" onclick="return rejectAgency({{$agencyDetail['id']}})" class="btn btn-danger add_field_button_skype">Reject</a>
                  @else
                  <a data-toggle="modal" data-target="#IDModalReason-{{$agencyDetail['id']}}" onclick="return acceptAgency({{$agencyDetail['id']}})" class="btn btn-success add_field_button_skype">Accept</a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-9 col-sm-9 col-xs-12">
          <!-- BEGIN REGISTRATION FORM -->
          {!! Form::open(['class'=>'register-form form-horizontal form-row-seperated','id'=>'addPharmacy','enctype'=>'multipart/form-data']) !!}
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Owner Name</label>
              <div class="col-md-9">
                <input disabled class="form-control placeholder-no-fix" type="text" placeholder="Owner Name" name="name" value="{{$agencyDetail['owner_name']}}" />
              </div>
            </div>
          </div>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Mobile</label>
              <div class="col-md-9">
                <input  disabled class="form-control placeholder-no-fix"  type="number" placeholder="Mobile" name="mobile" value="{{$agencyDetail['mobile']}}"/>
              </div>
            </div>
          </div>

          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Email</label>
              <div class="col-md-9">
                <input disabled class="form-control placeholder-no-fix" type="text" placeholder="Email" id="email" value="{{$agencyDetail['email']}}"/>
              </div>
            </div>
          </div>

          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Address</label>
              <div class="col-md-9">
                <input class="form-control placeholder-no-fix" type="text" id="address" placeholder="Address" name="address" value="{{$agencyDetail['address']}}"/>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Certificate Image</label>
            <div class="col-md-9 col-sm-9 col-xs-12">

              @if ($agencyDetail->agencyDocuments['certificate_image']!='')
              <a href="{{$agencyDetail->agencyDocuments['certificate_image']}}" title="Certificate Image" target="_blank"><button type="button" class="btn btn-info btn-xs">View</button></a>
              <a href="{{URL::to('/admin/delete-image')}}?id={{app('request')->input('id') }}&type=license_image" title="Delete licence image" onclick="return confirm('Are you sure you want to delete this uploaded image?');"> <button type="button" class="btn btn-danger btn-xs">Delete</button></a> 
              @endif
              <button type="button" class="btn btn-success btn-xs  SetModel" data-toggle="modal" data-target="#IDModal-{{ app('request')->input('id') }}" onclick="setModel('certificate_image')">Upload</button>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Id Proof</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              @if ($agencyDetail->agencyDocuments['id_proof']!='')
              <a href="{{$agencyDetail->agencyDocuments['id_proof']}}" title="Id Proof Image" target="_blank"><button type="button" class="btn btn-info btn-xs">View</button></a>
              <a href="{{URL::to('/admin/delete-image')}}?id={{app('request')->input('id') }}&type=phar_image" title="delete uploaded doc" onclick="return confirm('Are you sure you want to delete this uploaded Image?');"> <button type="button" class="btn btn-danger btn-xs">Delete</button></a>
              @endif
              <button type="button" class="btn btn-success btn-xs  SetModel" data-toggle="modal" data-target="#IDModal-{{ app('request')->input('id') }}" onclick="setModel('id_proof')">Upload</button>
            </div>
          </div>
          <div class="form-actions">
            <div class="row">
              <div class="col-md-5">
                <a href="{{URL::to('/admin/list-agency')}}" class="btn btn-success uppercase pull-right">Back</a>
              </div>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>


<!-- END CONTENT -->
</div>
</div>

<!-- Modal for image --> 
<div id="IDModal-{{ app('request')->input('id') }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    {!! Form::open(['route' => 'admin.upload-image','class'=>'register-form form-horizontal form-row-seperated', 'onSubmit'=>'return checkUplaodDocs("IDProof");','files'=>true]) !!}
    <!--<form class="form-horizontal form-label-left" enctype="multipart/form-data" onsubmit="return checkUplaodDocs('IDProof');" action="{{URL::to('/admin/upload-image')}}" method="post">-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload</h4>
      </div>
      <div class="modal-body">


        <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <input type="file" class="form-control filestyle IDProof" name="IDProof"  id="IDProof">
            <input type="hidden" name="ID" value="{{ app('request')->input('id') }}" id="agencyId">
            <input type="hidden" name="uploadType" value="" id="uploadType">
            <img src="" id="blah" style="display:none;">
          </div>
        </div>

      </div>
      <div class="modal-footer">

        <button type="submit" class="btn btn-default">Upload</button> 

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
    {!! Form::close() !!}
  </div>
</div>

<!-- Modal for ID docs --> 
<div id="IDModalReason-{{ app('request')->input('id') }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <!--<form class="form-horizontal form-label-left" id="carBlock" enctype="multipart/form-data"  action="block-unblock-car" method="post">-->
    {!! Form::open(['route' => 'admin.agency-accept','class'=>'register-form form-horizontal form-row-seperated','enctype'=>'multipart/form-data']) !!}

    <input type="hidden" name="agency_id_field" id="agency_id_field" value="" />
    <input type="hidden" name="agency_status" id="agency_status" value="" />
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Reason</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea name="reason" required="" data-parsley-required-message="Please enter reason" id="reason" class="resizable_textarea form-control" placeholder="enter reason.." style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 54px;"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default">Submit</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>

<!-- end -->


@endsection