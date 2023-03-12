<?php
/**
  * Created by feyswal on 2/28/2023.
  * Time 2:44 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>



<div class="vertical-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">

    </div>
    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn"> <i class="fa fa-fw fa-bars"></i> </button>
    <div data-simplebar class="sidebar-menu-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                      <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ route('dashboard') }}"> <span>Nyumbani</span> </a>
                </li>
                <li>
                    <a href="{{ route('general.sials.orodha') }}"><span>Barua</span> </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
