@extends('admin.mainLayout.template')
@section('title')
@lang('user.user_list')
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
                    <a href="{{URL::to('/merchant/merchant-dashboard')}}">@lang('sidebar.home')</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">@lang('sidebar.users')</a>
                </li>
            </ul>

        </div>

        <div class="page-title">
            <div class="title_left">
                <h3> @lang('sidebar.manage_user')</h3>
            </div>

        </div>

        @if (session()->has('success'))
        <div class="row">
            <div class="col-xs-1"></div> 
            <div class="col-xs-10"> 
                <div class="alert alert-success">      
                    <p>{!! session()->get('success') !!}</p>
                </div>
            </div>
            <div class="col-xs-1"></div>
        </div>
        @endif

        @if (session()->has('error'))
        <div class="row">
            <div class="col-xs-1"></div> 
            <div class="col-xs-10"> 
                <div class="alert alert-error">      
                    <p>{!! session()->get('error') !!}</p>
                </div>
            </div>
            <div class="col-xs-1"></div>
        </div>
        @endif



        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
            </div><div class="clearfix"></div>
            <div class="row">
                <div class="col-xs-12 "> 
                    <form class="form-inline " id="search_frm" name="search_frm" method="get" action="">


                        <div class="pull-right">
                            <div class="form-group">              
                                <input value="<?php
                                if (isset($_GET['search_text'])) {
                                    echo$_GET['search_text'];
                                }
                                ?>" type="text" name="search_text" class="form-control" placeholder="@lang('user.search_for')"> 
                            </div>
                            <div class=" form-group">
                                <select class="form-control" name="status">
                                    <option value="">@lang('user.choose_option')</option>
                                    <option value="1" <?php
                                    if (isset($_GET['status']) && $_GET['status'] == '1') {
                                        echo'selected';
                                    }
                                    ?>>Verified</option>
                                    <option value="0" <?php
                                    if (isset($_GET['status']) && $_GET['status'] == '0') {
                                        echo'selected';
                                    }
                                    ?>> @lang('user.Not_Verified')</option>

                                    <option value="2" <?php
                                    if (isset($_GET['status']) && $_GET['status'] == '2') {
                                        echo'selected';
                                    }
                                    ?>>@lang('user.Blocked_User')</option>
                                    
                                     <option value="3" <?php
                                    if (isset($_GET['status']) && $_GET['status'] == '3') {
                                        echo'selected';
                                    }
                                    ?>>@lang('user.unblocked_user')</option>
                                    
                                </select> 
                            </div>
                            <div class=" form-group">
                                <button style=" margin-bottom: 0px;margin-right: 0px;" type="submit" class="btn btn-default">@lang('user.Go')</button>
                            </div>


                            <div class=" form-group">

                                <a href="list-user" style=" margin-bottom: 0px;margin-right: 0px;"  class="btn btn-default">@lang('user.Reset')</a>
                            </div>



                        </div>
                    </form>
                </div>
            </div>
            <br/>
            <div class="clearfix"></div>
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-table"></i>@lang('sidebar.manage_user')
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th width="10%">
                                    Sr No.
                                </th>
                                <th>
                                    @lang('user.name')
                                </th>
                                <th class="numeric">
                                    @lang('user.email')
                                </th>
                                <th class="numeric">
                                    @lang('user.mobile_number')
                                </th>
                                <th class="numeric">
                                    @lang('user.verification_status')
                                </th>
                                <th class="numeric">
                                    @lang('user.action')
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(count($user_list)>0)
                       <?php $i =$user_list->perPage() * ($user_list->currentPage()-1)+1; ?>
                            @foreach($user_list as $key=>$value)
                            <tr>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$value['first_name']}} {{$value['last_name']}}
                                </td>
                                <td class="numeric">
                                    {{$value['email']}}
                                </td>
                                <td class="numeric">
                                    {{$value['mobile']}}
                                </td>
                                <td class="numeric">
                                    {{$value['status']==1?'Verified':'not verified'}}
                                </td>

                                <td class="numeric">
                                    <div class="actions">
                                        <a title="@lang('pharmacy.view')" href="{{URL::to('/admin/user-orders')}}?id={{$value['id']}}"  class="btn btn-circle">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a title="@lang('pharmacy.delete')" class="btn btn-icon-only" style="color:red;" onclick="return confirm(' @lang('user.user_delete_confirm')');" href="{{URL::to('/admin/delete-user')}}?id={{$value['id']}}">
                                            <i class="icon-trash"></i>
                                        </a>
<?php if ($value['is_block'] == 0) { ?>
                                            <a title="@lang('pharmacy.block')" class="btn btn-icon-only" style="color:green;" onclick="return confirm(' @lang('user.user_block_confirm')');" href="{{URL::to('/admin/block-user')}}?id={{$value['id']}}">
                                                <i class="fa icon-ban"></i>
                                            </a>
<?php } else { ?>
                                            <a title="@lang('pharmacy.unblock')" class="btn btn-icon-only" style="color:red;" onclick="return confirm('@lang('user.user_unblock_confirm')');" href="{{URL::to('/admin/unblock-user')}}?id={{$value['id']}}">
                                                <i class="fa icon-ban"></i>
                                            </a>
<?php } ?>
                                    </div>
                                </td>
                            </tr>
<?php $i++; ?>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8"><center>@lang('user.result_not_found')</center></td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="dataTables_paginate paging_bootstrap_full_number pull-right" id="sample_1_paginate">
                                {{$user_list->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT -->
</div>
</div>
@endsection