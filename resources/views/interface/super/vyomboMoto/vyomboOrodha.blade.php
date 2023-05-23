<?php

/**
  * Created by feyswal on 2/13/2023.
  * Time 12:49 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>


@extends("layouts.super_system")

@section("content")
    <div id="app">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="">Orodha ya vyombo vya moto</h2>
                        <button data-bs-toggle="modal" data-bs-target="#ongezaChomo" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajiri Chombo</button>
                        <label class="form-label  font-size-24" id="machagulio-mkoa"></label>
                        <label class="form-label font-size-24" id="machagulio-wilaya"></label>
                        <table id="datatable-viongoziWilayaTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <td>#</td>
                            <td>Jina Kutambulisha Chombo</td>
                            <th>Maka wa Chombo</th>
                            <th>Kundi</th>
                            <th>Aina</th>
                            <th>Model</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @php $motors = \App\Models\Motor::all(); @endphp
                                @foreach( $motors as $key => $motor )
                                        <tr>
                                            <td>{{ $motors->count() - $key }}</td>
                                            <td>{{ $motor->identity_name }}</td>
                                            <td>{{ $motor->year }}</td>
                                            <td>{{ $motor->motor_category->name }}</td>
                                            <td>{{ $motor->motor_type->name }}</td>
                                            <td>{{ $motor->motor_model->name }}</td>
                                            <td>
                                                <a href="{{ route('super.motor.orodhaServices', $motor->id) }}" class="btn btn-sm btn-success">fungua</a>
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
        <x-system.modal id="ongezaChomo" aria="orodhaTawiLabel" size="modal-fullscreen" title="Ongeza Chombo Hapa">
            <x-slot:content>
                <div v-bind:class="{'row': true, 'justify-content-center': true, 'd-none': !hideForm}">
                    <div class="col-md-3 col-sm-6">
                        <div class="spinner-grow text-dark" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <form method="post" action="#" v-on:submit.prevent="registerMotor" v-bind:class="{'d-none': hideForm }">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="mb-3 mb-4">
                                <label class="form-label" for="firstName">Jina la Utambulisho</label>
                                <input v-model:value="identityName" type="text" class="form-control" name="name" placeholder="">
                            </div>
                        </div>

                        <div v-bind:class="{'col-sm-12': true, 'col-md-4': true, 'col-lg-3': true, 'd-none': writeCategoryBool}">
                            <div class="mb-3 mb-4">motor
                                <label class="form-label" for="middleName">Kundi La Chombo</label>
                                <select class="form-control" name="motorCategory" v-model="motorCategory" v-on:change="motorCategoryChanges()">
                                    @foreach( App\Models\MotorCategory::all() as $category )
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div v-bind:class="{'col-sm-12': true, 'col-md-4': true, 'col-lg-3': true, 'd-none': !writeCategoryBool}">
                            <div class="mb-3 mb-4">
                                <label class="form-label" for="middleName">Andika Jina La Kundi La Chombo</label>
                                <input type="text" v-model="motorCategoryName" v-bind:class="{'form-control': true}">
                            </div>
                        </div>

                        <div v-bind:class="{'col-sm-12': true, 'col-md-4': true, 'col-lg-3': true, 'd-none': writeTypeBool}">
                            <div class="mb-3 mb-4">
                                <label class="form-label" for="middleName">Aina ya Chombo</label>
                                <select class="form-control" name="motorType" v-model="motorType" v-on:change="motorTypeChanges()">
                                        <option v-for="(type, index) in motorTypes" v-bind:value="type.id">@{{ type.name }}</option>
                                        <option value="0">Akuna kwenye Orodha</option>
                                </select>
                            </div>
                        </div>

                        <div v-bind:class="{'col-sm-12': true, 'col-md-4': true, 'col-lg-3': true, 'd-none': writeTypeBool}">
                            <div class="mb-3 mb-4">
                                <label class="form-label" for="middleName">Model ya Chombo</label>
                                <select class="form-control" name="motorModel" v-model:value="motorModel">
                                        <option v-for="(model, index) in motorModels" :key="index" v-bind:value="model.id">@{{ model.name }}</option>
                                </select>
                            </div>
                        </div>

                        <div v-bind:class="{'col-sm-12': true, 'col-md-4': true, 'col-lg-3': true , 'd-none': !writeTypeBool }">
                            <div class="mb-3 mb-4">
                                <label class="form-label" for="middleName">Andika Aina Ya Chombo</label>
                                <input type="text" name="typeName" class="form-control" v-model="type_name">
                            </div>
                        </div>

                        <div v-bind:class="{'col-sm-12': true, 'col-md-4': true, 'col-lg-3': true , 'd-none': !writeTypeBool }">
                            <div class="mb-3 mb-4">
                                <label class="form-label" for="middleName">Andika Model Ya Chombo</label>
                                <input type="text" name="modelName" class="form-control" v-model="model_name">
                            </div>
                        </div>

                        <div v-bind:class="{ 'col-sm-12': true, 'col-md-4':true, 'col-lg-3': true, 'd-none': writeOwner }">
                            <div class="mb-3 mb-4">
                                <label class="form-label" for="middleName">Mmiliki wa chombo</label>
                                <select class="form-control" name="owner" v-model="owner">
                                    <option v-for="(owner, index) in owners" :key="index" v-bind:value="owner.id">@{{ owner.name }}</option>
                                    <option value="0">Hakuna kwenye Orodha</option>
                                </select>
                            </div>
                        </div>

                        <div v-bind:class="{'col-sm-12':true, 'col-md-4':true, 'col-lg-3':true, 'd-none': !writeOwner}">
                            <div class="mb-3 mb-4">
                                    <label for="color">Andika Jina la mmiliki</label>
                                    <input type="text" name="owner" class="form-control" v-model="owner_name">
                            </div>
                        </div>

                        <div v-bind:class="{'col-sm-12':true, 'col-md-4':true, 'col-lg-3':true, 'd-none': !writeOwner}">
                            <div class="mb-3 mb-4">
                                <label for="color">Gender</label><br>
                                <label for="male">male</label>
                                <input type="radio"  name="gender" value="male" class="" v-model="gender" checked>
                                <label for="female">female</label>
                                <input type="radio" name="gender" value="female" class="" v-model="gender">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="mb-3 mb-4">
                                    <label for="color">Rangi ya Chombo</label>
                                    <input type="text" name="color" class="form-control" v-model="color">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="mb-3 mb-4">
                                <label for="color">Mwaka wa Kutengenezwa</label>
                                <input type="date" name="year" class="form-control" v-model="year">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <button type="submit" name="submit"  class="btn btn-primary btn-md">Ongeza</button>
                                <button type="button" v-bind:class="{'btn': true, 'btn-dark': true }" v-on:click="restartNew()">Anza Upya</button>
                            </div>
                        </div>
                    </div>
                </form>
            </x-slot:content>
        </x-system.modal>
    </div>
@endsection


@php
    $owners = \App\Models\Owner::all();
@endphp
@section("extra_script")
    <x-system.table-script id="datatable-viongoziWilayaTable" />
    <script>
        let app = new Vue({
            el: '#app',
            data(){
                return {
                    registerMotorRoute: "{!! route('super.motor.store') !!}",
                    motorType: '',
                    motorModel: '',
                    motorModels: [],

                    motorTypes: [],
                    writeTypes: [],
                    writeType: '',

                    writeTypeBool: false,

                    motorCategory: '',
                    motorCategoryName: '',

                    owners: {!! json_encode($owners) !!},
                    owner: '',

                    year: '',
                    color: '',

                    identityName: '',
                    type_name: '',
                    model_name: '',
                    owner_name: '',
                    gender: 'female',
                    hideForm: false,
                }
            },
            methods: {
                motorTypeChanges: function () {
                    const obj = this;
                    if (obj.motorType == 0) {
                        this.writeTypeBool = true;
                    } else {
                        axios.get(`/api/super/motor/type/getModels/${this.motorType}`)
                            .then(function (response) {
                                if (response.status == 200) {
                                    obj.motorModels = response.data;
                                }
                            });
                        this.writeTypeBool = false;
                    }
                },
                motorCategoryChanges: function() {
                    const obj = this;
                    axios.get(`/api/super/motor/category/getTypes/${obj.motorCategory}`)
                        .then(function(response){
                                obj.motorTypes = response.data;
                        })
                        .catch((error) => {
                            if ( error.response ){
                                console.log( error.response.status )
                            }else if ( error.request ){
                                console.log( error.response.request )
                            }else{
                                console.log( error.message)
                            }
                    });
                },
                restartNew: function() {
                    this.motorType = '';
                    this.motorModel = '';
                    this.motorCategory = '';
                    this.writeTypeBool = false;
                    this.writeCategoryBool = false;
                    this.owner = false;
                },
                registerMotor: function () {
                    const obj = this;
                    obj.hideForm = true;
                    axios.post(`${obj.registerMotorRoute}`, {
                        motorType: obj.motorType,
                        motorModel: obj.motorModel,
                        writeTypeBool: obj.writeTypeBool,
                        owner: obj.owner,
                        year: obj.year,
                        color: obj.color,
                        identityName: obj.identityName,
                        gender: obj.gender,
                        owner_name: obj.owner_name,
                        model_name: obj.model_name,
                        type_name: obj.type_name,
                        motorCategory: obj.motorCategory,
                        writeOwner: obj.writeOwner,
                    })
                        .then(function(response){
                            if ( response.data['status'] == 'fail' ){
                                alert( response.data['messages'][0] );
                                obj.hideForm = false;
                                location.reload();
                            }else {
                                alert('Chombo Kimesajiriwa');
                                location.reload();
                            }

                        })
                        .catch(function(error){
                            if ( error.response ){
                                console.log( error.response.status );
                                obj.hideForm = false;
                            }else if ( error.request ){
                                console.log( error.response.request );
                                obj.hideForm = false;
                            }else{
                                console.log( error.message);
                                obj.hideForm = false;
                            }
                        });
                },

            },
            mounted() {
//                $('.letterToLeader').on('change', () => {
//                    this.selectedSendToOptions = $('.letterToLeader').val();
//                    this.ziaraChange();
//                });
                console.log('the right things never goes astray')
            },
            computed: {
                writeOwner: function () {
                    return this.owner != '' && this.owner == '0';
                },
                writeCategoryBool: function() {
                    return this.motorCategory != '' && this.motorCategory < 1;
                }
            }
        });
    </script>
@endsection

