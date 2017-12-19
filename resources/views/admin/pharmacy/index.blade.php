@extends('admin.mainLayout.template')
@section('title')
@lang('pharmacy.manage_pharmacy')
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
                    <a href="{{URL::to('/admin/admin-dashboard')}}">@lang('sidebar.home')</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">@lang('pharmacy.manage_pharmacy')</a>
                </li>
            </ul>

        </div>

        <div class="page-title">
            <div class="title_left">
                <h3> @lang('pharmacy.manage_pharmacy')</h3>
            </div>

        </div>
        <div class="row">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <a href="{{URL::to('/admin/add-pharmacy')}}"> <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus-square" aria-hidden="true"></i> @lang('pharmacy.add_new_pharmacy')</button></a>
            </div>
        </div>
        </br>
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
                                ?>" type="text" name="search_text" class="form-control" placeholder="@lang('pharmacy.search_for')"> 
                            </div>


                            <div class=" form-group">
                                <select class="form-control" name="status">
                                    <option value="">@lang('user.choose_option')</option>
                                    <option value="0" <?php
                                    if (isset($_GET['status']) && $_GET['status'] == '0') {
                                        echo'selected';
                                    }
                                    ?>>@lang('pharmacy.pending')</option>
                                    <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') {
                                                echo'selected';
                                            }
                                    ?>>@lang('pharmacy.Verified')</option>

                                    <option value="2" <?php if (isset($_GET['status']) && $_GET['status'] == '2') {
                                                echo'selected';
                                            }
                                    ?>>@lang('pharmacy.Rejected')</option>
                                </select> 
                            </div>
                            <div class=" form-group">
                                <button style=" margin-bottom: 0px;margin-right: 0px;" type="submit" class="btn btn-default">@lang('pharmacy.Go')</button>
                            </div>


                            <div class=" form-group">

                                <a href="list-pharmacy" style=" margin-bottom: 0px;margin-right: 0px;"  class="btn btn-default">@lang('pharmacy.Reset')</a>
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
                        <i class="fa fa-table"></i>@lang('sidebar.manage_pharmacy')
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th width="5%">
                                    Sr No.
                                </th>
                                <th>
                                    @lang('pharmacy.date')
                                </th>
                                <th>
                                    @lang('pharmacy.name')
                                </th>
                                <th>
                                    @lang('pharmacy.city')
                                </th>
                                <th class="numeric">
                                    @lang('pharmacy.email')
                                </th>
                                <th class="numeric">
                                    @lang('pharmacy.mobile_number')
                                </th>
                                <th class="numeric">
                                    @lang('pharmacy.verification_status')
                                </th>
                                <th class="numeric">
                                    @lang('pharmacy.action')
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(count($pharmacy_list)>0)
<?php $i =$pharmacy_list->perPage() * ($pharmacy_list->currentPage()-1)+1; ?>
                            @foreach($pharmacy_list as $key=>$value)
                            <tr>
                                <td>
                                    {{$i}}
                                </td>
                                <td>  
                                    {{date('d/m/Y', strtotime($value['created_at']))}}
                                </td>
                                <td>
                                    {{$value['name']}}
                                </td>
                                <td>
                                    {{ucfirst($value['city'])}}
                                </td>
                                <td class="numeric">
                                    {{$value['email']}}
                                </td>
                                <td class="numeric">
                                    {{$value['mobile']}}
                                </td>

                                <td class="numeric">
                                    @if($value['status']==0)
                                    @lang('pharmacy.pending')
                                    @endif
                                    @if($value['status']==1)
                                    @lang('pharmacy.Verified')
                                    @endif
                                    @if($value['status']==2)
                                    @lang('pharmacy.Rejected')
                                    @endif
                                </td>



                                <td class="numeric">
                                    <div class="actions">
                                        <a title="@lang('pharmacy.view')" href="{{URL::to('/admin/pharmacy-profile')}}?id={{$value['id']}}"  class="btn btn-circle">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a title="@lang('pharmacy.delete')" class="btn btn-icon-only" style="color:red;" onclick="return confirm(' @lang('pharmacy.pharmacy_delete_confirm')');" href="{{URL::to('/admin/delete-pharmacy')}}?id={{$value['id']}}">
                                            <i class="icon-trash"></i>
                                        </a>
                                        <?php if ($value['is_block'] == 0) { ?>
                                            <a title="@lang('pharmacy.block')" class="btn btn-icon-only" style="color:green;" onclick="return confirm(' @lang('pharmacy.pharmacy_block_confirm')');" href="{{URL::to('/admin/block-pharmacy')}}?id={{$value['id']}}">
                                                <i class="fa icon-ban"></i>
                                            </a>
                                        <?php } else { ?>
                                            <a title="@lang('pharmacy.unblock')" class="btn btn-icon-only" style="color:red;" onclick="return confirm('@lang('pharmacy.pharmacy_unblock_confirm')');" href="{{URL::to('/admin/unblock-pharmacy')}}?id={{$value['id']}}">
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
                                {{$pharmacy_list->links() }}
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