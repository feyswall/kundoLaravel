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
                    <h4 class="mb-0">Houses</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                            <li class="breadcrumb-item active">House</li>
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
                        <div>
                            <button data-bs-toggle="modal" data-bs-target="#createNewHouse" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Register House Type</button>
                        </div>
                        <h4 class="card-title">List Of all The Houses</h4>
                        <table id="houses-table" class="table table-striped table-bordered dt-responsive nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>House type's Name</th>
                                <th>Date:</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $houseTypes as $houseType )
                                <tr>
                                    <td>{{ $houseType->type_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($houseType->created_at)->format("M-d-Y") }}</td>
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
        <x-system.modal id="createNewHouse" aria="houseRegistration" size="modal-lg" title="Register A New House">
            <x-slot:content>
                <form method="POST" action="{{ route('super.houseTypes.storeHouseType') }}">
                    @csrf
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">House Category's name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <button class="btn btn-sm btn-success" type="submit">submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </x-slot:content>
        </x-system.modal>
    </div>
    <!-- container-fluid -->
@endsection

@section('extra_script')
    <x-system.table-script id="houses-table" />
@endsection
