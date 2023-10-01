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
                    <h4 class="mb-0">Orodha ya Nyumba</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                            <li class="breadcrumb-item active">Nyumba</li>
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
                            <button data-bs-toggle="modal" data-bs-target="#createNewHouse"
                             class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i>Sajiri Nyumba</button>
                        </div>
                        <h4 class="card-title">Orodha ya nyumba zote</h4>
                        <table id="houses-table" class="table table-striped table-bordered dt-responsive nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Jina la nyumba</th>
                                <th>Mahali ilipo</th>
                                <th>Aina na Nyumba</th>
                                <th>Idadi ya Apartments</th>
                                <th>Tarehe:</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $houses as $house )
                                <tr>
                                    <td>{{ $house->houseName }}</td>
                                    <td>{{ $house->location }}</td>
                                    <td>{{ $house->house_type->type_name }}</td>
                                    <td>
                                        <b>{{ $house->apartments->count() }}</b>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($house->created_at)->format("M-d-Y") }}</td>
                                    <td>
                                        <a href="{{ route('super.houses.showHouse', $house->id) }}"
                                         class="btn btn-success btn-sm">fungua</a>
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
            <x-system.modal id="createNewHouse" aria="houseRegistration" size="modal-lg" title="Sajiri Nyumba Mpya">
                <x-slot:content>
                    <form method="POST" action="{{ route('super.houses.storeHouse') }}">
                        @csrf
                        <div>
                            <div class="row justify-content-center">
                                <div class="col-lg-8 col-sm-12">
                                    <div class="mb-3 mb-4">
                                        <label class="form-label" for="billing-name">Jina La Utambulisho Wa Nyumba</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <div class="mb-3 mb-4">
                                        <label class="form-label" for="billing-name">Mahali Ilipo</label>
                                        <input type="text" name="location" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <div class="mb-3 mb-4">
                                        <label class="form-label" for="billing-name">Aina ya Nyumba</label>
                                            <select required name="house_type_id" class="form-control">
                                                @foreach( \App\Models\HouseType::all() as $type)
                                                    <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <div class="mb-3 mb-4">
                                      <button class="btn btn-sm btn-success" type="submit">sajiri</button>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <div class="mb-3 mb-4">
                                    <p>Hukupata Aina ya hii nyumba?
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#createNewHouseType" class="mb-4"> <b>Bonyeza Hapa</b> </a>
                                        kusajiri Aina Mpya ya nyumba</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </x-slot:content>
            </x-system.modal>
            <x-system.modal id="createNewHouseType" aria="houseRegistration" size="modal-fullscreen"
            title="Sajiri aina ya nyumba hapa">
            <x-slot:content>
                <form method="POST" action="{{ route('super.houseTypes.storeHouseType') }}">
                    @csrf
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Jina la Aina ya Nyumba</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <button class="btn btn-sm btn-success" type="submit">sajiri</button>
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
