<!doctype html>
<html lang="en">

<head>
    @include('_partials.super._super_head');

    @yield('extra_style')
</head>

<body>
<!-- <body data-layout="horizontal" data-topbar="colored"> -->
<!-- Begin page -->
<div id="layout-wrapper">

@include('_partials.super._super_header');

<!-- ========== Left Sidebar Start ========== -->
@include('_partials.super._super_sideBar');

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

            @include('_partials.super._super_footer');

        </footer>
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->
<!-- /Right-bar -->
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

@include('_partials.super._super_script');

@yield('extra_script')

<!-- apexcharts -->
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

</body>

</html>