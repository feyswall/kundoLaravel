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
                  <div class="row justify-content-start">
                    <div class="col-sm-12 col-md-5">
                        <div class="mb-3">
                            <h4>Jina la Msimamizi:</h4>
                            <p><small>{{ $assistant->fullName }}</small></p>
                            <h4>Jinsia</h4>
                            <small >{{ $assistant->gender }}</small>
                            <h4 class="mt-3">Namba ya Simu</h4>
                            <small>{{ $assistant->phone }}</small>
                        </div>
                        <button data-bs-toggle="modal" data-bs-target="#givePermissionToAssistance"
                            class="btn btn-info btn-sm mb-4"><i class="fas fa-plus"> </i> Patia Ruhusa
                        </button>
                        <button data-bs-toggle="modal" data-bs-target="#removePermissionToAssistance"
                                class="btn btn-danger btn-sm mb-4"><i class="fas fa-plus"> </i> Tolea Ruhusa
                        </button>
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <h4 class="mt-3">Amesha ruhusiwa Katika:</h4>
                            <ul>
                                @foreach ($nonePermissions as $permission)
                                    <li>{{ $permission->presentable }}</li>
                                @endforeach
                            </ul>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <x-system.modal id="givePermissionToAssistance" aria="assistantRegistration"
    size="modal-lg" title="Ruhusu Msimamizi Kufanya">
        <x-slot:content>
            <form method="POST" action="{{ route('super.assistants.givePermission') }}">
                @csrf
                <div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-sm-12">
                            <div class="mb-3 mb-4">
                                <label class="form-label" for="cost">Mruhusu: </label><br>
                                <input type="hidden" name="assistant" value="{{ $assistant->id }}">
                                <div class="row justify-content-start">
                                    @foreach( $permissions as $permission )
                                        <div class="col-sm-6">
                                            <div class="p-2">
                                                <span class="m-4"> {{ $permission->presentable }}</span>
                                                 <input type="checkbox" name="permit[]" value="{{ $permission->name }}"
                                                        class="checkbox-row">
                                             </div>
                                        </div>
                                @endforeach
                                </div>
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

    <x-system.modal id="removePermissionToAssistance" aria="assistantRegistration"
                    size="modal-lg" title="Ondoa Ruksa Kwa Kufanya">
        <x-slot:content>
            <form method="POST" action="{{ route('super.assistants.removePermission') }}">
                @csrf
                <div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-sm-12">
                            <div class="mb-3 mb-4">
                                <label class="form-label" for="cost">Mruhusu: </label><br>
                                <input type="hidden" name="assistant" value="{{ $assistant->id }}">
                                <div class="row justify-content-start">
                                    @foreach( $nonePermissions as $permission )
                                        <div class="col-sm-6">
                                            <div class="p-2">
                                                <span class="m-4"> {{ $permission->presentable }}</span>
                                                <input type="checkbox" name="permit[]" value="{{ $permission->id }}"
                                                       class="checkbox-row">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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

@endsection
