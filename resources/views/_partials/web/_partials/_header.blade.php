<?php

/**
 * Created by feyswal on 1/8/2023.
 * Time :8 PM.
 * EastCoders & G3NET.
 * contacts: +255 628 960 877
 */
?>

<div class="container d-flex align-items-center justify-content-between">

    <a href="index.html"><img src={{asset("logo-white.svg")}} alt=""></a>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.html" class="logo me-auto"><img src="assets/assets/img/logo.png" alt="" class="img-fluid"></a>-->

    <nav id="navbar" class="navbar">
        <ul>
            {{-- <li><a class="nav-link scrollto active" href="#hero">Anza</a></li>
            <li><a class="nav-link scrollto" href="#about">Kuhusu Mfumo</a></li>
            <li><a class="nav-link scrollto" href="#services">Huduma Zetu</a></li>
            <li><a class="nav-link scrollto" href="#contact">Hoja</a></li> --}}
            {{--<li><a class="getstarted scrollto" href="{{ route("register") }}">Jiunge</a></li>--}}
            <li><a class="getstarted scrollto" href="{{ route("login") }}">Ingia</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

</div>
