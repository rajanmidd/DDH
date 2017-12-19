<?php 
use Carbon\Carbon;
use App\Helpers\CustomHelper;

$agency_id=auth()->guard('agency')->user()->id;
?>
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
   <!-- BEGIN HEADER INNER -->
   <div class="page-header-inner">
      <!-- BEGIN LOGO -->
      <div class="page-logo">
         <a href="{{URL::to('agency/agency-dashboard')}}">
            <!--<img src="{{asset('assets/admin/layout/img/logo.png')}}" alt="logo" class="logo-default"/>-->
            <h3>Agency Panel</h3>
         </a>
         <div class="menu-toggler sidebar-toggler hide">
         </div>
      </div>
      <!-- END LOGO -->
      <!-- BEGIN RESPONSIVE MENU TOGGLER -->
      <a href="javascript:void(0);" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
      </a>
      <!-- END RESPONSIVE MENU TOGGLER -->
      <!-- BEGIN TOP NAVIGATION MENU -->
      <div class="top-menu">
         <ul class="nav navbar-nav pull-right">            
            <!-- <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
               <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                  <i class="icon-bell"></i>
                  <span class="badge badge-default unread_badge">
                     0
                  </span>
               </a>
               <ul class="dropdown-menu">
                  <li class="external">
                     <h3><span class="bold"><span class="unread_badge">0</span> Pending</span> @lang('sidebar.notification')</h3>
                     <a href="{{URL::to('merchant/notifications')}}">View All</a>
                  </li>
                  <li>
                     <ul class="dropdown-menu-list scroller unread" style="height: 250px;" data-handle-color="#637283">
                        <li>
                              <a href="javascript:;">
                                    
                                    <span class="details">
                                    <span class="label label-sm label-icon label-warning">
                                    <i class="fa fa-bell-o"></i>
                                    </span>
                                    dfgdfgdfg
                                    </span>
                                    <span class="time">10:30</span>
                              </a>
                        </li>
                     </ul>
                  </li>
               </ul>
            </li> -->
            
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <li class="dropdown dropdown-user">
               <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                  <span class="username username-hide-on-mobile">
                     {{auth()->guard('agency')->user()->owner_name}}
                  </span>
                  <i class="fa fa-angle-down"></i>
               </a>
               <ul class="dropdown-menu dropdown-menu-default">
                  <li>
                     <a href="{{URL::to('agency/view-profile')}}">
                        <i class="icon-user"></i>My Profile</a>
                  </li>
                  <li>
                     <a href="{{URL::to('agency/password')}}">
                        <i class="fa fa-key"></i>Chnage Password</a>
                  </li>
                  <li>
                     <a href="{{ URL::route('agency.logout') }}">
                        <i class="icon-key"></i> Logout</a>
                  </li>
               </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
         </ul>
      </div>
      <!-- END TOP NAVIGATION MENU -->
   </div>
   <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
