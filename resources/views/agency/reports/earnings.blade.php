@extends('merchant.mainLayout.template')
@section('title')
   @lang('sidebar.earnings')
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
               <a href="javascript:void(0);">@lang('sidebar.earnings')</a>
            </li>
         </ul>
      </div>
      <h3 class="page-title">
         @lang('sidebar.earnings')
      </h3>
      <!-- END PAGE HEADER-->
      <!-- END PAGE HEADER-->
      <div class="row">
         <div class="col-md-8 pull-right">
            <div class="booking-search">
               {!! Form::open(['role'=>'form','method'=>'get']) !!}
                  <div class="row form-group date-picker input-daterange">
                     <div class="col-md-5">
                        <label class="control-label">@lang('order.start_date'):</label>
                        <div class="input-icon">
                           <i class="fa fa-calendar"></i>
                           <input class="form-control date-picker" type="text"  value="{{app('request')->input('from')}}" required name="from" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                        </div>
                     </div>
                     <div class="col-md-5">
                        <label class="control-label">@lang('order.end_date'):</label>
                        <div class="input-icon">
                           <i class="fa fa-calendar"></i>
                           <input class="form-control date-picker" type="text" required name="to" value="{{app('request')->input('to')}}" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                        </div>
                     </div>
                     <div class="col-md-2">
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
                              @lang('order.price')  ({{config('services.currency')}})
                           </th>                          
                           <th class="numeric">
                              @lang('order.admin_commision')
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        @if(count($order_list)>0)                          
                           @foreach($order_list as $key=>$value)
                              <tr>
                                 <td>{{++$i}}</td>
                                 <td> 
                                    {{date('d/m/Y',strtotime($value['created_at']))}}
                                 </td>
                                  <td class="numeric">
                                    {{$value->userDetail->first_name.' '.$value->userDetail->last_name}}
                                 </td>
                                 <td class="numeric">
                                    {{$value['order_no']}}
                                    <a class="danger get_order_info" data-toggle="modal" href="#" data-order-id="{{$value['id']}}">
                                       <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </a>

                                 </td>
                                 <td class="numeric">
                                    {{$value['total_amount']}}
                                 </td>
                                 <td class="numeric" width="15%">
                                    {{$value['admin_commision']}}
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

<div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Confirmation</h4>
         </div>
         <div class="modal-body">
            <div class="table-responsive">
               <table class="table" id="order_items">
                  <tr>
                     <th>Sr. No.</th>
                     <th>Medicine Name</th>
                     <th>Quantity</th>
                     <th>Price</th>
                  </tr>
               </table>
          </div>
         </div>
         <div class="modal-footer">
<!--            <button type="button" data-dismiss="modal" class="btn default">Cancel</button>-->
         </div>
      </div>
   </div>
</div>

@endsection