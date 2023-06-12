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
                @can(['grob_sials'])
                    <li> <a href="javascript: void(0);" class="has-arrow">Barua</a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li> <a href="{{ route('assistants.sial.allList') }}">Orodha</a></li>
                        </ul>
                    </li>
                @endcan

                @can(['grob_house_apartments'])
                <li> <a href="javascript: void(0);" class="has-arrow">Nyumba</a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('assistants.houses.allHouses') }}"><span>Orodha ya Nyumba</span> </a></li>
                    </ul>
                </li>
                @endcan
                <hr>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
