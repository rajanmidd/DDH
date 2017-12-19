@extends('admin.mainLayout.template')
@section('title')
@lang('order.earned_revenue')
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
                    <a href="javascript:void(0);">@lang('order.earned_revenue')</a>
                </li>
            </ul>

        </div>

        <div class="page-title">
            <div class="title_left">
                <h3>@lang('order.earned_revenue')</h3>
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
         <div class="col-md-8">
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
            <br/>
            <div class="clearfix"></div>
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
                
            
           <div class="portlet-title">
                  <div class="caption">
                     <i class="fa fa-table"></i>@lang('order.earned_revenue')</div>
               </div>

            
                    
                <div class="portlet-body flip-scroll">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th width="10%">
                                    @lang('order.sr_no')
                                </th>
                                <th>
                                    @lang('order.pharmacy_name')
                                </th>
                              
                                <th class="numeric">
                                    @lang('order.total_earned_pharmacy') ({{config('services.currency')}})
                                </th>
                                 <th>
                                    @lang('order.total_earned_admin') ({{config('services.currency')}})
                                </th>
                               
                                <th class="numeric">
                                    @lang('user.action')
                                </th>

                            </tr>
                        </thead>
                      
                        <tbody>
                            @if(count($order_list)>0)
                             <?php $i = 1; ?>
                            @foreach($order_list as $key=>$value)
                           
                            <tr>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$value['name']}}
                                </td>
                               
                                <td class="numeric">
                                    {{$value->total_phar_order_amount}}
                                </td>
                                
                                 <td class="numeric">
                                 {{$value->total_admin_amount}}
                                </td>
                               
                                <td class="numeric">
                                    <div class="actions">
                                        <a title="@lang('pharmacy.view')" href="{{URL::to('/admin/view-order')}}?id={{$value['phar_id']}}"><i class="fa fa-eye"></i></a>
                                        </a>


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
                                    @lang('order.Price')
                                </th>

                            </tr>
                        </thead>
                        <tbody id="details">
   
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