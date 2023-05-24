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
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Orodha ya Apartments</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                            <li class="breadcrumb-item active">Apartments</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- end row-->
        <div class="row">
            <div class="col-xl-6">

                <!--end card-->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                       
                        <h4 class="card-title">Orodha ya Apartment zote zisizolipiwa</h4>
                        <table id="houses-table" class="table table-striped table-bordered dt-responsive nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Jina la Nyumba</th>
                                <th>Jina la Apartment</th>
                                <th>Maelezo Kuhusu Apartment</th>
                                <th>Gharama ya Apartment</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $apartments as $apartment )
                                <tr class="text-danger">
                                    <td>{{ $apartment->house->houseName }}</td>
                                    <td>{{ $apartment->name }}</td>
                                    <td>{{ $apartment->desc }}</td>
                                    <td>{{ number_format( floatval($apartment->cost), 0, '.', ',') }} Tsh</td>
                                    <td>
                                        <a href="{{ route('super.apartment.showApartment', $apartment->id) }}" class="btn btn-success btn-sm">open</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
@endsection

@section('extra_script')
        <x-system.table-script id="houses-table" />
@endsection
