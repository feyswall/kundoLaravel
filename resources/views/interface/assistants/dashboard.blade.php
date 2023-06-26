<?php
/**
  * Created by feyswal on 1/8/2023.
  * Time 4:38 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>

@extends("layouts.assistants_system")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="p-5 text-center">

                    @can('grob_user')
                        <!-- end row-->
                            <div class="row">
                                <div class="col-xl-12">
                                    <x-system.collapse id="orodhaMaeneoWilaya" title="Orodha Wilaya">
                                        <x-slot:content>
                                            <table id="wTable" class="table table-striped table-sm
                                     table-bordered dt-responsive nowrap" style="border-collapse: collapse;
                                      border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>Jina</th>
                                                    <th>Idadi Halmashauri</th>
                                                    <th>Idadi Tarafa</th>
                                                    <th>Idadi Kata</th>
                                                    <th>Idadi Matawi</th>
                                                    <th>Idadi Mashina</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(  \App\Models\District::select('id', 'name')->withCount('councils')
                                                ->withCount('divisions')
                                                ->withCount('wards')
                                                ->withCount('branches')
                                                ->withCount('trunks')
                                                ->get()
                                                 as $area )
                                                    <tr>
                                                        <td>{{ $area->name }}</td>
                                                        <td>{{ $area->councils_count }}</td>
                                                        <td>{{ $area->divisions_count }}</td>
                                                        <td>{{ $area->wards_count }}</td>
                                                        <td>{{ $area->branches_count }}</td>
                                                        <td>{{ $area->trunks_count }}</td>
                                                        <td>
                                                            <a href="{{ route('assistants.areas.halmashauri.orodha', $area->id) }}"
                                                               class="btn btn-sm btn-success">
                                                                fungua</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </x-slot:content>
                                    </x-system.collapse>
                                </div>
                            </div>

                            <!-- end row-->
                            <div class="row">
                                <div class="col-xl-12">
                                    <x-system.collapse id="orodhaMaeneoHalmashauri" title="Orodha Halmashauri">
                                        <x-slot:content>
                                            <table id="hTable" class="table table-striped table-sm table-bordered dt-responsive nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>Halmashauri</th>
                                                    <th>Idadi Tarafa</th>
                                                    <th>Idadi Kata</th>
                                                    <th>Idadi Matawi</th>
                                                    <th>Idadi Mashina</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(  \App\Models\Council::select('id', 'name')->withCount('divisions')
                                                ->withCount('wards')
                                                ->withCount('branches')
                                                ->withCount('trunks')
                                                ->get() as $area )
                                                    <tr>
                                                        <td>{{ $area->name }}</td>
                                                        <td>{{ $area->divisions_count }}</td>
                                                        <td>{{ $area->wards_count }}</td>
                                                        <td>{{ $area->branches_count }}</td>
                                                        <td>{{ $area->trunks_count }}</td>
                                                        <td>
                                                            <a href="{{ route('assistants.areas.tarafa.orodha', $area->id) }}"
                                                               class="btn btn-sm btn-success"
                                                            >fungua</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </x-slot:content>
                                    </x-system.collapse>
                                </div>
                            </div>

                            <!-- end row-->
                            <div class="row">
                                <div class="col-xl-12">
                                    <x-system.collapse id="orodhaMaeneoTarafa" title="Orodha Tarafa">
                                        <x-slot:content>
                                            <table id="tTable" class="table table-striped table-sm table-bordered dt-responsive nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>Jina</th>
                                                    <th>Idadi Kata</th>
                                                    <th>Idadi Matawi</th>
                                                    <th>Idadi Mashina</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(  \App\Models\Division::select('id', 'name')->withCount('wards')
                                                ->withCount('branches')
                                                ->withCount('trunks')
                                                ->get() as $area )
                                                    <tr>
                                                        <td>{{ $area->name }}</td>
                                                        <td>{{ $area->wards_count }}</td>
                                                        <td>{{ $area->branches_count }}</td>
                                                        <td>{{ $area->trunks_count }}</td>
                                                        <td>
                                                            <a href="{{ route('assistants.areas.kata.orodha', $area->id) }}"
                                                               class="btn btn-sm btn-success"
                                                            >fungua</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </x-slot:content>
                                    </x-system.collapse>
                                </div>
                            </div>

                            <!-- end row-->
                            <div class="row">
                                <div class="col-xl-12">
                                    <x-system.collapse id="orodhaMaeneoKata" title="Orodha Kata">
                                        <x-slot:content>
                                            <table id="kTable" class="table table-striped table-sm table-bordered dt-responsive nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>Jina</th>
                                                    <th>Idadi Matawi</th>
                                                    <th>Idadi Mashina</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(  \App\Models\Ward::select('id','name')->withCount('branches')
                                                ->withCount('trunks')
                                                ->get() as $area )
                                                    <tr>
                                                        <td>{{ $area->name }}</td>
                                                        <td>{{ $area->branches_count }}</td>
                                                        <td>{{ $area->trunks_count }}</td>
                                                        <td>
                                                            <a href="{{ route('assistants.areas.tawi.orodha', $area->id) }}" class="btn btn-sm btn-success">
                                                                fungua
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </x-slot:content>
                                    </x-system.collapse>
                                </div>
                            </div>

                            <!-- end row-->
                            <div class="row">
                                <div class="col-xl-12">
                                    <x-system.collapse id="orodhaMaeneoMatawi" title="Orodha Matawi">
                                        <x-slot:content>
                                            <table id="bTable" class="table table-striped table-sm table-bordered dt-responsive nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>Jina</th>
                                                    <th>Idadi Mashina</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(  \App\Models\Branch::select('id', 'name')->withCount('trunks')
                                                ->get() as $area )
                                                    <tr>
                                                        <td>{{ $area->name }}</td>
                                                        <td>{{ $area->trunks_count }}</td>
                                                        <td><a href="{{ route('assistants.areas.tawi.fungua', $area->id) }}"
                                                               class="btn btn-sm btn-success">
                                                                fungua
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </x-slot:content>
                                    </x-system.collapse>
                                </div>
                            </div>

                            <!-- end row-->
                            <div class="row">
                                <div class="col-xl-12">
                                    <x-system.collapse id="orodhaMaeneoMashina" title="Orodha Mashina">
                                        <x-slot:content>
                                            <table id="bTable" class="table table-striped table-sm
                            table-bordered dt-responsive nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>Jina</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(  \App\Models\Trunk::select('id', 'name')->get() as $area )
                                                    <tr>
                                                        <td>{{ $area->name }}</td>
                                                        <td>
                                                            <a href="{{ route('assistants.areas.shina.fungua', $area->id) }}"
                                                               class="btn btn-success btn sm">fungua</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </x-slot:content>
                                    </x-system.collapse>
                                </div>
                            </div>
                    @endcan

                    @if(!(auth()->user()->hasPermissionTo('grob_user')))
                        <h3 class="text-center">
                            <b>Karibu Katika Uwanjwa Wa Msaidizi</b>
                        </h3>
                        <p>Hautaweza kufanya chochote hadi utakaporuhusiwa na Administrator</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_script')
    <x-system.table-script id="wTable"></x-system.table-script>
    <x-system.table-script id="hTable"></x-system.table-script>
    <x-system.table-script id="tTable"></x-system.table-script>
    <x-system.table-script id="kTable"></x-system.table-script>
    <x-system.table-script id="bTable"></x-system.table-script>
@endsection
