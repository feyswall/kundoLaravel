<!doctype html>
<html lang="en">

<head>
    @include('_partials.super._super_head')

    @yield('extra_style')
</head>

<body>
<!-- <body data-layout="horizontal" data-topbar="colored"> -->
<!-- Begin page -->
<div id="layout-wrapper">

@include('_partials.super._super_header')

<!-- ========== Left Sidebar Start ========== -->
@include('_partials.super._super_sideBar')

<!-- Left Sidebar End -->
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                    <x-system.alert-message />
            </div>
           @yield('content')
        </div>
        <!-- End Page-content -->
        <footer class="footer">

            @include('_partials.super._super_footer')

        </footer>
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->
<!-- /Right-bar -->
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
    integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
<!-- JAVASCRIPT -->
<script src="{{ asset('https://code.iconify.design/1/1.0.7/iconify.min.js') }}"></script>

<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>



<!-- Required datatable js -->
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<!-- Buttons examples -->
<script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- Responsive examples -->
<script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>


@yield('extra_script')

@include('_partials.super._super_script')

</body>

</html>
