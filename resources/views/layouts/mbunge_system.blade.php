<?php
/**
  * Created by feyswal on 1/8/2023.
  * Time 4:59 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>


        <!doctype html>
<html lang="en">

<head>
    @include('_partials.mbunge._mbunge_head');

    @yield('extra_style')
</head>

<body>
<!-- <body data-layout="horizontal" data-topbar="colored"> -->
<!-- Begin page -->
<div id="layout-wrapper">

    @include('_partials.mbunge._mbunge_header');

    <!-- ========== Left Sidebar Start ========== -->
    @include('_partials.mbunge._mbunge_sideBar');

    <!-- Left Sidebar End -->
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            @yield('content')
        </div>
        <!-- End Page-content -->
        <footer class="footer">

            @include('_partials.mbunge._mbunge_footer');

        </footer>
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->
<!-- /Right-bar -->
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

@include('_partials.mbunge._mbunge_script');

@yield('extra_script')

</body>

</html>
