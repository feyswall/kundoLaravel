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
                        <label class="form-label  font-size-24" id="machagulio-mkoa"></label>
                        <label class="form-label font-size-24" id="machagulio-wilaya"></label>
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-10">
                                <h5>Jina la chombo:  < <b>{{ $motor->identity_name }}</b> ></h5>
                                <h5>Mmiliki wa sasa < <b>{{ $motor->owner->name  }}</b> ></h5>
                            </div>
                            <div class="col-sm-8 col-sm-10">
                                <div class="mt-4">

                                    <h2>Orodha ya service ya Chombo Hiki</h2>
                                    <table id="datatable-motorsTable"
                                           class="table table-striped table-bordered dt-responsive nowrap"
                                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <th>#</th>
                                        <th>Jina la mmiliki</th>
                                        <th>Jina la Garage</th>
                                        <th>Tarehe</th>
                                        <th></th>
                                        </thead>
                                        <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach( $motor->services as $key => $service )
                                            <tr>
                                                <td>{{ ++$counter }}</td>
                                                <td>{{ $service->owner->name }}</td>
                                                <td>{{ $service->garage->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($service->created_at)->format("M-d-Y") }}</td>
                                                <td>
                                                    <a href="{{ route("super.service.showService", $service->id) }}" class="btn btn-sm btn-success">fungua</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>


@endsection

@section("extra_script")
    <x-system.table-script id="datatable-motorsTable" />
    <script>
        const app = new Vue({
            el: '#app',
            data(){
                return {
                    servicesCounter: 1,
                    servicesCounterArray: [1],
                    serviceList: [],
                    selectedGarage: 0,
                }
            },
            methods: {
                garageChanged(){
                    axios.get(`/api/garage/orodha/${this._data.selectedGarage}`)
                        .then((response) => {
                            this._data.serviceList = response.data.obj;
                        });
                },
                addElement(){
                    this._data.servicesCounter += 1;
                    this._data.servicesCounterArray.push(this._data.servicesCounter);
                },
                closeRow(item){
                    this._data.servicesCounterArray.splice(this._data.servicesCounterArray.indexOf(item), 1);
                }
            },
            mounted() {
                this.garageChanged()
            },
        });
    </script>
@endsection

