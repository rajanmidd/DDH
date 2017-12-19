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
                    <a href="javascript:void(0);">@lang('pharmacy.medicine_list')</a>
                </li>
            </ul>

        </div>

        <div class="page-title">
            <div class="title_left">
                <h3> @lang('pharmacy.medicine_list')</h3>
            </div>

        </div>

        <h3 class="page-title">

            <span class="pull-right">
                <a class="btn green" href="{{URL::to('/admin/add-medicine')}}?id={{app('request')->input('id') }}">@lang('pharmacy.add_new_medicine')</a> 
                &nbsp; 
                {!! Form::open(['route' => 'admin-add-excel-medicine','class'=>'inline','files'=>true]) !!}
                <input style="display:none;" type="file" id="excel_med_uplad" name="excel_med_uplad">
                <input style="display:none;" type="hidden" id="pharmacy_id" name="pharmacy_id" value="{{app('request')->input('id') }}">
                {!! Form::close() !!}
                <a class="btn green" href="javascript:void(0);" id="import_excel">@lang('inventory.import_excel')</a>
                &nbsp;

            </span>
        </h3>




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


            <!--        <div class="row">
                        <div class="col-xs-12 "> 
                            <form class="form-inline " id="search_frm" name="search_frm" method="get" action="">
                                <div class="form-group">              
                                    <input value="<?php
            if (isset($_GET['search_text'])) {
                echo$_GET['search_text'];
            }
            ?>" type="text" name="search_text" class="form-control" placeholder="@lang('pharmacy.search_for')"> 
                                </div>
                                
                                <div class="pull-right">
                                    <div class=" form-group">
                                        <select class="form-control" name="status">
                                            <option value="">@lang('user.choose_option')</option>
                                            <option value="0" <?php
            if (isset($_GET['status']) && $_GET['status'] == '0') {
                echo'selected';
            }
            ?>>@lang('pharmacy.pending')</option>
                                    <option value="1" <?php
            if (isset($_GET['status']) && $_GET['status'] == '1') {
                echo'selected';
            }
            ?>>@lang('pharmacy.Verified')</option>
                                   
                                   <option value="2" <?php
            if (isset($_GET['status']) && $_GET['status'] == '2') {
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
                        
                    </div>-->



            <br/>
            <div class="clearfix"></div>
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box">


                <!-- top tiles -->
                <div class="row">
                    <div class="col-xs-12 green"> 
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="<?php echo $status1; ?>">
                                    <a href="pharmacy-profile?id={{app('request')->input('id') }}" id="tab1" role="tab" aria-expanded="true">@lang('profile.profile')</a>
                                </li>
                                <li role="presentation" class="<?php echo $status2; ?>"><a href="medicines?id={{app('request')->input('id') }}" id="tab2" role="tab" aria-expanded="true">@lang('profile.medicines')</a>
                                </li>
                                <li role="presentation" class="<?php echo $status3; ?>"><a href="{{URL::to('/admin/pharmacy-orders')}}?id={{app('request')->input('id') }}" role="tab" id="tab3" aria-expanded="false">@lang('profile.orders')</a>
                                </li>
                                <li role="presentation" class="<?php echo $status4; ?>"><a href="{{URL::to('/admin/set-comission')}}?id={{app('request')->input('id')}}" id="tab4" role="tab" aria-expanded="true">@lang('profile.set_commission')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th width="10%">
                                    @lang('profile.sr_no')
                                </th>
                                <th>
                                    @lang('pharmacy.medicine_name')
                                </th>
                                <th class="numeric">
                                    @lang('pharmacy.description')
                                </th>
                                <th class="numeric">
                                    @lang('pharmacy.image')
                                </th>
                                <th class="numeric">
                                    @lang('pharmacy.total_qty')
                                </th>
                                <th class="numeric">
                                    @lang('pharmacy.price') ({{config('services.currency')}})
                                </th>

                                <th class="numeric">
                                    @lang('pharmacy.presctiption')
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
                                         {{$value['name']}}
                                     </td>
                                     <td class="numeric">
                                         {{ str_limit($value['description'],50) }}
                                     </td>
                                     <td class="numeric">
                                         @if($value['med_image'])
                                            <img src="{{str_replace('open','uc',$value['med_image'])}}" height="50" width="50" />
                                         @endif
                                     </td>

                                     <td class="numeric">
                                         {{$value['quantity']}}
                                     </td>
                                     <td class="numeric">
                                         {{$value['price']}}
                                     </td>
                                     <td class="numeric">
                                         {{$value['prescription']==1?'Mandetory':'Not Mandetory'}}    
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
                                {{ $pharmacy_list->appends(request()->input())->links() }}
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