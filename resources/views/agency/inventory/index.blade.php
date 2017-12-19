@extends('merchant.mainLayout.template')
@section('title')
   @lang('sidebar.inventory_list')
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
               <a href="javascript:void(0);">@lang('sidebar.inventory_list')</a>
            </li>
         </ul>
      </div>
      <h3 class="page-title">
         @lang('sidebar.inventory')
         <span class="pull-right">
            <a class="btn green" href="{{URL::to('merchant/add-inventory')}}">@lang('inventory.add_new_med')</a> 
            &nbsp; 
            {!! Form::open(['route' => 'merchant-add-excel-inventory','class'=>'inline','files'=>true]) !!}
               <input style="display:none;" type="file" id="excel_med_uplad" name="excel_med_uplad">
            {!! Form::close() !!}
            <a class="btn green" href="javascript:void(0);" id="import_excel">@lang('inventory.import_excel')</a>
            &nbsp;

         </span>
      </h3>
      <!-- END PAGE HEADER-->
      <!-- END PAGE HEADER-->
      <div class="row search-form-default">
         <div class="col-md-7 pull-right">
            {!! Form::open(['class'=>'form-horizontal','method'=>'get']) !!}
               <div class="input-group">
                  <div class="col-md-6">
                     <div class="input-cont">
                        <input type="text" name="name" autocomplete="off" value="{{app('request')->input('name')}}" placeholder="@lang('sidebar.search_by_medicine')" class="form-control">
                     </div>                  
                  </div>      
                  <div class="col-md-6">
                     <div class="input-cont">
                        <select id="font" class="form-control" name="prescription">
                           <option value="">@lang('inventory.all')</option>
                           <option value="1" <?php if(!empty(app('request')->input('prescription')) && app('request')->input('prescription') == '1'){ echo "selected";}?> >@lang('inventory.prescription_mandetory')</option>
                           <option value="2" <?php if(!empty(app('request')->input('prescription')) && app('request')->input('prescription') == '2'){ echo "selected";}?> >@lang('inventory.prescription_not_mandetory')</option>
                        </select>
                     </div>
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
                     <i class="fa fa-table"></i>@lang('sidebar.inventory_list')
                  </div>
               </div>
               <div class="portlet-body flip-scroll">
                  <table class="table table-bordered table-striped table-condensed flip-content">
                     <thead class="flip-content">
                        <tr>
                           <th width="6%">
                              @lang('inventory.sr_no')
                           </th>
                           <th width="10%">
                              @lang('inventory.name')
                           </th>
                           <th class="numeric" width="30%">
                              @lang('inventory.description')
                           </th>
                           <th class="numeric" width="7%">
                              @lang('inventory.quantity')
                           </th>
                           <th class="numeric" width="10%">
                              @lang('inventory.price') ({{config('services.currency')}})
                           </th>
                           <th class="numeric" width="10%">
                              @lang('inventory.prescription')
                           </th>
                           <th class="numeric" width="10%">
                              @lang('inventory.image')
                           </th>                           
                           <th class="numeric" width="10%">
                              @lang('inventory.action')
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        @if(count($inventory_list)>0)
                          
                           @foreach($inventory_list as $key=>$value)
                              <tr>
                                 <td>{{++$i}}</td>
                                 <td> {{$value['name']}}</td>
                                 <td class="numeric">{{$value['description']}}</td>
                                 <td class="numeric">{{$value['quantity']}}</td>
                                 <td class="numeric">
                                    {{$value['price']}}
                                 </td>
                                 <td class="numeric">
                                    @if($value['prescription'] =='1')
                                        {{"Mandetory"}}
                                     @else
                                        {{"Not Mandetory"}}
                                     @endif
                                 </td>
                                 <td class="numeric">
                                    @if($value['med_image'])
                                       <img src="{{str_replace('open','uc',$value['med_image'])}}" height="50" width="50" />
                                    @endif
                                 </td>
                                 <td class="numeric">
                                    <div class="actions">
                                       <a href="{{URL::route('edit-inventory',$value['id'])}}" title="@lang('inventory.edit')" class="btn btn-circle btn-icon-only green">
                                          <i class="icon-pencil"></i>
                                       </a>
                                       <a href="{{URL::route('delete-inventory',$value['id'])}}" title="@lang('inventory.delete')" class="btn btn-circle btn-icon-only red confirm_button"  />
                                          <i class="icon-trash"></i>
                                       </a>
                                    </div>
                                 </td>
                              </tr>
                              
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
                           {{ $inventory_list->appends(request()->input())->links() }}
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