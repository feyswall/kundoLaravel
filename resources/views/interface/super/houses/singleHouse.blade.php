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
                        <h3>House's Name: {{ $house->houseName }}</h3>
                        <h3>House's Location: {{ $house->location }}</h3>

                        <div class="mt-3">
                            <button data-bs-toggle="modal" data-bs-target="#createNewApartment" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Register Apartment</button>
                        </div>
                        <h4 class="card-title mt-2">Apartment's Lists</h4>
                        <table id="apartment-table" class="table table-striped table-bordered dt-responsive nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Apartment's Name</th>
                                <th>Apartment's Description</th>
                                <th>Apartment's Cost</th>
                                <th>Registered Date:</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $house->apartments as $apartment )
                                <tr>
                                    <td>{{ $apartment->name }}</td>
                                    <td>{{ $apartment->desc }}</td>
                                    <td>{{ number_format( floatval($apartment->cost), 0, '.', ',') }} Tsh</td>
                                    <td>{{ \Carbon\Carbon::parse($house->created_at)->format("M-d-Y") }}</td>
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
        </div>
        <x-system.modal id="createNewApartment" aria="apartmentRegistration" size="modal-lg" title="Register A New Apartment">
            <x-slot:content>
                <form method="POST" action="{{ route('super.apartment.storeApartment') }}">
                    @csrf
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Apartment's Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Apartment's Description</label>
                                    <textarea name="description" class="form-control" rows="8"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Apartment's Cost</label>
                                    <input type="number" name="cost" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <input name="house_id" value="{{ $house->id }}" type="hidden">
                                    <button class="btn btn-sm btn-success" type="submit">submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </x-slot:content>
        </x-system.modal>
        <!-- end page title -->
@endsection

@section('extra_script')
            <x-system.table-script id="apartment-table" />
@endsection
