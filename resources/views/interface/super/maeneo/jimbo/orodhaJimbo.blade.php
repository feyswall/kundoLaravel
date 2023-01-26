<?php

/**
 * Created by feyswal on 1/13/2023.
 * Time 8:49 AM.
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
                <h2 class="mb-0">Taarifa Za Majimbo</h2>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Maeneo</a></li>
                        <li class="breadcrumb-item active">Jimbo</li>
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
                    <div class="mt-5">
                        <h2>Orodha Ya Majimbo</h2>
                        <button data-bs-toggle="modal" data-bs-target="#orodhaJimboModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Ongeza Majimbo</button>
                        <a href="{{ route("super.areas.jimbo.orodha", $district->id) }}" class="btn btn-primary btn-md mb-4">Rudi Kwenye Wilaya</a>
                        {{-- <table id="superOrodhaJimboTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Jina la Jimbo</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $states as $key => $state )
                                <tr>
                                    <td>{{ $state->name }}</td>
                        <td>
                            <a href="{{ route("super.areas.wilaya.orodha", $district->id) }}" class="btn btn-primary">fungua</a>
                        </td>
                        </tr>
                        @endforeach

                        </tbody>
                        </table> --}}

                        <x-system.jimbo-table :states="$states" :district="$district"></x-system.jimbo-table>
                    </div>
                    <!-- model location states here -->
                    <x-system.modal id="orodhaJimboModal" aria="orodhaJimboLabel" size="modal-lg" title="Ongeza Jimbo Hapa">
                        <x-slot:content>
                            <form method="post" action="{{ route('super.areas.jimbo.ongeza') }}">
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
                                                <input type="text" class="form-control" readonly value="{{ $district->name }}">
                                                <input type="hidden" class="form-control" name="district_id" readonly value="{{ $district->id }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="billing-name">Jina La Jimbo</label>
                                                <input type="text" name="jimbo" class="form-control" value="{{ old('jimbo') }}">
                                            </div>
                                            @error("jimbo")
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
                </div>
            </div>
        </div>
    </div>


</div> <!-- container-fluid -->
<!-- end main content-->
@endsection

@section("extra_script")
<script>
    $(document).ready(function() {
        $(
                '#datatable'
            ).DataTable(), $('#superOrodhaJimboTable')
            .DataTable({
                lengthChange: !1,
                buttons: ['excel', 'pdf'],
                "order": [
                    [1, "desc"]
                ]
            })
            .buttons()
            .container().appendTo('#superOrodhaJimboTable_wrapper .col-md-6:eq(0)'), $('.dataTables_length select')
            .addClass('form-select form-select-sm');
    });
</script>
@endsection