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

        <div class="page-title">
            <div class="title_left">
                <h3>@lang('order.orders')</h3>
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
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                       

                        <div class="pull-right">
                             <div class="form-group">              
                            <input value="<?php
                            if (isset($_GET['search_text'])) {
                                echo$_GET['search_text'];
                            }
                            ?>" type="text" name="search_text" class="form-control" placeholder="@lang('order.enter_order_id')"> 
                        </div>
                            
                            <div class=" form-group">
                                <select class="form-control" name="status">
                                    <option value="">@lang('user.choose_option')</option>
                                    <option value="1" <?php
                                    if (isset($_GET['status']) && $_GET['status'] == '1') {
                                        echo'selected';
                                    }
                                    ?>>@lang('order.Pending')</option>
                                    <option value="2" <?php if (isset($_GET['status']) && $_GET['status'] == '2') {
                                                echo'selected';
                                            }
                                    ?>> @lang('order.Accepted')</option>

                                    <option value="3" <?php if (isset($_GET['status']) && $_GET['status'] == '3') {
                                                echo'selected';
                                            }
                                    ?>>@lang('order.Rejected')</option>


                                    <option value="4" <?php if (isset($_GET['status']) && $_GET['status'] == '4') {
                                                echo'selected';
                                            }
                                    ?>>@lang('order.Dispatched')</option>

                                    <option value="5" <?php if (isset($_GET['status']) && $_GET['status'] == '5') {
                                                echo'selected';
                                            }
                                    ?>>@lang('order.Delivered')</option>



                                </select> 
                            </div>
                            <div class=" form-group">
                                <button style=" margin-bottom: 0px;margin-right: 0px;" type="submit" class="btn btn-default">@lang('user.Go')</button>
                            </div>


                            <div class=" form-group">

                                <a href="pharmacy-orders?id=<?php echo $_GET['id']; ?>" style=" margin-bottom: 0px;margin-right: 0px;"  class="btn btn-default">@lang('user.Reset')</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
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
                                    <a href="{{URL::to('/admin/pharmacy-profile')}}?id={{app('request')->input('id') }}" id="tab1" role="tab" aria-expanded="true">@lang('profile.profile')</a>
                                </li>
                                <li role="presentation" class="<?php echo $status2; ?>"><a href="{{URL::to('/admin/medicines')}}?id={{app('request')->input('id') }}" id="tab2" role="tab" aria-expanded="true">@lang('profile.medicines')</a>
                                </li>

                                <li role="presentation" class="<?php echo $status3; ?>"><a href="{{URL::to('/admin/pharmacy-orders')}}?id={{app('request')->input('id') }}orders" role="tab" id="tab3" aria-expanded="false">@lang('profile.orders')</a>
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
                                    @lang('order.status')
                                </th>
                                <th class="numeric">
                                    @lang('user.action')
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(count($order_list)>0)
                           <?php $i =$order_list->perPage() * ($order_list->currentPage()-1)+1; ?>
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
                                    @if($value['order_status']==1)
                                    @lang('order.Requested')
                                    @endif
                                    @if($value['order_status']==2)
                                    @lang('order.Accepted')
                                    @endif
                                    @if($value['order_status']==3)
                                    @lang('order.Rejected')
                                    @endif
                                    @if($value['order_status']==4)
                                    @lang('order.Dispatched')
                                    @endif
                                    @if($value['order_status']==5)
                                    @lang('order.Delivered')
                                    @endif
                                </td>

                                <td class="numeric">
                                    <div class="actions">
                                        <a title="@lang('pharmacy.view')" onClick="return orderDetails({{$value['id']}},{{$value['delivery_charges']}},{{$value['total_amount']}});" href="#" data-toggle="modal" data-target="#myModal-23"><i class="fa fa-eye"></i></a>
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
                                {{ $order_list->appends(request()->input())->links() }}
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