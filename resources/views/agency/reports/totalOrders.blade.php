@extends('merchant.mainLayout.template')
@section('title')
   @lang('sidebar.total_orders')
@endsection
@section('content')
<?php
use App\Helpers\CustomHelper; 
$order_status=CustomHelper::getOrderStatus();
?>
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
               <a href="javascript:void(0);">@lang('sidebar.total_orders')</a>
            </li>
         </ul>
      </div>
      <h3 class="page-title">
         @lang('sidebar.total_orders')
      </h3>
      <!-- END PAGE HEADER-->
      <div class="row">
         <div class="col-md-12 pull-right">
            <div class="booking-search">
               {!! Form::open(['role'=>'form','method'=>'get']) !!}
                  <div class="row form-group date-picker input-daterange">
                     <div class="col-md-3">
                        <label class="control-label">@lang('order.start_date'):</label>
                        <div class="input-icon">
                           <i class="fa fa-calendar"></i>
                           <input class="form-control date-picker" type="text"  value="{{app('request')->input('from')}}" name="from" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                        </div>
                     </div>
                     <div class="col-md-3">
                        <label class="control-label">@lang('order.end_date'):</label>
                        <div class="input-icon">
                           <i class="fa fa-calendar"></i>
                           <input class="form-control date-picker" type="text" name="to" value="{{app('request')->input('to')}}" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                        </div>
                     </div>
                     <div class="col-md-3">
                        <label class="control-label">@lang('order.order_status'):</label>
                        <div class="">
                           <select id="font" class="form-control" name="status">
                              <option value="">@lang('order.all')</option>
                              <option value="2" <?php if(!empty(app('request')->input('status')) && app('request')->input('status') == '1'){ echo "selected";}?> >@lang('order.requested')</option>
                              <option value="2" <?php if(!empty(app('request')->input('status')) && app('request')->input('status') == '2'){ echo "selected";}?> >@lang('order.accepted')</option>
                              <option value="3" <?php if(!empty(app('request')->input('status')) && app('request')->input('status') == '3'){ echo "selected";}?> >@lang('order.rejected')</option>
                              <option value="4" <?php if(!empty(app('request')->input('status')) && app('request')->input('status') == '4'){ echo "selected";}?> >@lang('order.dispatched')</option>
                              <option value="5" <?php if(!empty(app('request')->input('status')) && app('request')->input('status') == '5'){ echo "selected";}?> >@lang('order.delivered')</option>
                        </select>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <label class="control-label">&nbsp;</label>
                        <div class="input-icon">
                           <button type="submit" class="btn green-haze">
                              @lang('sidebar.search') &nbsp; <i class="m-icon-swapright m-icon-white"></i>
                           </button>
                        </div>
                     </div>
                  </div>
                  
               {!! Form::close() !!}
            </div>
         </div>
      </div>
      <div class="form-group">
      </div>
      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
         <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="fa fa-table"></i>@lang('sidebar.new_orders')
                  </div>
               </div>
               <div class="portlet-body flip-scroll">                  
                  <table class="table table-bordered table-striped table-condensed flip-content">
                     <thead class="flip-content">
                        <tr>
                           <th>
                              @lang('order.sr_no')
                           </th>
                           <th>
                              @lang('order.date')
                           </th>
                           <th class="numeric">
                              @lang('order.customer_name')
                           </th>
                           <th class="numeric">
                              @lang('order.order_id')
                           </th>
                           <th class="numeric">
                              @lang('order.order_status')
                           </th>                          
                           <th class="numeric">
                              @lang('order.action')
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        @if(count($order_list)>0)                          
                           @foreach($order_list as $key=>$value)
                              <tr>
                                 <td>{{++$i}}</td>
                                 <td> {{date('d/m/Y',strtotime($value['created_at']))}}</td>
                                  <td class="numeric">
                                    {{$value->userDetail->first_name.' '.$value->userDetail->last_name}}
                                 </td>
                                 <td class="numeric">{{$value['order_no']}}</td>
                                 <td class="numeric">
                                    <?php $ordrStatus=(int)$value['order_status'];
                                       if(array_key_exists($ordrStatus,$order_status))
                                       {
                                          echo $order_status[$ordrStatus];
                                       }                                       
                                    ?>
                                 </td>
                                 <td class="numeric" width="15%">
                                    <div class="actions">
                                       <a href="{{URL::route('report-order-detail',$value['id'])}}" title="@lang('order.view_detail')" class="btn btn-sm yellow filter-submit margin-bottom">
                                          <i class="fa fa-eye"></i> @lang('order.view_detail')
                                       </a>
                                    </div>
                                 </td>
                              </tr>
                              
                           @endforeach
                        @else
                           <tr>
                              <td colspan="6"><center>@lang('order.no_result_found')</center></td>
                           </tr>
                        @endif
                     </tbody>
                  </table>
                  <div class="row">
                     <div class="col-md-12 col-sm-12">
                        <div class="dataTables_paginate paging_bootstrap_full_number pull-right" id="sample_1_paginate">
                           {{ $order_list->links() }}
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