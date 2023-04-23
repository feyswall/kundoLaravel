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
                        <h2 class="">Orodha Ya Service</h2>
                        <label class="form-label  font-size-24" id="machagulio-mkoa"></label>
                        <label class="form-label font-size-24" id="machagulio-wilaya"></label>
                        <table id="datatable-motorsTable"
                               class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <th>#</th>
                            <th>Jina la Chombo</th>
                            <th>Tarehe</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach( $services as $key => $service )
                                <tr>
                                    <td>{{ $services->count() - $key }}</td>
                                    <td>{{ $service->motor->identity_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($service->created_at)->format("M-d-Y") }}</td>
                                    <td>
                                        <a href="{{ route("motorOwner.service.moja", $service->id) }}" class="btn btn-sm btn-success">fungua</a>
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

@endsection

@section("extra_script")
    <x-system.table-script id="datatable-motorsTable"/>
@endsection

