<?php
/**
  * Created by feyswal on 2/1/2023.
  * Time 12:13 PM.
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

                </div>
            </div>
        </div>
    </div>

    <div class="row" id="app">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Mikoa</label>
                                    @php
                                        $regions = \App\Models\Region::all();
                                    @endphp
                                    <div class="d-flex">
                                        <select name="region" v-on:change="regionChange()" id="region" v-model="region" class="form-control">
                                            <option v-for="region in collection.regions" v-bind:value="region.id" selected>@{{ region.name }}</option>
                                        </select>
                                    </div>

                                </div>
                            </div>


                            <div class="col-lg-3" v-if="districts.length > 0">
                                <div class="mb-3">
                                    <label class="form-label">Wilaya</label>
                                    <div class="d-flex">
                                        <a :href="'/assistants/areas/district/orodha'" class="btn btn-primary btn-sm">fungua</a>
                                        <select name="district" v-on:change="districtChange()" id="district" v-model="district" class="form-control">
                                            <option v-for="district in districts" v-bind:value="district.id" selected>@{{ district.name }}</option>
                                        </select>
                                    </div>

                                </div>
                            </div>


                            <div class="col-lg-3" v-if="councils.length > 0">
                                <div class="mb-3">
                                    <label class="form-label">Halmashauri</label>
                                    <div class="d-flex">
                                        <a :href="'/assistants/areas/council/orodha/'+ district" class="btn btn-primary btn-sm">fungua</a>
                                        <select name="council" id="council" v-model="council" class="form-control" v-on:change="councilOnChange()">
                                            <option v-for="council in councils" v-bind:value="council.id" selected>@{{ council.name }}</option>
                                        </select>
                                    </div>

                                </div>
                            </div>


                            <div class="col-lg-3" v-if="divisions.length > 0">
                                <div class="mb-3">
                                    <label class="form-label">Tarafa</label>
                                    <div class="d-flex">
                                        <a :href="'/assistants/areas/division/orodha/'+ council" class="btn btn-primary btn-sm">fungua</a>
                                        <select name="division" id="division" v-model="division" class="form-control" v-on:change="divisionOnChange()">
                                            <option v-for="division in divisions" v-bind:value="division.id" selected>@{{ division.name }}</option>
                                        </select>
                                    </div>

                                </div>
                            </div>


                            <div class="col-lg-3" v-if="wards.length > 0">
                                <div class="mb-3">
                                    <label class="form-label">Kata</label>
                                    <div class="d-flex">
                                        <a :href="'/assistants/areas/ward/orodha/'+ division" class="btn btn-primary btn-sm">fungua</a>
                                        <select name="ward" id="ward" v-model="ward" class="form-control" v-on:change="wardOnChange()">
                                            <option v-for="ward in wards" v-bind:value="ward.id" selected>@{{ ward.name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </form>

                </div>

            </div>
            <!-- end select2 -->
            <div class="card">
                <div class="card-body">
                    <div class="col-12" v-if="branches.length > 0">
                        <table id="orodhaEneoTable"  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Jina la Tawi</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="branch in branches">
                                <td>@{{ branch.name }}</td>
                                <td>
                                    <a :href="'/assistants/areas/branch/fungua/' + branch.id" class="btn btn-primary">fungua</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end row -->


@endsection

@section("extra_script")
    <script>
        const app = new Vue({
            el: "#app",

            data() {
                return {
                    region: '',
                    district: '',
                    council: '',
                    division: '',
                    ward: '',
                    branch: '',


                    districts: [],
                    councils: [],
                    divisions: [],
                    wards: [],
                    branches: [],

                    collection: {
                        regions:  {!! $regions !!},
                        councils: Object,
                        Divisions: Object,
                        wards: Object,
                    },
                    items: [
                        {name: 'feyswall chambila'}
                    ],
                };
            },

            watch: {
                districts: {
                    handler(newValue, oldValue) {

                    },
                    deep: true
                }
            },

            methods: {
                regionChange(){
                    let obj = this;
                    this.districts = [];
                    this.councils = [];
                    this.divisions = [];
                    this.wards = [];
                    this.branches = [];

                    axios.get(`/api/super/areas/wilaya/orodha/${this.region}`)
                        .then(function (response) {
                        let responseData = Array;
                            if ( response.data ){
                                responseData = response.data;
                             if ( responseData.status === 'success' ){
                                 if  ( Array.isArray(responseData.response) ){
                                     obj.districts = responseData.response;
                                 }else{
                                     alert("Kuna tatizo kwenye taarifa, Tafadhali jaribu Tena.")
                                 }
                             }else{
                                 alert( responseData.message )
                             }
                            }
                        })
                        .catch(function (error) {
                            alert(error);
                    });
                },
                districtChange(){
                    let obj = this;
                    this.councils = [];
                    this.divisions = [];
                    this.wards = [];
                    this.branches = [];
                    axios.get(`/api/super/areas/halmashauri/orodha/${this.district}`)
                        .then(function (response) {
                            let responseData = Array;
                            if ( response.data ){
                                responseData = response.data;
                                if ( responseData.status === 'success' ){
                                    if  ( Array.isArray(responseData.response) ){
                                        obj.councils = responseData.response;
                                        console.log("complete")
                                    }else{
                                        alert("Kuna tatizo kwenye taarifa, Tafadhali jaribu Tena.")
                                    }
                                }else{
                                    alert( responseData.message )
                                }
                            }
                        })
                        .catch(function (error) {
                            alert(error);
                        });
                },
                councilOnChange() {
                    let obj = this;
                    this.divisions = [];
                    this.wards = [];
                    this.branches = [];
                    axios.get(`/api/super/areas/tarafa/orodha/${this.council}`)
                        .then(function (response) {
                            let responseData = Array;
                            if ( response.data ){
                                responseData = response.data;
                                if ( responseData.status === 'success' ){
                                    if  ( Array.isArray(responseData.response) ){
                                        obj.divisions = responseData.response;
                                    }else{
                                        alert("Kuna tatizo kwenye taarifa, Tafadhali jaribu Tena.")
                                    }
                                }else{
                                    alert( responseData.message )
                                }
                            }
                        })
                        .catch(function (error) {
                            alert(error);
                        });
                },
                divisionOnChange() {
                    let obj = this;
                    this.wards = [];
                    this.branches = [];
                    axios.get(`/api/super/areas/kata/orodha/${this.division}`)
                        .then(function (response) {
                            let responseData = Array;
                            if ( response.data ){
                                responseData = response.data;
                                if ( responseData.status === 'success' ){
                                    if  ( Array.isArray(responseData.response) ){
                                        obj.wards = responseData.response;
                                    }else{
                                        alert("Kuna tatizo kwenye taarifa, Tafadhali jaribu Tena.")
                                    }
                                }else{
                                    alert( responseData.message )
                                }
                            }
                        })
                        .catch(function (error) {
                            alert(error);
                        });
                },
                wardOnChange() {
                    let obj = this;
                    this.branches = [];
                    axios.get(`/api/super/areas/tawi/orodha/${this.ward}`)
                        .then(function (response) {
                            let responseData = Array;
                            if ( response.data ){
                                responseData = response.data;
                                if ( responseData.status === 'success' ){
                                    if  ( Array.isArray(responseData.response) ){
                                        obj.branches = responseData.response;
                                        console.log( obj.branches );
                                    }else{
                                        alert("Kuna tatizo kwenye taarifa, Tafadhali jaribu Tena.")
                                    }
                                }else{
                                    alert( responseData.message )
                                }
                            }
                        })
                        .catch(function (error) {
                            alert(error);
                        });
                }
            }
        });
    </script>
    <x-system.table-script id="orodhaEneoTable" />
@endsection
