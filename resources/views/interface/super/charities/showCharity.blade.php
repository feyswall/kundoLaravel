<?php
/**
 * Created by feyswal on 1/8/2023.
 * Time 4:38 PM.
 * EastCoders & G3NET.
 * contacts: +255 628 960 877
 */
?>

@extends("layouts.super_system")

@section("content")
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3><b>{{ $charity->name }}</b></h3>
                        <h3>{{ \Carbon\Carbon::parse($charity->inDate)->format('M-d-Y'); }}</h3>
                        <h3>Total Cost</h3>
                        <p>Tsh {{ number_format($charity->cost, 0, '.', ',') }} /=</p>
                        <h4 class="card-title mt-2">{{ $charity->description }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        @endsection

        @section('extra_script')
            <x-system.table-script id="apartment-table" />
@endsection
