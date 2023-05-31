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
                    <h4 class="mb-0">Wasimamizi</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                            <li class="breadcrumb-item active">Wasimamizi</li>
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
                            <button data-bs-toggle="modal" data-bs-target="#createNewAssistance"
                                class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i>Sajiri
                            </button>
                        </div>
                        <h4 class="card-title">Orodha ya Wasimamizi Wote</h4>
                        <table id="houses-table" class="table table-striped table-bordered dt-responsive nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Jina Kamili</th>
                                <th>Simu No:_</th>
                                <th>Gender</th>
                                <th>Date:</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $assistants as $assistants )
                                <tr>
                                    <td>{{ $assistants->fullName }}</td>
                                    <td>{{ $assistants->phone }}</td>
                                    <td>{{ $assistants->gender }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($assistants->created_at)->format("M-d-Y") }}
                                    </td>
                                    <td>
                                        <a href="{{ route('super.assistants.show', $assistants->id) }}"
                                            class="btn btn-success btn-sm">open</a>
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
        <x-system.modal id="createNewAssistance" aria="assistantRegistration"
        size="modal-lg" title="Sajiri Assistant Mpya">
            <x-slot:content>
                <form method="POST" action="{{ route('super.assistants.store') }}">
                    @csrf
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="name">Jina Kamili</label>
                                    <input required type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="gender">Jinsia</label><br>
                                    Male: <input type="radio" checked name="gender" value="male" class="">
                                    Female: <input type="radio" name="gender" value="female" class="">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="cost">Simu No:_</label>
                                    <input type="text" name="phone" required class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <button class="btn btn-sm btn-success" type="submit">hifadhi</button>
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
