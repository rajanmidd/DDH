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
      <li class="start @if($controller == 'DashboardController') active open @endif">
        <a href="{{URL::to('/admin/admin-dashboard')}}">
          <i class="icon-home"></i>
          <span class="title">Dashboard</span>
        </a>           
      </li>

<!--      <li class="start @if($controller == 'UserController') active open @endif">
        <a href="{{URL::to('/admin/list-user')}}">
          <i class="icon-user"></i>
          <span class="title">Manage Users</span>
        </a>
      </li>-->
      
      <li class="start @if($controller == 'AgencyController') active open @endif">
        <a href="{{URL::to('/admin/list-agency')}}">
          <i class="icon-rocket"></i>
          <span class="title">Manage Agency</span>
        </a>
      </li>
      
      <li class="start @if($controller == 'ActivityController') active open @endif">
        <a href="{{URL::to('/admin/list-activity')}}">
          <i class="icon-rocket"></i>
          <span class="title">Manage Activity</span>
        </a>
      </li>
<!--      
      <li class="start @if(Route::currentRouteName()== 'admin.pharmacy.orders') active open @endif">
        <a href="{{URL::to('/admin/orders')}}">
          <i class="icon-diamond"></i>
          <span class="title">@lang('sidebar.manage_orders')</span>
        </a>

      </li>

      <li class="start @if(Route::currentRouteName()== 'admin.revenue.revenue') active open @endif @if(Route::currentRouteName()== 'admin.revenue.order') active open @endif">
        <a href="{{URL::to('/admin/earned-revenue')}}">
          <i class="icon-puzzle"></i>
          <span class="title">@lang('sidebar.earned_revenue')</span>
        </a>

      </li>

      <li class="start @if($controller == 'CmsController' && Request::segment(2) =='cms-pharmacy') active open @endif @if(Request::segment(2) =='pharmacy-feedback') active open @endif">
        <a href="{{URL::to('/admin/cms-pharmacy/about-us')}}">
          <i class="icon-paper-plane"></i>
          <span class="title">
            @lang('sidebar.manage_cms_for_pharmacy')
          </span>
        </a>
      </li>

      <li class="start @if($controller == 'CmsController' && Request::segment(2) =='cms-app') active open @endif @if(Request::segment(2) =='cms-contact-support') active open @endif">
        <a href="{{URL::to('/admin/cms-app/about-us')}}">
          <i class="icon-paper-plane"></i>
          <span class="title">
            @lang('sidebar.manage_cms_for_app')
          </span>
        </a>
      </li>
      <li class="start @if($controller == 'QuantityUnitController') active open @endif">
        <a href="{{URL::to('/admin/quantiy-unit-list')}}">
          <i class="icon-paper-plane"></i>
          <span class="title">
            @lang('sidebar.manage_quantity_unit')
          </span>
        </a>
      </li> -->
    </ul>
    <!-- END SIDEBAR MENU -->
  </div>
</div>
<!-- END SIDEBAR -->