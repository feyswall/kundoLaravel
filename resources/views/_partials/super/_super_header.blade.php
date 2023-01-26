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
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="20">
                    </span> </a>
                <a href="index.html" class="logo logo-light"> <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span> <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="20">
                    </span> </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn"> <i class="fa fa-fw fa-bars"></i> </button>
            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search..."> <span class="uil-search"></span>
                </div>
            </form>
        </div>
        <div class="d-flex">
            <div class="dropdown d-inline-block bg-black">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="uil-bell"></i> <span class="badge bg-danger rounded-pill">2</span> </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-16"> Taarifa </h5>
                            </div>
                            <div class="col-auto"> <a href="#!" class="small"> weka alama kama zimesomwa</a> </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="/Super/watumiaji/fungua.php" class="text-reset notification-item">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-xs"> <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="uil-shopping-basket"></i>
                                        </span> </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Anna Mkingo</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">Ombi kusajiliwa kama Mbunge</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i>2 days ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="/Super/watumiaji/fungua.php" class="text-reset notification-item">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-xs"> <span class="avatar-title bg-success rounded-circle font-size-16">
                                            <i class="uil-truck"></i>
                                        </span> </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Ramadhani Hadhim</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">If several languages coalesce the grammar</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="/Super/watumiaji/maombi.php"> <i class="uil-arrow-circle-right me-1"></i>Ona Zaidi... </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-4e.png" alt="Header Avatar"> <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">Super User</span> <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i> </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('profile.show') }}"><i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span class="align-middle">View Profile</span></a> 
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



