<?php
/**
  * Created by feyswal on 3/8/2023.
  * Time 4:51 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>



@extends("layouts.super_system")

@section('extra_style')

@endsection

@section("content")
    <div id="app">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="">Orodha ya Service Zilizowahi Kufanyika</h2>
                        <button data-bs-toggle="modal" data-bs-target="#ongezaChomo" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajiri Kiongozi</button>
                        <label class="form-label  font-size-24" id="machagulio-mkoa"></label>
                        <label class="form-label font-size-24" id="machagulio-wilaya"></label>
                        <table id="datatable-serviceTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <td>#</td>
                            <td>Siku</td>
                            <th>Chombo</th>
                            <th>Garage</th>
                            <th>services</th>
                            <th>cost</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach( $services as $key => $service )
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($service->created_at)->format("D M Y") }}</td>
                                    <td></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-success">fungua</a>
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
        <x-system.modal id="ongezaChomo" aria="orodhaServicesLabel" size="modal-fullscreen" title="Ongeza Service Hapa">
            <x-slot:content>

            </x-slot:content>
        </x-system.modal>
    </div>
@endsection

@section("extra_script")
    <x-system.table-script id="datatable-serviceTable" />
@endsection

