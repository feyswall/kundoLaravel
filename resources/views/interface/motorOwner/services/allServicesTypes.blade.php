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
                        <h2 class="">Orodha Ya Aina Ya Service</h2>
                        <label class="form-label  font-size-24" id="machagulio-mkoa"></label>
                        <button data-bs-toggle="modal"
                                data-bs-target="#ongezaKiongoziChamaModal"
                                class="btn btn-info btn-sm mb-4"><i class="fas fa-plus"> </i> Sajiri mpya
                        </button>
                        <label class="form-label font-size-24" id="machagulio-wilaya"></label>
                        <table id="datatable-motorsTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <td>#</td>
                            <th>Jina la service</th>
                            <th>Gharama</th>
                            <th>Garage</th>
                            <th>Region</th>
                            <td>Tarehe</td>
                            </thead>
                            <tbody>
                                    @foreach( $serviceTypes as $key => $type )
                                        <tr>
                                            <td>{{ $serviceTypes->count() - $key }}</td>
                                            <td>{{ $type->name }}</td>
                                            <td>{{ $type->cost }}</td>
                                            <td>{{ $type->garage->name }}</td>
                                            <td>{{ $type->garage->region->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($type->created_at)->format("M-d-Y") }}</td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>

    <x-system.modal id="ongezaKiongoziChamaModal" aria="ongezaServiceType" size="modal-md" title="Ongeza Aina ya service hapa">
        <x-slot:content>
            <form method="post" action="{{ route('motorOwner.service.type.ongeza') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="mb-3 mb-4">
                            <label class="form-label" for="firstName">Jina La Garage</label>
                            <select  class="form-control" name="garage" required>
                                @foreach(App\Models\Garage::all() as $key => $garage )
                                    <option value="{{ $garage->id }}">{{ $garage->name }}</option>
                                @endforeach
                            </select>
                            <a class="m-2" href="{{ route('motorOwner.garage.orodha') }}">Bonyeza hapa kuweka garage mpya</a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="mb-3 mb-4">
                            <label class="form-label" for="firstName">Jina La Service</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="mb-3 mb-4">
                            <label class="form-label" for="middleName">Gharama(Tsh)</label>
                            <input type="number" class="form-control" name="cost" required>
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

