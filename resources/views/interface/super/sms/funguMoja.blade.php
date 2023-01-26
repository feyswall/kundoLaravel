<?php
/**
  * Created by feyswal on 1/25/2023.
  * Time 4:37 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>



@extends("layouts.super_system")

@section('extra_style')

@endsection

@section("content")

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">Taarifa Za Sms</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">sms</a></li>
                            <li class="breadcrumb-item active">group</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route("sms.orodha.group") }}" class="btn btn-primary btn-md mb-4">Rudi Kwenye Orodha</a>
                        <x-system.sms-group-table :sms="$sms" :leaders="$leaders" id="allSmsTable" />
                    </div>
                </div>
            </div> <!-- end col -->
            <div class="m-auto">
                {{ $leaders->links() }}
            </div>
        </div> <!-- end row -->

    </div> <!-- container-fluid -->
    <!-- end main content-->

@endsection

@section("extra_script")
    {{--<x-system.table-script id="allSmsTable" />--}}
@endsection