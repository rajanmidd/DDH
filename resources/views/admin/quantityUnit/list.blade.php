@extends('admin.mainLayout.template')
@section('title')
   @lang('quantityUnit.manage_quantity_unit')
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
               <a href="javascript:void(0);">@lang('quantityUnit.manage_quantity_unit')</a>
            </li>
         </ul>
          
      </div>
      
       <div class="page-title">
            <div class="title_left">
                <h3> @lang('quantityUnit.manage_quantity_unit')</h3>
            </div>

        </div>
    <div class="row">
     <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
      <a href="{{URL::to('/admin/add-quantity-unit')}}"> <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus-square" aria-hidden="true"></i> @lang('quantityUnit.add_quantity_unit')</button></a>
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
         
             
      
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="fa fa-table"></i>@lang('quantityUnit.manage_quantity_unit')
                  </div>
               </div>
               <div class="portlet-body flip-scroll">
                  <table class="table table-bordered table-striped table-condensed flip-content">
                     <thead class="flip-content">
                        <tr>
                           <th width="10%">
                              Sr No.
                           </th>
                          <th width="45%">
                             @lang('pharmacy.name')
                           </th>
                           
                            <th width="10%">
                             @lang('pharmacy.status')
                           </th>
                           
                          <th width="35%">
                              @lang('pharmacy.action')
                           </th>
                           
                        </tr>
                     </thead>
                    <tbody>
                        @if(count($quanty_unit_list)>0)
                        <?php $i = 1;?>
                        @foreach($quanty_unit_list as $key=>$value)
                           <tr>
                              <td>
                                 {{$i}}
                              </td>
                              <td>
                                 {{$value['name']}}
                              </td>
                             
                              <td>
                                <?php if($value['status']==1){ ?>
                                    
                                       Active
                                    
                                     <?php } else{  ?>
                                     
                                       In Active
                                   
                                     <?php } ?>
                                     
                              </td>
                              
                              
                              <td class="numeric">
                                 <div class="actions">
                                     <a class="btn btn-icon-only" title="@lang('pharmacy.edit')" style="color:green;"  href="{{URL::to('/admin/add-quantity-unit')}}?id={{$value['id']}}">
                                     <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-icon-only" title="@lang('pharmacy.delete')" style="color:red;" onclick="return confirm(' @lang('quantityUnit.delete_confirm')');" href="{{URL::to('/admin/delete-quantity-unit')}}?id={{$value['id']}}">
                                       <i class="icon-trash"></i>
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
                           {{$quanty_unit_list->links() }}
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