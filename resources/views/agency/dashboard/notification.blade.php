@extends('merchant.mainLayout.template')
@section('title')
   @lang('sidebar.notification')
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
               <a href="javascript:void(0);">@lang('sidebar.notification')</a>
            </li>
         </ul>
      </div>
      <h3 class="page-title">
         @lang('sidebar.notification')
      </h3>
      <!-- END PAGE HEADER-->
      <div class="row">
         <div class="col-md-12">
            <!-- BEGIN TODO SIDEBAR -->
            <div class="todo-ui">
               <!-- BEGIN TODO CONTENT -->
               <div class="todo-content">
                  <div class="portlet light">
                     <!-- end PROJECT HEAD -->
                     <div class="portlet-body">
                        <div class="row">
                           <div class="col-md-12 col-sm-12">
                              <div class="scroller" style="max-height: 600px;" data-always-visible="0" data-rail-visible="0" data-handle-color="#dae3e7">
                                 <div class="todo-tasklist">
                                    @if(count($notification) >0)
                                       @foreach($notification as $key=>$value)
                                          <div class="todo-tasklist-item todo-tasklist-item-border-green">
                                             @if($value->pharmacyDetails->pharDocuments->phar_image)
                                                   <img class="todo-userpic pull-left" src="{{$value->pharmacyDetails->pharDocuments->phar_image}}" width="27px" height="27px">
                                             @else
                                                <img class="todo-userpic pull-left" src="{{asset('assets/admin/layout/img/avatar4.jpg')}}" width="27px" height="27px">
                                             @endif
                                             <div class="todo-tasklist-item-title">
                                                {{$value->pharmacyDetails->name}}
                                             </div>
                                             <div class="todo-tasklist-item-text">
                                                {{$value->desciption}}
                                             </div>
                                             <div class="todo-tasklist-controls pull-left">
                                                <span class="todo-tasklist-date"><i class="fa fa-calendar"></i> {{$value->created_at->format('d M Y H:i A')}}</span>
                                             </div>
                                          </div> 
                                       @endforeach
                                    @endif                                                                       
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- END TODO CONTENT -->
            </div>
         </div>
         <!-- END PAGE CONTENT-->
      </div>
   </div>
</div>
<!-- END CONTENT -->
@endsection