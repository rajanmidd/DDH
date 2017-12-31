<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
   <div class="page-sidebar navbar-collapse collapse">
      <!-- BEGIN SIDEBAR MENU -->
      <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
         <li class="sidebar-toggler-wrapper">
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <div class="sidebar-toggler">
            </div>
            <!-- END SIDEBAR TOGGLER BUTTON -->
         </li>
         <li class="sidebar-search-wrapper">
            <form class="sidebar-search " action="extra_search.html" method="POST">
            </form>
            <!-- END RESPONSIVE QUICK SEARCH FORM -->
         </li>
         <li class="@if($controller == 'DashboardController') active open @endif">
            <a href="javascript:;">
               <i class="icon-home"></i>
               <span class="title">Dashboard</span>
               <span class="selected"></span>
               <span class="arrow open"></span>
            </a>
            <ul class="sub-menu">
               <li class="active">
                  <a href="{{URL::to('/agency/agency-dashboard')}}">
                     <i class="icon-bar-chart"></i>
                     Dashboard
                  </a>
               </li>
            </ul>
         </li>

         <li class="@if($controller == 'ActivityController') active open @endif">
            <a href="javascript:;">
               <i class="icon-diamond"></i>
               <span class="title">Activity</span>
               <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
               <li class="@if($action == 'index') active @endif">
                  <a href="{{URL::to('agency/list-activity')}}">
                     All Activities
                  </a>
               </li>
               <li class="@if($action == 'addActivity') active @endif">
                  <a href="{{URL::to('agency/add-activity')}}">
                     Add New Activity
                  </a>
               </li>
            </ul>
         </li>


         <li class="@if($controller == 'ComboPackagesController') active open @endif">
            <a href="javascript:;">
               <i class="icon-diamond"></i>
               <span class="title">Combo Packages</span>
               <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
               <li class="@if($action == 'index') active @endif">
                  <a href="{{URL::to('agency/list-combo-packages')}}">
                    All Combo Packages
                  </a>
               </li>
               <li class="@if($action == 'addMedicine') active @endif">
                  <a href="{{URL::to('agency/add-combo-packages')}}">
                    Add New Combo Packages
                  </a>
               </li>
            </ul>
         </li>

         <!-- <li class="tooltips @if($controller == 'OrderController' && ($action=='index' || $action=='orderDetail')) active open @endif" data-container="body" data-placement="right" data-html="true" data-original-title="@lang('sidebar.new_orders')">
            <a href="{{URL::to('merchant/new-order')}}">
               <i class="fa fa-money"></i>
               <span class="title">
                  @lang('sidebar.new_orders')
               </span>
            </a>
         </li>
         <li class="tooltips @if($controller == 'OrderController' && ($action=='orderHistory' || $action=='orderHistoryDetail')) active open @endif" data-container="body" data-placement="right" data-html="true" data-original-title="@lang('sidebar.order_history')">
            <a href="{{URL::to('merchant/order-history')}}">
               <i class="fa fa-money"></i>
               <span class="title">
                  @lang('sidebar.order_history')
               </span>
            </a>
         </li>
         <li class="@if($controller == 'InventoryController') active open @endif">
            <a href="javascript:;">
               <i class="icon-diamond"></i>
               <span class="title">@lang('sidebar.inventory')</span>
               <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
               <li class="@if($action == 'index') active @endif">
                  <a href="{{URL::to('merchant/list-inventory')}}">
                     @lang('sidebar.all_medicine')
                  </a>
               </li>
               <li class="@if($action == 'addMedicine') active @endif">
                  <a href="{{URL::to('merchant/add-inventory')}}">
                     @lang('sidebar.add_new_medicine')
                  </a>
               </li>
            </ul>
         </li>
         <li class="@if($controller == 'ReportController') active open @endif">
            <a href="javascript:;">
               <i class="icon-puzzle"></i>
               <span class="title">@lang('sidebar.reports')</span>
               <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
               <li class="@if($action == 'earnings') active @endif">
                  <a href="{{URL::to('merchant/earnings')}}">
                     @lang('sidebar.earnings')
                  </a>
               </li>
               <li class="@if($action == 'totalOrders') active @endif">
                  <a href="{{URL::to('merchant/total-orders')}}">
                     @lang('sidebar.total_orders')
                  </a>
               </li>
            </ul>
         </li> -->
         <!-- BEGIN ANGULARJS LINK -->
         <!-- <li class="tooltips @if($controller == 'AccountController') active open @endif" data-container="body" data-placement="right" data-html="true" data-original-title="@lang('sidebar.manage_accounts')">
            <a href="{{URL::to('merchant/manage-account')}}">
               <i class="fa fa-money"></i>
               <span class="title">
                  @lang('sidebar.manage_accounts')
               </span>
            </a>
         </li>

         <li class="tooltips @if($controller == 'CmsController' && Request::segment(3) =='faq') active open @endif" data-container="body" data-placement="right" data-html="true" data-original-title="@lang('sidebar.faq')">
            <a href="{{URL::to('/merchant/page/faq')}}" >
               <i class="icon-paper-plane"></i>
               <span class="title">
                 @lang('sidebar.faq')</span>
            </a>
         </li>

         <li class="tooltips @if($controller == 'FeedbackController') active open @endif" data-container="body" data-placement="right" data-html="true" data-original-title="@lang('sidebar.feedback')">
            <a href="{{URL::to('merchant/feedback')}}" >
               <i class="fa fa-comments-o"></i>
               <span class="title">
                 @lang('sidebar.feedback') </span>
            </a>
         </li>

         <li class="tooltips @if($controller == 'CmsController' && Request::segment(3) =='about-us') active open @endif" data-container="body" data-placement="right" data-html="true" data-original-title="@lang('sidebar.about_us')">
            <a href="{{URL::to('/merchant/page/about-us')}}" >
               <i class="icon-paper-plane"></i>
               <span class="title">
                 @lang('sidebar.about_us')</span>
            </a>
         </li>

         <li class="tooltips @if($controller == 'CmsController' && Request::segment(3) =='terms-condition') active open @endif" data-container="body" data-placement="right" data-html="true" data-original-title="@lang('sidebar.terms_condition')">
            <a href="{{URL::to('/merchant/page/terms-condition')}}" >
               <i class="icon-paper-plane"></i>
               <span class="title">
                 @lang('sidebar.terms_condition')</span>
            </a>
         </li> -->
      </ul>
      <!-- END SIDEBAR MENU -->
   </div>
</div>
<!-- END SIDEBAR -->