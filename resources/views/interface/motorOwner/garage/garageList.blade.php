<?php
/**
 * Created by feyswal on 3/27/2023.
 * Time 2:08 PM.
 * EastCoders & G3NET.
 * contacts: +255 628 960 877
 */
?>

@extends("layouts.motorOwner_system")

@section("content")
    <!-- end row -->
    <div id="app">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="">Orodha Ya Garage</h2>
                        <label class="form-label  font-size-24" id="machagulio-mkoa"></label>
                        <button data-bs-toggle="modal"
                                data-bs-target="#ongezaGarageModal"
                                class="btn btn-info btn-sm mb-4">
                            <i class="fas fa-plus"> </i> Sajiri garage
                        </button>
                        <label class="form-label font-size-24" id="machagulio-wilaya"></label>
                        <table id="datatable-motorsTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <td>#</td>
                            <th>Jina la garage</th>
                            <td>Mkoa</td>
                            <td>Simu No:</td>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach( $garages as $key => $garage )
                                <tr>
                                    <td>{{ $garage->count() - $key }}</td>
                                    <td>{{ $garage->name }}</td>
                                    <td>{{ $garage->region->name }}</td>
                                    <td>{{ $garage->phone }}</td>
                                    <td>
{{--                                        <a href="" class="btn btn-success btn-sm">fungua</a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>

    <x-system.modal id="ongezaGarageModal" aria="ongezaGarage" size="modal-md" title="Ongeza Garage Hapa">
        <x-slot:content>
            <form method="post" action="{{ route('motorOwner.garage.ongeza') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="mb-3 mb-4">
                            <label class="form-label" for="name">Jina La Garage</label>
                            <input type="text" class="form-control" name="name" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="mb-3 mb-4">
                            <label class="form-label" for="region">Mkoa</label>
                            <select class="form-control" name="region" required>
                                @foreach( \App\Models\Region::all() as $region )
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                            <div class="mt-3">
                                <a data-bs-toggle="modal" data-bs-target="#ongezaMkoaModal" class="text-primary" >
                                    <i class="fas fa-plus"> </i> bonyeza hapa kuongeza mkoa
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="mb-3 mb-4">
                            <label class="form-label" for="phone">No: Simu</label>
                            <input type="text" class="form-control" name="phone" required>
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="mb-3 mb-4">
                            <label class="form-label" for="email">Barua Pepe</label>
                            <input type="text" class="form-control" name="email" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary btn-md">Ongeza</button>
                        </div>
                    </div>
                </div>
            </form>
        </x-slot:content>
    </x-system.modal>

    <x-system.modal id="ongezaMkoaModal" aria="ongezaGarage" size="modal-md" title="Ongeza Mkoa Hapa">
        <x-slot:content>
            <form method="post" action="{{ route('motorOwner.region.ongeza') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="mb-3 mb-4">
                            <label class="form-label" for="region">Mkoa</label>
                            <input type="text" class="form-control" name="region" required>
                            @error('mkoa')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary btn-md">Ongeza</button>
                        </div>
                    </div>
                </div>
            </form>
        </x-slot:content>
    </x-system.modal>

@endsection

@section("extra_script")
    <x-system.table-script id="datatable-motorsTable" />
@endsection

