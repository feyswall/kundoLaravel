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
    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>
    <div data-simplebar class="sidebar-menu-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('dashboard') }}"> <span>Nyumbani</span> </a>
                </li>

                <li> <a href="javascript: void(0);" class="has-arrow">Tafuta Viongozi</a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('super.leader.area.searchLeader') }}">eneo</a></li>
                        <li><a href="{{ route('super.leader.sial.searchLeader') }}"><span>wadhifa</span></a></li>
                        <li><a href="{{ route('super.leader.searchLeader') }}">eneo & wadhifa</a></li>
                    </ul>
                </li>

                <li> <a href="javascript: void(0);" class="has-arrow">Maeneo</a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li> <a href="{{ route('super.areas.wilaya.orodha') }}">Orodha</a></li>
                        {{--    <li><a href="/lo"><span>Orodha  Kamati</span> </a></li>--}}
                        <li><a href="{{ route('super.areas.general.anza') }}"><span>Tafuta</span> </a></li>
                    </ul>
                </li>

                <li> <a href="javascript: void(0);" class="has-arrow">Nyumba</a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('super.houses.allHouses') }}"><span>Orodha ya Nyumba</span> </a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <span>Huduma Za Sms</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('sms.group.select') }}"><span>Tuma Sms</span> </a></li>
                        <li> <a href="{{ route('sms.orodha.group') }}">Orodha Sms</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('super.challenge.orodha') }}"><span>Changamoto za Wabunge</span> </a></li>

                {{-- <li> <a href="javascript: void(0);" class="has-arrow">Barua</a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li> <a href="{{ route('super.sial.allList') }}">Orodha</a></li>
                    </ul>
                </li> --}}

                <li> <a href="{{ route('pdf.door.index') }}" class="">Tengeneza PDF</a></li>

                <li> <a href="javascript: void(0);" class="has-arrow">Misaada</a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li> <a href="{{ route('super.charity.index') }}">Orodha Ya Misaada</a></li>
                    </ul>
                </li>
                <hr>

                <li> <a href="javascript: void(0);" class="has-arrow">Vyombo Vya Moto</a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li> <a href="{{ route('super.motor.allList') }}">Orodha Ya Vyombo</a></li>
                        <li> <a href="{{ route('super.service.allList') }}">Orodha Ya Service</a></li>
                    </ul>
                </li>

                <li> <a href="javascript: void(0);" class="has-arrow">settings</a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <span>Usimamizi wa Viongozi</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li> <a href="javascript: void(0);" class="has-arrow">Viongozi Chama</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route("super.group.orodha", 'chama') }}"><span>Orodha  Kamati</span> </a></li>
                                    <li><a href="{{ route("super.posts.orodha", 'chama') }}"><span>Orodha Nyadhifa </span> </a></li>
                                </ul>
                            </li>
                            <li> <a href="javascript: void(0);" class="has-arrow">Viongozi Serikali</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route("super.group.orodha", 'serikali') }}"><span>Orodha  Kamati</span> </a></li>
                                    <li><a href="{{ route("super.posts.orodha", 'serikali') }}"><span>Orodha Nyadhifa </span> </a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                        <li><a href="{{ route('super.houseTypes.showAll') }}"><span>Aina ya Nyumba</span> </a></li>
                        <li><a href="{{ route('super.assistants.index') }}"><span>Wasimamizi</span> </a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
