<?php
/**
  * Created by feyswal on 1/8/2023.
  * Time 5:02 PM.
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
                <li>
                    <a href="{{ route('dashboard') }}"><span>Dashboard</span> </a>
                </li>
                <li class="mm-active">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify" data-icon="uil-window-section" data-inline="false" style="transform: rotate(360deg);">
                            <path fill="currentColor" d="M21 2H3a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1ZM8 20H4V10h4Zm6 0h-4V10h4Zm6 0h-4V10h4Zm0-12H4V4h16Z"></path>
                        </svg>
                        <span>Changamoto</span>
                    </a>
                    <ul class="sub-menu mm-collapse mm-show" aria-expanded="true" style="">
                        <li><a href="{{ route('mbunge.challenges.orodha', 'chama') }}">Maombi ya Chama</a></li>
                        <li><a href="{{ route('mbunge.challenges.orodha', 'wananchi') }}">Maombi ya Wananchi</a></li>

                    </ul>
                </li>
                <hr>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
