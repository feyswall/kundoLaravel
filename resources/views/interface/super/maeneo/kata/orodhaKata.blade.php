<?php
/**
  * Created by feyswal on 1/12/2023.
  * Time 4:46 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>


@extends("layouts.super_system")

@section("content")
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">Taarifa Za Kata</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Maeneo</a></li>
                            <li class="breadcrumb-item active">Kata</li>
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

                        <button  data-bs-toggle="modal" data-bs-target="#orodhaKataModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Ongeza Kata</button>
                        <a href="{{ route('super.areas.tarafa.orodha', $division->council->id) }}" class="btn btn-primary btn-md mb-4">Rudi Kwenye Tarafa</a>
                        <x-system.kata-table :areas="$areas">
                        </x-system.kata-table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <!-- model location here -->
        <x-system.modal id="orodhaKataModal" aria="orodhaHalmashauriLabel" size="modal-lg" title="Ongeza Kata Hapa" >
            <x-slot:content>
                <form method="post" action="{{ route('super.areas.kata.ongeza') }}">
                    @csrf
                    <div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Jina La Mkoa</label>
                                    <input type="text" readonly class="form-control" value="Bariadi">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Jina La Wilaya</label>
                                    <input type="text" class="form-control" readonly value="{{ $division->council->district->name }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Jina La Halmashauri</label>
                                    <input type="text" class="form-control" readonly value="{{ $division->council->name }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Jina La Tarafa</label>
                                    <input type="text" class="form-control" readonly value="{{ $division->name }}">
                                    <input type="hidden" name="division_id" class="form-control" readonly value="{{ $division->id }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Jina La Kata</label>
                                    <input type="text" name="kata" class="form-control" placeholder="eg: mgeule juu">
                                </div>
                                @error("kata")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" name="submit" class="btn btn-primary btn-md">Ongeza</button>
                            </div>
                        </div>
                </form>
            </x-slot:content>
        </x-system.modal>

    </div> <!-- container-fluid -->
    <!-- end main content-->
@endsection

@section("extra_script")
    <script>
        $ (document).ready (function () {
            $ (
                '#datatable'
            ).DataTable (), $ ('#superOrodhaWilayaTable')
                .DataTable ({lengthChange: !1, buttons: ['excel', 'pdf'], "order": [[ 1, "desc" ]]})
                .buttons ()
                .container ().appendTo ('#superOrodhaKataTable_wrapper .col-md-6:eq(0)'), $ ('.dataTables_length select')
                .addClass ('form-select form-select-sm');
        });
    </script>
@endsection

