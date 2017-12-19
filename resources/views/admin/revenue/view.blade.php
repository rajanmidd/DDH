@extends('admin.mainLayout.template')
@section('title')
@lang('order.order_list')
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
               <a href="javascript:void(0);">@lang('order.orders')</a>
            </li>
         </ul>
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
         <div class="col-md-12"></div>
         <div class="clearfix"></div>
         <div class="row"> 
            <div class="col-md-12">
               <div class="booking-search">
                  {!! Form::open(['role'=>'form','method'=>'get']) !!}
                     {!! Form::hidden('id',request()->input('id')) !!}
                     <div class="col-md-3">
                        <label class="control-label">&nbsp</label>
                        <div class="input-icon">
                           <input value="<?php if (isset($_GET['search_text'])){ echo$_GET['search_text'];} ?>" type="text" name="search_text" class="form-control" placeholder="Enter order id">                     </div>
                     </div>
                     <div class="row form-group date-picker input-daterange">
                        <div class="col-md-3">
                           <label class="control-label">@lang('order.start_date'):</label>
                           <div class="input-icon">
                              <i class="fa fa-calendar"></i>
                              <input class="form-control date-picker" type="text"  value="{{app('request')->input('from')}}"  name="from" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                           </div>
                        </div>
                        <div class="col-md-3">
                           <label class="control-label">@lang('order.end_date'):</label>
                           <div class="input-icon">
                              <i class="fa fa-calendar"></i>
                              <input class="form-control date-picker" type="text"  name="to" value="{{app('request')->input('to')}}" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
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
         <br/>
         <div class="row">
            <div class="col-md-12 col-sm-12">
               <div class="portlet blue-hoki box">
                  <div class="portlet-title">
                     <div class="caption">
                        <i class="fa fa-cogs"></i>
                        @lang('order.customer_information')
                     </div>
                  </div>
                  <div class="portlet-body">
                     <div class="row static-info">
                        <div class="col-md-5 name">
                           @lang('order.pharmacy_name'):
                        </div>
                        <div class="col-md-7 value">
                           {{$pharmacy_details['name']}}
                        </div>
                     </div>
                     <div class="row static-info">
                        <div class="col-md-5 name">
                           @lang('order.email'):
                        </div>
                        <div class="col-md-7 value">
                           {{$pharmacy_details['email']}}
                        </div>
                     </div>
                     <div class="row static-info">
                        <div class="col-md-5 name">
                           @lang('order.mobile_number'):
                        </div>
                        <div class="col-md-7 value">
                           {{$pharmacy_details['mobile']}}
                        </div>
                     </div>
                     <div class="row static-info">
                        <div class="col-md-5 name">
                           @lang('order.city'):
                        </div>
                        <div class="col-md-7 value">
                           {{$pharmacy_details['city']}}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
         <!-- BEGIN SAMPLE TABLE PORTLET-->
         <div class="portlet box green">


            <div class="portlet-title">
               <div class="caption">
                  <i class="fa fa-table"></i>@lang('order.manage_order')</div>
            </div>



            <div class="portlet-body flip-scroll">
               <table class="table table-bordered table-striped table-condensed flip-content">
                  <thead class="flip-content">
                     <tr>
                        <th width="10%">
                           @lang('order.sr_no')
                        </th>
                        <th>
                           @lang('order.date')
                        </th>

                        <th class="numeric">
                           @lang('order.order_id')
                        </th>



                        <th class="numeric">
                           @lang('order.total_amount') ({{config('services.currency')}})
                        </th>
                        <th class="numeric">
                           @lang('order.admin_commision') ({{config('services.currency')}})
                        </th>
                        <th class="numeric">
                           @lang('user.action')
                        </th>

                     </tr>
                  </thead>

                  <tbody>
                     @if(count($order_list)>0)
<?php $i
        = 1; ?>
                     @foreach($order_list as $key=>$value)

                     <tr>
                        <td>
                           {{$i}}
                        </td>
                        <td>
                           {{$value['created_at']}}
                        </td>

                        <td class="numeric">
                           {{$value['order_no']}}
                        </td>


                        <td class="numeric">
                           {{$value['total_amount']}}
                        </td>

                        <td class="numeric">
                           {{$value['admin_commision']}}
                        </td>



                        <td class="numeric">
                           <div class="actions">
                              <a onClick="return orderDetails({{$value['id']}},{{$value['delivery_charges']}},{{$value['total_amount']}});" href="#" data-toggle="modal" data-target="#myModal-23"><i class="fa fa-eye"></i></a>
                              </a>


                           </div>
                        </td>
                     </tr>
<?php $i++; ?>
                     @endforeach
                     @else
                     <tr>
                        <td colspan="8"><center>Sorry, no result found.</center></td>
                  </tr>
                  @endif
                  </tbody>
               </table>
               <div class="row">
                  <div class="col-md-12 col-sm-12">
                     <div class="dataTables_paginate paging_bootstrap_full_number pull-right" id="sample_1_paginate">
                        <!--                                {{$order_list->links() }}-->
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

<!--------- data model-------------------------------------->
<div id="myModal-23" class="modal fade in" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">@lang('order.order_details')</h4>
         </div>
         <div class="modal-body">

            <div class="portlet-body flip-scroll">
               <table class="table table-bordered table-striped table-condensed flip-content">
                  <thead class="flip-content">
                     <tr>
                        <th width="10%">
                           @lang('order.sr_no')
                        </th>
                        <th>
                           @lang('order.Medicine_Name')
                        </th>
                        <th class="numeric">
                           @lang('order.Quantity')
                        </th>
                        <th class="numeric">
                           @lang('order.Price') ({{config('services.currency')}})
                        </th>

                     </tr>
                  </thead>
                  <tbody id="details">
<!--                        <tr>                        
                            <td>
                               1
                            </td>
                            <td>
                               Paracetamol
                            </td>
                            <td class="numeric">
                               10
                            </td>
                            <td class="numeric">
                               2000.00
                            </td>
                          
                     </tr>-->
                  </tbody>

                  </tbody>
               </table>

               <table id="charges">


               </table>

               <div class="row">
                  <div class="col-md-12 col-sm-12">
                     <div class="dataTables_paginate paging_bootstrap_full_number pull-right" id="sample_1_paginate">

                     </div>
                  </div>
               </div>
            </div>

            <p></p>

         </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>

      </div>

   </div>
</div>
<script>
   function orderDetails(id, delivery_charge, total_amount) {
   var charge = "<thead class='flip-content'><tr><th>@lang('order.Delivery_Charge') : " + delivery_charge + "</th><th>@lang('order.total_amount') : " + total_amount + "</th></tr></thead>";
   var html = "";
   $.ajax({
   type: "GET",
           url: 'user-orders-details?orderid=' + id,
           data: "",
           success: function(data) {
//            alert(data);
           var res = JSON.parse(data);
           for (i in res){
           html += "<tr><td>" + i + "</td><td>" + res[i].name + "</td><td>" + res[i].quantity + "</td><td>" + res[i].price + "</td><tr/>";
           }
           $('#details').html(html);
           $('#charges').html(charge);
           }
   })
   };
</script>
@endsection