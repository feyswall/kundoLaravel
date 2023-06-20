@extends('layouts.super_system')

@section('extra_style')
    <!-- include summernote css/js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css"
    integrity="sha256-IKhQVXDfwbVELwiR0ke6dX+pJt0RSmWky3WB2pNx9Hg=" crossorigin="anonymous">
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
                                            <form method="post" action="{{ route('super.sial.jaza') }}"
                                                  target="_blank" id="ziaraForm"
                                             enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-3">
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

                                                    <div class="col-lg-12" v-if="typeof(postsList) == 'object'">
                                                        <label class="form-label">chagua wadhifa</label>
                                                        <select name="wadhifa"
                                                         class="form-control postToSend select2">
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
                                    <!-- end select2 -->
                                </div>

                                <div class="{'col-lg-12': true}">
                                    <table id="leadersTable"
                                    class="table table-striped table-bordered dt-responsive nowrap"
                                     style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jina kamili</th>
                                            <th>Simu:</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(leader, index) in leadersList" :key="index">
                                                <td>@{{ ++index }}</td>
                                                <td>@{{ leader.firstName }} @{{ leader.lastName}}</td>
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
                postSelected: '',
                postsList: [],
                areaSelected: '',
                areasList: ['mkoa', 'wilaya', 'halmashauri', 'tarafa', 'kata', 'tawi', 'shina', 'jimbo'],
                leadersList: []
            },
            methods: {
                areaSelectedChange() {
                    let obj = this;
                    this.postsList = [];
                    axios.post(`/api/area/posts/search`, {'area': obj.areaSelected})
                        .then(function(response) {
                            let responseData = Array;
                            if (response.data) {
                                responseData = response.data;
                                console.log( responseData );
                                console.log( obj.areaSelected );
                                console.log( obj.postSelected );
                                if (responseData.status === 'success') {
                                    if (Array.isArray(responseData.response)) {
                                        obj.postsList = responseData.response;
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
                    console.log('area is selected');
                },
                postSelectedChange() {
                    console.log('change');
                    let obj = this;
                    this.leadersList = [];
                    axios.post(`/api/area/leaders/search`, {'postId': obj.postSelected})
                        .then(function(response) {
                            let responseData = Array;
                            if (response.data) {
                                responseData = response.data;
                                console.log( responseData );
                                console.log( obj.postSelected );
                                if (responseData.status === 'success') {
                                    if (Array.isArray(responseData.response)) {
                                        obj.leadersList = responseData.response;
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
                    console.log('area is selected');
                },
            },

            mounted() {
                const obj = this;
                $('.postToSend').on('change', () => {
                    this.postSelected = $('.postToSend').val();
                    console.log(obj.postSelected);
                    obj.postSelectedChange();
                });

            }
        });
    </script>

@endsection

@section("extra_script")
    <x-system.table-script id="leadersTable" />
@endsection
