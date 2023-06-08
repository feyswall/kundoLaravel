<?php

/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/30/2022
 * Time: 10:45 AM
 */
?>
<header id="page-topbar" >
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn"> <i class="fa fa-fw fa-bars"></i> </button>
            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search..."> <span class="uil-search"></span>
                </div>
            </form>
        </div>
        <div class="d-flex">

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img class="rounded-circle header-profile-user" src="{{ asset("https://w7.pngwing.com/pngs/831/88/png-transparent-user-profile-computer-icons-user-interface-mystique-miscellaneous-user-interface-design-smile-thumbnail.png") }}" alt="Header Avatar"> <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span> <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i> </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('super.receivers.index') }}"><i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span class="align-middle">Wapokea Taarifa</span></a>
                    <a class="dropdown-item" href="{{ route('profile.show') }}"><i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span class="align-middle">Ona Profile</span></a>
                    <x-system.logout />
                </div>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect"> <i class="uil-cog"></i> </button>
            </div>
        </div>
    </div>
    <div>
    </div>
</header>



