@extends('admin.mainLayout.template') 
@section('title') 
	Manage Combo Packages 
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
					<a href="{{URL::to('/admin/admin-dashboard')}}">Dashboard</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="javascript:void(0);">Manage Combo Packages</a>
				</li>
			</ul>
		</div>
		<div class="page-title">
			<div class="title_left">
				<h3>Manage Combo Packages</h3>
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
		@endif @if (session()->has('error'))
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-error">
					<p>{!! session()->get('error') !!}</p>
				</div>
			</div>
		</div>
		@endif
		<!-- END PAGE HEADER-->
		<ul class="nav nav-tabs">
			<li class="">
				<a href="{{URL::to('/admin/agency-profile')}}?id={{Request::segment(3)}}">Profile </a>
			</li>
			<li class="">
				<a href="{{URL::to('/admin/list-agency-activity')}}/{{Request::segment(3)}}"> Activities </a>
			</li>
			<li class="">
				<a href="{{URL::to('/admin/list-camping-packages')}}/{{Request::segment(3)}}"> Camping Packages </a>
			</li>
			<li class="active">
				<a href="javascript:void(0);"> Combo Packages </a>
			</li>
		</ul>
		<div class="tab-content">
			<!-- BEGIN PAGE CONTENT-->
			<div class="row form-group">
				<div class="col-xs-10">
					<form class="form-inline " id="search_frm" name="search_frm" method="get" action="">
						<div class="pull-right">
							<div class=" form-group">
								<select class="form-control" name="status">
									<option value="">All</option>
									<option value="0" <?php if (isset($_GET[ 'status']) && $_GET[ 'status']=='0' ) { echo 'selected';} ?>>Not Active</option>
									<option value="1" <?php if (isset($_GET[ 'status']) && $_GET[ 'status']=='1' ) { echo 'selected';} ?>>Active</option>
								</select>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-xs-10 ">
					<div class="clearfix"></div>
					<div class="">
						<div class="flip-scroll">
							<div class="flip-content">
							@if(count($combo_packages)>0)
								<?php $i = $combo_packages->perPage() * ($combo_packages->currentPage() - 1) + 1; ?> 
								@foreach($combo_packages as $key=>$value)
								<?php $i++; ?>
								<div class="manage_data_wrap @if($value['status']==0) not_active_bg  @elseif($value['status']==1) active_bg @else pending_bg @endif">
									<div class="data_row clearfix action">
										<a title="Edit" href="{{URL::to('/admin/edit-combo-package')}}/{{Request::segment(3)}}/{{$value['id']}}" class="btn btn-circle">
											<i class="fa fa-pencil"></i>
											Edit
										</a>
										<a title="View" href="{{URL::to('/admin/view-combo-package')}}/{{Request::segment(3)}}/{{$value['id']}}" class="btn btn-circle">
											<i class="fa fa-eye"></i>
											View
										</a>
										<a title="Delete" onclick="return confirm('Are you sure want to delete this package?');" class="btn btn-circle" href="{{URL::to('/admin/delete-combo-package')}}/{{Request::segment(3)}}/{{$value['id']}}">
											<i class="fa fa-trash"></i>
											Delete
										</a>
										@if($value['status']==0)
											<a href="{{URL::to('/admin/update-combo-package-status')}}/1/{{Request::segment(3)}}/{{$value['id']}}" class="btn btn-circle btn-xs green">
												Activate
											</a>
										@else
											<a href="{{URL::to('/admin/update-combo-package-status')}}/0/{{Request::segment(3)}}/{{$value['id']}}" class="btn btn-circle btn-xs red">
												De-activate
											</a>
										@endif
									</div>
									<div class="data_row clearfix">
										<label>Name</label>
										<span>{{ucfirst($value['combo_name'])}} </span>
									</div>
									<div class="data_row clearify">
										<label> Title</label>
										<span>{{ucfirst($value['combo_title'])}}</span>
									</div>
									<div class="data_row clearify">
										<label> Description</label>
										<span>{{$value['combo_description']}}</span>
									</div>
									<div class="data_row clearify">
										<label>Days/Night</label>
										<span>{{$value['days']}}/{{$value['night']}}</span>
									</div>
								</div>
								@endforeach @else
								<div class="no-data">
									<center>Sorry, No Result Found</center>
								</div>
								@endif
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="dataTables_paginate paging_bootstrap_full_number pull-right" id="sample_1_paginate">
										{{$combo_packages->links() }}
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
</div>
@endsection