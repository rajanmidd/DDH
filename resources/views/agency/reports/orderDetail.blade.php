@extends('merchant.mainLayout.template')
@section('title')
   @lang('order.order_detail')
@endsection
@section('content')
<div class="page-content-wrapper">
   <div class="page-content">
      <!-- BEGIN PAGE HEADER-->
      <h3 class="page-title">
         @lang('order.order_view') <small>@lang('order.order_detail')</small>
      </h3>
      <div class="page-bar">
         <ul class="page-breadcrumb">
            <li>
               <i class="fa fa-home"></i>
               <a href="{{URL::to('/merchant/merchant-dashboard')}}">@lang('sidebar.home')</a>
               <i class="fa fa-angle-right"></i>
            </li>
            <li>
               <a href="javascript::void(0)">@lang('order.order_view')</a>
            </li>
         </ul>
      </div>
      <!-- END PAGE HEADER-->
      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
         <div class="col-md-12">
            <!-- Begin: life time stats -->
            <div class="portlet">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="fa fa-shopping-cart"></i>@lang('order.order') #{{$order_detail->order_no}} 
                     <span class="hidden-480">
                        | {{date('M d, Y h:i A',strtotime($order_detail->created_at))}}
                     </span>
                  </div>
               </div>
               <div class="portlet-body">
                  <div class="tabbable">
                     <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                           <div class="row">
                              <div class="col-md-4 col-sm-12">
                                 <div class="portlet blue-hoki box">
                                    <div class="portlet-title">
                                       <div class="caption">
                                          <i class="fa fa-cogs"></i>@lang('order.order_details')
                                       </div>
                                    </div>
                                    <div class="portlet-body">
                                       <div class="row static-info">
                                          <div class="col-md-5 name">
                                             @lang('order.order') #:
                                          </div>
                                          <div class="col-md-7 value">
                                             {{$order_detail->order_no}} 
                                          </div>
                                       </div>
                                       <div class="row static-info">
                                          <div class="col-md-5 name">
                                             @lang('order.order_date_time'):
                                          </div>
                                          <div class="col-md-7 value">
                                             {{date('M d,Y h:i A',strtotime($order_detail->created_at))}}
                                          </div>
                                       </div>
                                       <div class="row static-info">
                                          <div class="col-md-5 name">
                                             @lang('order.grand_total'):
                                          </div>
                                          <div class="col-md-7 value">
                                             {{$order_detail->total_amount}} 
                                          </div>
                                       </div>
                                       <div class="row static-info">
                                          <div class="col-md-5 name">
                                             @lang('order.payment_type'):
                                          </div>
                                          <div class="col-md-7 value">
                                             @if($order_detail->payment_type == '1')
                                                @lang('order.credit_card')
                                             @elseif($order_detail->payment_type == '2')
                                                @lang('order.cod')
                                             @endif
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-12">
                                 <div class="portlet blue-hoki box">
                                    <div class="portlet-title">
                                       <div class="caption">
                                          <i class="fa fa-cogs"></i>@lang('order.customer_information')
                                       </div>
                                    </div>
                                    <div class="portlet-body">
                                       <div class="row static-info">
                                          <div class="col-md-6 name">
                                             @lang('order.customer_name'):
                                          </div>
                                          <div class="col-md-6 value">
                                             {{$order_detail->userDetail->first_name.' '.$order_detail->userDetail->last_name}}
                                          </div>
                                       </div>
                                       <div class="row static-info">
                                          <div class="col-md-6 name">
                                             @lang('order.email')
                                          </div>
                                          <div class="col-md-6 value" data-toggle="tooltip" title="{{$order_detail->userDetail->email}}" style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">
                                             {{$order_detail->userDetail->email}}
                                          </div>
                                       </div>
                                       <div class="row static-info">
                                          <div class="col-md-6 name">
                                             @lang('order.city'):
                                          </div>
                                          <div class="col-md-6 value">
                                            {{$order_detail->userDetail->city}}
                                          </div>
                                       </div>
                                       <div class="row static-info">
                                          <div class="col-md-6 name">
                                             @lang('order.phone_no'):
                                          </div>
                                          <div class="col-md-6 value">
                                             {{$order_detail->userDetail->mobile}}
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-12">
                                 <div class="portlet blue-hoki box">
                                    <div class="portlet-title">
                                       <div class="caption">
                                          <i class="fa fa-cogs"></i>@lang('order.delivery_address')
                                       </div>
                                    </div>
                                    <div class="portlet-body">
                                       <div class="row static-info">
                                          <div class="col-md-12 value">
                                             {{$order_detail->orderDeliveryAddress->full_name}}<br>
                                             {{$order_detail->orderDeliveryAddress->address}}<br>
                                             {{$order_detail->orderDeliveryAddress->landmark}}<br>
                                             {{$order_detail->orderDeliveryAddress->city}}, {{$order_detail->orderDeliveryAddress->zip_code}} {{$order_detail->orderDeliveryAddress->state}}<br>
                                             M: {{$order_detail->orderDeliveryAddress->mobile}}<br>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12 col-sm-12">
                                 <div class="portlet grey-cascade box">
                                    <div class="portlet-title">
                                       <div class="caption">
                                          <i class="fa fa-cogs"></i>@lang('order.shopping_cart')
                                       </div>
                                    </div>
                                    <div class="portlet-body">
                                       <div class="table-responsive">
                                          <table class="table table-hover table-bordered table-striped">
                                             <thead>
                                                <tr>
                                                   <th>
                                                      @lang('order.sr_no')
                                                   </th>
                                                   <th>
                                                      @lang('order.medicine_name')
                                                   </th>
                                                   <th>
                                                      @lang('order.quantity')
                                                   </th>
                                                   <th>
                                                      @lang('order.price') ({{config('services.currency')}})
                                                   </th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <?php $sub_total=0;?>
                                                @if(count($order_detail->orderItems)>0)
                                                   <?php $i=1;?>
                                                   @foreach($order_detail->orderItems as $key=>$value)
                                                      <tr>
                                                         <td>
                                                            {{$i}}
                                                         </td>
                                                         <td>
                                                            {{$value->getMedicineName->name}}
                                                         </td>
                                                         <td>
                                                            {{$value->quantity}}
                                                         </td>
                                                         <td>
                                                            {{$value->price}}
                                                         </td>
                                                      </tr>
                                                      <?php $sub_total=$sub_total+($value->quantity*$value->price);?>
                                                      <?php $i++;?>
                                                   @endforeach
                                                   <tr>
                                                      <td colspan="2">
                                                      </td>
                                                      <td>
                                                         @lang('order.sub_total'):
                                                      </td>
                                                      <td>
                                                         {{number_format($sub_total,2)}}
                                                      </td>
                                                   </tr>
                                                   <tr>
                                                      <td colspan="2">
                                                      </td>
                                                      <td>
                                                         @lang('order.delivery_charges'):
                                                      </td>
                                                      <td>
                                                         {{number_format($order_detail->delivery_charges,2)}}
                                                      </td>
                                                   </tr>
                                                   @if(count($order_detail->orderTaxes) >0)
                                                      @foreach($order_detail->orderTaxes as $key=>$order_taxes)
                                                         <?php $sub_total=$sub_total+$order_taxes->calculated_amount;?>
                                                         <td colspan="2">
                                                         </td>
                                                         <td>
                                                            {{$order_taxes->label}}:
                                                         </td>
                                                         <td>
                                                            {{number_format($order_taxes->calculated_amount,2)}}
                                                         </td>
                                                      @endforeach
                                                   @endif
                                                   <tr>
                                                      <td colspan="2">
                                                      </td>
                                                      <td>
                                                         @lang('order.grand_total'):
                                                      </td>
                                                      <td>
                                                         {{number_format(($sub_total+$order_detail->delivery_charges),2)}}
                                                      </td>
                                                   </tr>
                                                @else
                                                   <tr>
                                                      <td colspan="4">
                                                         <center>@lang('order.no_result_found')</center>
                                                      </td>
                                                   </tr>
                                                @endif
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12 col-sm-12">
                                 <div class="portlet blue box">
                                    <div class="portlet-title">
                                       <div class="caption">
                                          <i class="fa fa-cogs"></i>@lang('order.prescription')
                                       </div>
                                    </div>
                                    <div class="portlet-body">
                                       <div class="row">
                                          @if(count($order_detail->orderPrescriptions)>0)
                                             @foreach($order_detail->orderPrescriptions as $key=>$value)
                                                <div class="col-md-2">
                                                   <a href="{{$value->pres_img}}" class="mix-preview fancybox-button view_img">
                                                      <img class="img-responsive" src="{{$value->pres_img}}" />
                                                      <center>View</center>
                                                   </a>
                                                </div>
                                             @endforeach
                                          @else
                                             <center>@lang('order.no_result_found')</center>
                                          @endif
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12 col-sm-12">
                                 <div class="portlet purple box">
                                    <div class="portlet-title">
                                       <div class="caption">
                                          <i class="fa fa-cogs"></i>@lang('order.comment')
                                       </div>
                                    </div>
                                    <div class="portlet-body">
                                          {{$order_detail->comment}}
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- End: life time stats -->
         </div>
      </div>
      <!-- END PAGE CONTENT-->
   </div></div>
@endsection