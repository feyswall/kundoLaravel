@extends('layouts.super_system')

@section('extra_style')
    <!-- include summernote css/js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css"
    integrity="sha256-IKhQVXDfwbVELwiR0ke6dX+pJt0RSmWky3WB2pNx9Hg=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>

@endsection

@section('content')
    <div class="container-fluid" id="app">
        <!-- start page title -->
        <div v-bind:class="{ 'd-none': false }">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Tuma Barua Hapa</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Changamoto</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div v-bind:class="{ 'row': true, 'justify-content-between' : true }">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <div class="custom-accordion">
                    <div class="card">
                        <div class="card-body">
                            <!-- create a receiver selection section -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                           <div class="row justify-content-start">
                                            <div class="col-sm-12 col-md-12">
                                                <form method="post" action="{{ route('super.sial.jaza') }}"
                                                    target="_blank" id="ziaraForm"
                                            enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-5">
                                                        <div class="mb-3">
                                                            <label class="form-label">Sehemu</label>
                                                            <div class="d-flex">
                                                                <select name="areaSelected" v-on:change="areaSelectedChange()"
                                                                    id="areaSelected" v-model="areaSelected" class="form-control">
                                                                    <option selected>chagua sehemu...</option>
                                                                    <option v-for="area in areasList"
                                                                        v-bind:value="area">@{{ area }}
                                                                    </option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div :class="{'col-lg-5': true, 'col-sm-12': true, 'd-none': hideArea }"
                                                        v-if="typeof(postsList) == 'object'">
                                                        <label class="form-label">chagua wadhifa</label>
                                                        <select name="wadhifa"
                                                            :class="{'form-control': true, 'postToSend': true, 'select2': true}">
                                                        <option selected>chagua wadhifa...</option>
                                                            <option v-for="(post, index) in postsList"
                                                                :key="index"
                                                                v-bind:value="post.id">
                                                                @{{ post.name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div id="checkout-billinginfo-collapse" class="collapse show">
                                                    <div class="p-4 border-top">
                                                        <div>
                                                            <div>
                                                                <input type="hidden" v-model="areaSelected" name="area">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                           </div>
                                            <div :class="{'col-sm-12': true,'col-lg-12': true, 'd-none': leadersList.length < 1}">
                                                <table id="leadersTable"
                                                    class="table table-sm table-striped table-bordered
                                                     table-responsive nowrap">
                                                    {{-- <tr>
                                                        <td colspan="2"></td>
                                                        <td colspan="2">
                                                            <label for="search">search</label>
                                                            <input id="search" type="text"
                                                                v-model="searchString"
                                                                v-change="searchChangeIn()"
                                                                class="form-control p-1" name="search">
                                                        </td>
                                                    </tr> --}}

                                                    <tr>
                                                        <th>#</th>
                                                        <th>Jina kamili</th>
                                                        <th>Simu:</th>
                                                        <th></th>
                                                    </tr>

                                                    <tbody>
                                                        <tr v-for="(leader, index) in trackLeadersList" :key="index">
                                                            <td>@{{ ++index }}</td>
                                                            <td>@{{ leader.firstName.toLowerCase() }} @{{ leader.lastName.toLowerCase( )}}</td>
                                                            <td>@{{ leader.phone }}</td>
                                                            <td>
                                                                <a :href="'/super/leader/ona/kiongozi/'+leader.id"
                                                                    class="btn btn-sm btn-success">
                                                                    fungua
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                           </div>
                                    </div>
                                    <!-- end select2 -->
                                </div>
                            </div>
                            <!-- create a  copy multiselector -->
                        </div>
                    </div>
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>
    <!-- container-fluid -->
@endsection

@section('extra_script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"
integrity="sha256-5slxYrL5Ct3mhMAp/dgnb5JSnTYMtkr4dHby34N10qw=" crossorigin="anonymous"></script>

    <script>
        var app = new Vue({
            el: '#app',
            data: {
                inButton: false,
                hideDom: false,
                hideArea: false,
                postSelected: '',
                postsList: [],
                areaSelected: '',
                areasList: ['mkoa', 'wilaya', 'halmashauri', 'tarafa', 'kata', 'tawi', 'shina', 'jimbo'],
                leadersList: [],
                trackLeadersList: [],
                searchString: '',
            },
            methods: {
                areaSelectedChange() {
                    let obj = this;
                    this.postsList = [];
                    this.hideArea = true;
                    axios.post(`/api/area/posts/search`, {'area': obj.areaSelected})
                        .then(function(response) {
                            let responseData = Array;
                            if (response.data) {
                                responseData = response.data;
                                if (responseData.status === 'success') {
                                    if (Array.isArray(responseData.response)) {
                                        obj.postsList = responseData.response;
                                        obj.hideArea = false;
                                    } else {
                                        alert("Kuna tatizo kwenye taarifa, Tafadhali jaribu Tena.")
                                        location.reload();
                                        }
                                } else {
                                    alert(responseData.message)
                                }
                            }
                        })
                        .catch(function(error) {
                            alert(error);
                        });
                },
                postSelectedChange() {
                    let obj = this;
                    this.leadersList = [];
                    axios.post(`/api/area/leaders/search`, {'postId': obj.postSelected})
                        .then(function(response) {
                            let responseData = Array;
                            if (response.data) {
                                responseData = response.data;
                                if (responseData.status === 'success') {
                                    if (Array.isArray(responseData.response)) {
                                        obj.leadersList = responseData.response;
                                        obj.trackLeadersList = obj.leadersList;
                                    } else {
                                        alert("Kuna tatizo kwenye taarifa, Tafadhali jaribu Tena.")
                                        location.reload();
                                        }
                                } else {
                                    alert(responseData.message)
                                }
                            }
                        })
                        .catch(function(error) {
                            alert(error);
                        });
                },
                searchChangeIn(){
                    if( this.searchString != null ){
                        let ldrs = this.leadersList.filter((leader) => {
                        let searchToLower = obj.searchString.toLowerCase();
                        let firstName = leader.firstName.toLowerCase();
                        let lastName = leader.lastName.toLowerCase();
                            var c1 = firstName.includes(searchToLower);
                            var c2 = lastName.includes(searchToLower);
                            var firstAndLastName = leader.firstName.toLowerCase() + leader.lastName.toLowerCase();
                            var c3 = firstAndLastName.includes(searchToLower);
                            return ( c1 || c2 || c3);
                            return true;
                        });
                        let currentLeadersList = [];
                        currentLeadersList = _.cloneDeep(ldrs);
                    }
                },
            },

            mounted() {
                const obj = this;
                $('.postToSend').on('change', () => {
                    this.postSelected = $('.postToSend').val();
                    obj.postSelectedChange();
                });

            }
        });
    </script>

@endsection

@section("extra_script")
    <x-system.table-script id="leadersTable" />
@endsection
