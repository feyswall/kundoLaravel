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
                    <h4 class="mb-0">Wapokea Taarifa</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                            <li class="breadcrumb-item active">Wapokea Taarifa</li>
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
                            <button data-bs-toggle="modal" data-bs-target="#smsReceiver" class="btn btn-info btn-md mb-4">
                                <i class="fas fa-plus"> </i> ongeza
                            </button>
                        </div>
                        <h4 class="card-title">Orodha ya Watakaopokea Taafiza Za System</h4>
                        <table id="houses-table" class="table table-striped table-bordered dt-responsive nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Jina Kamili</th>
                                <th>No: ya simu</th>
                                <th>Tarehe:</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach( $receivers as $receiver )
                                    <tr>
                                        <td>{{ $receiver->name }}</td>
                                        <td>{{ $receiver->phone }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($receiver->created_at)->format("M-d-Y") }}
                                        </td>
                                        <td>
                                            <button type="button" form="deleteReceiver"
                                            onclick="if(confirm(`Bonyeza OK kumtoa mpokeaji`)){
                                                document.querySelector('#deleteReceiver').submit();
                                            }"
                                            class="btn btn-sm btn-danger">
                                                futa
                                            </button>
                                            <form method="POST" id="deleteReceiver"
                                             action="{{ route('super.receivers.delete', $receiver->id) }}">
                                             @csrf
                                             @method('delete')
                                            </form>
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
        <x-system.modal id="smsReceiver" aria="smsReceivers" size="modal-lg" title="Sajiri Mpokea Taarifa">
            <x-slot:content>
                <form method="POST" action="{{ route('super.receivers.store') }}">
                    @csrf
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Jina Kamili</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Namba Ya Simu</label>
                                    <input type="text" name="phone" class="form-control">
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
