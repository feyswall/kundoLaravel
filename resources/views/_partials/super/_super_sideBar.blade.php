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
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ route('dashboard') }}"> <span>Nyumbani</span> </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        
                        <span>Usimamizi wa Viongozi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="viongozi/chama/kitongoji.php"><span>Orodha Uwongozi</span> </a>
                        </li>
                        <li> <a href="{{ route("super.areas.wilaya.orodha") }}" class="has-arrow">Maeneo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        
                        <span>Usimamizi wa Kibiashara</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="Ajira/Walioajiriwa/kitongoji.php"><span>Walioajiriwa</span> </a>
                        </li>
                        <li>
                            <a href="Ajira/Wasioajiriwa/kitongoji.php"><span>Walioomba</span> </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        
                        <span>Usimamizi wa majengo</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="nyumba/nyumbaOrodha.php"><span>Orodha ya Majengo</span> </a>
                        </li>
                        <li>
                            <a href="nyumba/madalali.php"><span>Ona madalali</span> </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="Ufadhili/kitongoji.php">
                        
                        <span class="">Usimamizi wa Elimu</span> </a>
                </li>
              
                <li>
                    <!-- <a href="Miradi/miradi.php"> <span class="">Miradi</span> </a> -->
                </li>
                <li class="menu-title">More</li>
                <li>
                    <a href="watumiaji/index.php">
                        
                        <span>Watumiaji</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        
                        <span>Vifaa Vya Ujenzi</span> </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="vifaa_vya_usafiri/orodha_ya_vifaa.php">Orodha</a></li>
                        <li><a href="vifaa_vya_usafiri/sajiri.php">Sajiri Vifaa</a></li>
                    </ul>
                </li> -->

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        
                        <span>Vyombo Vya usafirishaji</span> </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="vifaa_vya_usafiri/orodha_ya_vifaa.php">Orodha ya Vyombo</a></li>
                        <li><a href="vifaa_vya_usafiri/orodha_madereva.php">Orodha ya Madereva</a></li>
                        <li><a href="vifaa_vya_usafiri/orodhaYaService.php">service za gari</a></li>
                    </ul>
                </li>


                <li>
                    <a href="Ahadi/ahadi_za_wabunge.php">
                        
                        <span>Usimamizi Wa Wabunge</span> </a>
                </li>
                <hr>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>