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
                        <label class="form-label  font-size-24" id="machagulio-mkoa"></label>
                        <label class="form-label font-size-24" id="machagulio-wilaya"></label>
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-10">
                                <h5>Jina la chombo:  < {{ $motor->identity_name }} ></h5>
                            </div>
                            <x-system.collapse id="hifadhiService" title="Peleka Chombo Garage">
                                <x-slot:content>
                                    <div class="col-sm-12 col-md-10">
                                        <h2 class="mb-3">Ingiza Service</h2>
                                        <div class="mb-2">
                                            <a href="{{ route('motorOwner.garage.orodha') }}"
                                            class="btn btn-sm btn-primary">  <i class="fas fa-plus"> </i> ongeza garage
                                            </a>
                                        </div>
                                        <form method="post" action="{{ route('motorOwner.service.ongeza') }}">
                                            @csrf
                                            <input type="hidden" name="motor" value="{{ $motor->id }}">
                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="middleName">Choose a garage</label>
                                                    <select v-on:change="garageChanged()" v-model="selectedGarage" type="text" class="form-control" name="garage" >
                                                        <option selected value="0">chagua garage</option>
                                                        @foreach( App\Models\Garage::all() as $garage)
                                                            <option value="{{ $garage->id }}">{{ $garage->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row" v-for="(item, index) in servicesCounterArray"
                                                v-bind:key="index" v-bind:id="'row-'+item">
                                                <div class="col-sm-12 col-md-5 col-lg-5">
                                                    <div class="mb-3 mb-4">
                                                        <label class="form-label" for="firstName">Jina La Service</label>
                                                        <select v-bind:id="'name-'+item" type="text" class="form-control" name="serviceType[]" required>
                                                            <option v-for="(service, index) in serviceList" v-bind:key="index" v-bind:value="service.id">@{{ service.name }} - cost( Tsh @{{ service.cost }} /=)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-2 col-lg-2">
                                                    <div class="mb-3 mb-4">
                                                        <label class="form-label" for="middleName">Gharama(Tsh)</label>
                                                        <input v-bind:id="'cost-'+item" type="number" class="form-control" name="cost[]" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-2 col-lg-2">
                                                    <div class="mb-3 mb-4">
                                                        <label class="form-label" for="idadi">Idadi</label>
                                                        <input value="1" v-bind:id="'itemCount-'+item" type="number" class="form-control" name="itemCount[]" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-1 col-lg-1 align-self-end">
                                                    <div class="mb-3 mb-4">
                                                        <button v-if="index == (servicesCounterArray.length - 1)" type="button" v-bind:id="'close-btn'+item"
                                                                v-on:click="closeRow(item)"
                                                                class="btn btn-danger btn-sm">x
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-success btn-sm rounded-danger m-3" v-on:click="addElement()">+</button>
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-paper-plane" aria-hidden="true"></i> tuma</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </x-slot:content>
                            </x-system.collapse>
                            <div class="col-sm-8 col-sm-10">
                                <div class="mt-4">

                                    <h2>Orodha ya service ya Chombo Hiki</h2>
                                    <table id="datatable-motorsTable"
                                           class="table table-striped table-bordered dt-responsive nowrap"
                                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <th>#</th>
                                        <th>Gharama Tegemewa</th>
                                        <th>Gharama uliojaza</th>
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
                                                        <a href="{{ route("motorOwner.service.moja", $service->id) }}" class="btn btn-sm btn-success">fungua</a>
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

