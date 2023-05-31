<?php

/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/30/2022
 * Time: 10:49 AM
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
                    <a href="{{ route('dashboard') }}"> <span>Nyumbani</span> </a>
                </li>

                <li> <a href="javascript: void(0);" class="has-arrow">Barua</a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li> <a href="{{ route('assistance.sial.allList') }}">Orodha</a></li>
                    </ul>
                </li>
                <hr>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
