<?php
/**
  * Created by feyswal on 1/10/2023.
  * Time 2:57 PM.
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
                            <h2 class="mb-0">Taarifa Za Wilaya</h2>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Maeneo</a></li>
                                    <li class="breadcrumb-item active">Wilaya</li>
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

                                <button  data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Ongeza Wilaya</button>

                                <table id="superOrodhaWilayaTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>Jina la Wilaya</th>
                                        <th>Idadi Ya  Almashauri</th>
                                        <th>Idadi Ya Tarafa</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $areas as $key => $district )
                                            <tr>
                                                <td>{{ $district->name }}</td>
                                                <td>{{ $district->councils()->count() }}</td>
                                                <td>
                                                    {{--@php--}}
                                                        {{--$counter = 0;--}}
                                                        {{--foreach ( $district->councils() as $council ){--}}
                                                            {{--$number = $council->divisions()->count();--}}
                                                        {{--}--}}
                                                    {{--echo $counter;--}}
                                                    {{--@endphp--}}
                                                    {{ $district->divisions()->count() }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('super.areas.halmashauri.orodha', $district->id) }}" class="btn btn-primary">fungua</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

                <!-- model location here -->
                <x-system.modal id="exampleModal" aria="orodhaWilayaLabel" size="modal-lg" title="Ongeza Wilaya Hapa" >
                    <x-slot:content>
                        <x-system.ongeza-wilaya-modal-form />
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
                    .container ().appendTo ('#superOrodhaWilayaTable_wrapper .col-md-6:eq(0)'), $ ('.dataTables_length select')
                    .addClass ('form-select form-select-sm');
            });
        </script>
        @endsection