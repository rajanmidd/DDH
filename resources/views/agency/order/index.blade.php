@extends('merchant.mainLayout.template')
@section('title')
   @lang('sidebar.new_orders')
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
               <a href="javascript:void(0);">@lang('sidebar.new_orders')</a>
            </li>
         </ul>
      </div>
      <h3 class="page-title">
         @lang('sidebar.new_orders')
      </h3>
      <!-- END PAGE HEADER-->
      <div class="row search-form-default">
         <div class="col-md-6 pull-right">
            {!! Form::open(['class'=>'form-horizontal','method'=>'get']) !!}
               <div class="input-group">
                  <div class="input-cont">
                     <input type="text" name="id" autocomplete="off" required value="{{app('request')->input('id')}}" placeholder="@lang('sidebar.search_by_orderId')" class="form-control">
                  </div>
                  <span class="input-group-btn">
                     <button type="submit" class="btn green-haze">
                        @lang('sidebar.search') &nbsp; <i class="m-icon-swapright m-icon-white"></i>
                     </button>
                  </span>
               </div>
            {!! Form::close() !!}
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
                              @lang('order.order_id')
                           </th>
                           <th class="numeric">
                              @lang('order.customer_name')
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
                                 <td class="numeric">{{$value['order_no']}}</td>
                                 <td class="numeric">
                                    {{$value->userDetail->first_name.' '.$value->userDetail->last_name}}
                                 </td>
                                 <td class="numeric" width="15%">
                                    <div class="actions">
                                       <a href="{{URL::route('order-detail',$value['id'])}}" title="@lang('order.view_detail')" class="btn btn-sm yellow filter-submit margin-bottom">
                                          <i class="fa fa-eye"></i> @lang('order.view_detail')
                                       </a>
                                    </div>
                                 </td>
                              </tr>
                              
                           @endforeach
                        @else
                           <tr>
                              <td colspan="5"><center>@lang('order.no_result_found')</center></td>
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