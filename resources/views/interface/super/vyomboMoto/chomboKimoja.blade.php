<?php
/**
 * Created by feyswal on 3/27/2023.
 * Time 2:08 PM.
 * EastCoders & G3NET.
 * contacts: +255 628 960 877
 */
?>

@extends("layouts.super_system")

@section("content")
    <!-- end row -->
    <div id="app">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="">Jina la chombo: {{ $service->motor->identity_name }}</h3>

                        <h4 class="mt-3 text-danger"><b>Taarifa za Garage</b></h4>
                        <label class="form-label  font-size-24" id="machagulio-mkoa">
                            <h4>Jina: {{ $service->garage->name }}</h4>
                            <h4>Namba ya simu: {{ $service->garage->phone }}</h4>
                            <h4>Barua pepe: {{ $service->garage->email }}</h4>
                        </label>
                        <label class="form-label font-size-24" id="machagulio-wilaya"></label>


                        <div class="mt-3">
                            <h4 class="text-danger"><b>services Zilizofanyika</b></h4>
                            <table id="datatable-serviceGarage" class="table table-responsive table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Aina ya service</th>
                                    <th scope="col">cost(Asili) Tsh</th>
                                    <th scope="col">cost(jazwa) Tsh</th>
                                    <th>tofauti Tsh</th>
                                    <th>Idadi</th>
                                    <th>Tar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($service->service_types as $key => $type)
                                    <tr>
                                        <td>{{ $service->service_types->count() - $key }}</td>
                                        <td>{{ $type->name }}</td>
                                        <td> {{ $type->pivot->cost }}/=</td>
                                        <td> {{ $type->pivot->prevCost }}/=</td>
                                        <td> {{ $type->pivot->cost - $type->pivot->prevCost }}/=</td>
                                        <td> {{ $type->pivot->itemCount }}</td>
                                        <td>{{ Carbon\Carbon::parse($service->created_at)->format("M-d-Y") }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div>
                                @php
                                    $totalCost = 0;
                                    $expectedCost = 0;
                                    foreach($service->service_types as $type){
                                        $totalCost += ($type->pivot->cost * $type->pivot->itemCount);
                                        $expectedCost += ($type->pivot->prevCost * $type->pivot->itemCount);
                                        $tofauti = $totalCost - $expectedCost;
                                    }
                                @endphp
                                <h4><b>Jumla ya Gharama: </b> <i>Tsh {{ number_format($totalCost, 0, '.', ',') }}/=</i></h4>
                                <h4><b>Gharama Iliyotegemewa: </b><i>Tsh {{ number_format($expectedCost, 0, '.', ',') }}/=</i></h4>
                                <h3 class="@if($tofauti < 1) d-none @endif">Kiasi Kilichozidi: <b>Tsh {{ number_format($tofauti, 0, '.', ',') }}/=</b></h3>
                                <h3 class="@if($tofauti > 1) d-none @endif">Kiasi Kilichopungua: Tsh {{ number_format(abs($tofauti)), 0, '.', ',' }}/=</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>

@endsection

@section("extra_script")
    <x-system.table-script id="datatable-serviceGarage"/>
@endsection

