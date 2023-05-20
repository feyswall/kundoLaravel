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
                    <h4 class="mb-0">Misaada</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                            <li class="breadcrumb-item active">Misaada</li>
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
                        <div>
                            <button data-bs-toggle="modal" data-bs-target="#createNewHouse" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i>Sajiri </button>
                        </div>
                        <h4 class="card-title">Orodha ya Misaada Yote</h4>
                        <table id="houses-table" class="table table-striped table-bordered dt-responsive nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Jina</th>
                                <th>Maelezo</th>
                                <th>Kiasi</th>
                                <th>Date:</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $charities as $charity )
                                <tr>
                                    <td>{{ $charity->name }}</td>
                                    <td>{{ $charity->description }}</td>
                                    <td>{{ $charity->cost }}</td>
                                    <td>{{ \Carbon\Carbon::parse($charity->created_at)->format("M-d-Y") }}</td>
                                    <td>
                                        <a href="{{ route('super.charity.showCharity', $charity->id) }}" class="btn btn-success btn-sm">open</a>
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
        <x-system.modal id="createNewHouse" aria="houseRegistration" size="modal-lg" title="Jaza Msaada Mpya">
            <x-slot:content>
                <form method="POST" action="{{ route('super.charity.store') }}">
                    @csrf
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="name">Jina La Utambulisho</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="cost">Jumla ya Gharama</label>
                                    <input type="number" name="cost" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Maelezo Zaidi</label>
                                    <textarea class="form-control" rows="5" name="description"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label for="charityType" class="form-label">Aina Ya Msaada</label>
                                    <select class="form-control" name="charityType_id" id="charityType">
                                        @foreach( \App\Models\CharityCategory::all() as $charity )
                                            <option value="{{ $charity->id }}">{{ $charity->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <button class="btn btn-sm btn-success" type="submit">hifadhi</button>
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <p>Je Aina ya Msaada Haikuorodheshwa?
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#createNewHouseType" class="mb-4"> <b>Bonyeza Hapa</b> </a>
                                        Kutengeneza Aina</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </x-slot:content>
        </x-system.modal>
        <x-system.modal id="createNewHouseType" aria="houseRegistration" size="modal-fullscreen" title="Register A New House Type">
            <x-slot:content>
                <form method="POST" action="{{ route('super.charityCategory.store') }}">
                    @csrf
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Jina la Aina Ya Msaada</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <button class="btn btn-sm btn-success" type="submit">Sajiri</button>
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
