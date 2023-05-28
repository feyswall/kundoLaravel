@extends('layouts.super_system')

@section('extra_style')
    <!-- include summernote css/js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css"
    integrity="sha256-IKhQVXDfwbVELwiR0ke6dX+pJt0RSmWky3WB2pNx9Hg=" crossorigin="anonymous">
@endsection

@section('content')
    <div class="container-fluid" id="app">
        <!-- start page title -->
        <div v-bind:class="{ 'row': niButton, 'd-none': false }">
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

        <div v-bind:class="{ 'row': true, 'justify-content-between' : true, 'd-none': hideDom }">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <div class="custom-accordion">
                    <div class="card">
                        <div class="card-body">
                            <div class="p-5">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div v-bind:class="{ 'row': true, 'justify-content-between' : true, 'd-none': !hideDom }">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <div class="custom-accordion">
                    <div class="card">

                        <div class="card-body">
                            <!-- create a receiver selection section -->
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
                                                        <label class="form-label">Mikoa</label>
                                                        @php
                                                            $regions = \App\Models\Region::all();
                                                        @endphp
                                                        <div class="d-flex">
                                                            <select name="region" v-on:change="regionChange()"
                                                                id="region" v-model="region" class="form-control">
                                                                <option v-for="region in collection.regions"
                                                                    v-bind:value="region.id" selected>@{{ region.name }}
                                                                </option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="col-lg-3" v-if="districts.length > 0">
                                                    <div class="mb-3">
                                                        <label class="form-label">Wilaya</label>
                                                        <div class="d-flex">
                                                            {{-- <a :href="'/super/areas/district/orodha'" class="btn btn-primary btn-sm">fungua</a> --}}
                                                            <select name="district" v-on:change="districtChange()"
                                                                id="district" v-model="district" class="form-control">
                                                                <option v-for="district in districts"
                                                                    v-bind:value="district.id" selected>
                                                                    @{{ district.name }}</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="col-lg-3" v-if="councils.length > 0">
                                                    <div class="mb-3">
                                                        <label class="form-label">Halmashauri</label>
                                                        <div class="d-flex">
                                                            {{-- <a :href="'/super/areas/council/orodha/'+ district" class="btn btn-primary btn-sm">fungua</a> --}}
                                                            <select name="council" id="council" v-model="council"
                                                                class="form-control" v-on:change="councilOnChange()">
                                                                <option v-for="council in councils"
                                                                    v-bind:value="council.id" selected>
                                                                    @{{ council.name }}</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="col-lg-3" v-if="divisions.length > 0">
                                                    <div class="mb-3">
                                                        <label class="form-label">Tarafa</label>
                                                        <div class="d-flex">
                                                            {{-- <a :href="'/super/areas/division/orodha/'+ council" class="btn btn-primary btn-sm">fungua</a> --}}
                                                            <select name="division" id="division" v-model="division"
                                                                class="form-control" v-on:change="divisionOnChange()">
                                                                <option v-for="division in divisions"
                                                                    v-bind:value="division.id" selected>
                                                                    @{{ division.name }}</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="col-lg-3" v-if="wards.length > 0">
                                                    <div class="mb-3">
                                                        <label class="form-label">Kata</label>
                                                        <div class="d-flex">
                                                            {{-- <a :href="'/super/areas/ward/orodha/'+ division" class="btn btn-primary btn-sm">fungua</a> --}}
                                                            <select name="ward" id="ward" v-model="ward"
                                                                class="form-control" v-on:change="wardOnChange()">
                                                                <option v-for="ward in wards" v-bind:value="ward.id"
                                                                    selected>@{{ ward.name }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-lg-3" v-if="branches.length > 0">
                                                    <label class="form-label">Matawi</label>
                                                    <select name="branch" id="branch" v-model="branch"
                                                        class="form-control select2" v-on:change="branchOnChange()">
                                                        <optgroup>
                                                            <option class="text-dark" v-for="branch in branches"
                                                                v-bind:value="branch.id">@{{ branch.name }}</option>
                                                        </optgroup>
                                                    </select>
                                                </div>

                                                <div class="col-lg-12 mt-5" v-if="typeof(leaders) == 'object'">
                                                    <label class="form-label">Tuma Barua Kwa -
                                                        @{{ areaSelected }}</label>
                                                    <select name="sendTo[]"  multiple="multiple"
                                                     class="form-control letterToLeader select2">
                                                        <optgroup v-for="(leaderArray, index) in leaders"
                                                            :key="index" v-bind:label="index">
                                                            <option v-for="(leader, index) in leaderArray"
                                                                :key="index"
                                                                v-bind:value="leader.leader.id+','+leader.post.id">
                                                                @{{ leader.leader.firstName }} @{{ leader.leader.lastName }} -
                                                                <b>@{{ leader.post.name }}</b>
                                                            </option>
                                                        </optgroup>
                                                    </select>
                                                </div>


                                                <div class="col-lg-12 mt-5" v-if="typeof(leaders) == 'object'">
                                                    <label class="form-label">Tuma Nakala Kwa -
                                                        @{{ areaSelected }}</label>
                                                    <select
                                                        name="copyTo[]"
                                                        class="form-control letterCopyToLeader select2 select2-multiple"
                                                        multiple="multiple">
                                                        <optgroup v-for="(leaderArray, index) in leaders"
                                                            :key="index" v-bind:label="index">
                                                            <option v-for="(leader, index) in leaderArray"
                                                                :key="index"
                                                                v-bind:value="leader.leader.id+','+leader.post.id">
                                                                @{{ leader.leader.firstName }} @{{ leader.leader.lastName }} -
                                                                <b>@{{ leader.post.name }}</b>
                                                            </option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <a href="#checkout-billinginfo-collapse" class="text-dark" data-bs-toggle="collapse">
                                                <div class="p-4">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i>
                                                        </div>
                                                        <div class="flex-shrink-0"> <i
                                                            class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div id="checkout-billinginfo-collapse" class="collapse show">
                                                <div class="p-4 border-top">
                                                    <div>
                                                        <div class="row mt-4">
                                                            <div class="mb-4">
                                                                <label class="form-label" for="billing-address">Yahusu</label>
                                                                <input name="title" required class="form-control" v-model="yahusu">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="mb-4">
                                                                <label class="form-label" for="billing-address">Wasilisha
                                                                    Changamoto</label>
                                                                <textarea class="summernoteTwo" id="content" name="content" v-on:change="ziaraChange()" class="form-control" rows="6" v-model="ziara"></textarea>
                                                            </div>
                                                        </div>
                                                        <button type="submit" name="btn"  value="send"
                                                                v-on:click.prevent="sendFormSubmit()"
                                                                v-bind:class="{ btn: niButton, 'btn-dark': niButton, 'd-none': fichaTumaBtn }">
                                                            <i class="la la-print"></i>
                                                            Tuma
                                                        </button>
                                                        <button type="submit" name="btn"  value="test"
                                                                v-on:click.prevent="testFormSubmit()"
                                                                v-bind:class="{ btn: niButton, 'btn-warning': niButton, 'd-none': fichaTumaBtn }">
                                                            <i class="la la-print"></i>
                                                            jaribu
                                                        </button>
                                                        <div>
                                                            <input type="hidden" v-model="JSON.stringify(areaToSend)" name="area">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                </div>
                                <!-- end select2 -->
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
        $(document).ready(function() {
            $('.summernoteOne').summernote({
                height: 100,
                focus: true,
                toolbar: [
                    ['font', ['bold']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen']],
                ],
            });

            $('.summernoteTwo').summernote({
                height: 400,
                focus: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['picture', 'hr']],
                    ['view', ['fullscreen']],
                ],
            });

            $('.summernoteThree').summernote({
                height: 200,
                focus: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['hr']],
                    ['view', ['fullscreen']],
                ],
            });

        });
    </script>
    <script>
        var app = new Vue({
            el: '#app',
            data: {

                yahusu: 'Kuhusu Ziara Yangu',
                ziara: "{!! old('ziara') !!}",
                continueBtn: true,
                route: '',
                jinaLaMbunge: "",
                nambaYaSimuMbunge: '',
                fichaTumaBtn: true,
                niButton: true,
                formPrintedHide: true,
                oldChangamoto: "{!! old('ziara') !!}",

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
                leaders: [],

                areaSelected: '',
                areaToSend: {},
                selectedSendToOptions: '',
                selectedCopyToOption: [],

                collection: {
                    regions: {!! $regions !!},
                    councils: Object,
                    Divisions: Object,
                    wards: Object,
                },
                items: [{
                    name: 'feyswall chambila'
                }],
                hideDom: true,
            },
            watch: {
                districts: {
                    handler(newValue, oldValue) {
                    },
                    deep: true
                }
            },
            methods: {
                nameChanges() {
                },
                formChanged() {
                },
                testFormSubmit(){
                   let form = $("#ziaraForm");
                   $(form).attr('target', '_blank');
                   form.submit();
                },
                sendFormSubmit(){
                    let form = $("#ziaraForm");
                    $(form).attr('target', '_self');
                    let input = "<input name='btn' value='send' type='hidden'>";
                    $(form).append( input );
                    form.submit();
                },
                ziaraChange() {
                    if (this.selectedCopyToOption.length > 0 && this.selectedSendToOptions.length > 0) {
                        this.fichaTumaBtn = this.ziara.trim().length < 1;
                    } else {
                        this.fichaTumaBtn = true;
                    }
                },

                regionChange() {
                    let obj = this;
                    this.districts = [];
                    this.councils = [];
                    this.divisions = [];
                    this.wards = [];
                    this.branches = [];
                    this.leaders = [];
                    axios.get(`/api/super/areas/wilaya/orodha/${this.region}`)
                        .then(function(response) {
                            let responseData = Array;
                            if (response.data) {
                                responseData = response.data;
                                if (responseData.status === 'success') {
                                    if (Array.isArray(responseData.response)) {
                                        obj.leaders = responseData.leaders;
                                        obj.districts = responseData.response;
                                        obj.areaSelected = `Mkoa - ${responseData.region.name}`;
                                        obj.areaToSend = {
                                            'area': 'mkoa',
                                            'id': responseData.region.id
                                        };
                                    } else {
                                        alert("Kuna tatizo kwenye taarifa, Tafadhali jaribu Tena.")
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

                districtChange() {
                    let obj = this;
                    this.councils = [];
                    this.divisions = [];
                    this.wards = [];
                    this.branches = [];
                    this.leaders = [];
                    axios.get(`/api/super/areas/halmashauri/orodha/${this.district}`)
                        .then(function(response) {
                            let responseData = Array;
                            if (response.data) {
                                responseData = response.data;
                                if (responseData.status === 'success') {
                                    if (Array.isArray(responseData.response)) {
                                        obj.councils = responseData.response;
                                        obj.leaders = responseData.leaders;
                                        obj.areaSelected = `Wilaya - ${responseData.district.name}`;
                                        obj.areaToSend = {
                                            'area': 'wilaya',
                                            'id': responseData.district.id
                                        };
                                    } else {
                                        alert("Kuna tatizo kwenye taarifa, Tafadhali jaribu Tena.")
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

                councilOnChange() {
                    let obj = this;
                    this.divisions = [];
                    this.wards = [];
                    this.branches = [];
                    this.leaders = [];
                    axios.get(`/api/super/areas/tarafa/orodha/${this.council}`)
                        .then(function(response) {
                            let responseData = Array;
                            if (response.data) {
                                responseData = response.data;
                                if (responseData.status === 'success') {
                                    if (Array.isArray(responseData.response)) {
                                        obj.divisions = responseData.response;
                                        obj.leaders = responseData.leaders;
                                        obj.areaSelected = `Halmashauri - ${responseData.council.name}`;
                                        obj.areaToSend = {
                                            'area': 'halmashauri',
                                            'id': responseData.council.id
                                        };
                                    } else {
                                        alert("Kuna tatizo kwenye taarifa, Tafadhali jaribu Tena.")
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

                divisionOnChange() {
                    let obj = this;
                    this.wards = [];
                    this.branches = [];
                    this.leaders = [];
                    axios.get(`/api/super/areas/kata/orodha/${this.division}`)
                        .then(function(response) {
                            let responseData = Array;
                            if (response.data) {
                                responseData = response.data;
                                if (responseData.status === 'success') {
                                    if (Array.isArray(responseData.response)) {
                                        obj.wards = responseData.response;
                                        obj.leaders = responseData.leaders;
                                        obj.areaSelected = `Tarafa - ${responseData.division.name}`;
                                        obj.areaToSend = {
                                            'area': 'tarafa',
                                            'id': responseData.division.id
                                        };
                                    } else {
                                        alert("Kuna tatizo kwenye taarifa, Tafadhali jaribu Tena.")
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

                wardOnChange() {
                    let obj = this;
                    this.branches = [];
                    this.leaders = [];
                    axios.get(`/api/super/areas/tawi/orodha/${this.ward}`)
                        .then(function(response) {
                            let responseData = Array;
                            if (response.data) {
                                responseData = response.data;
                                if (responseData.status === 'success') {
                                    if (Array.isArray(responseData.response)) {
                                        obj.branches = responseData.response;
                                        obj.leaders = responseData.leaders;
                                        obj.areaSelected = `Kata - ${responseData.ward.name}`;
                                        obj.areaToSend = {
                                            'area': 'kata',
                                            'id': responseData.ward.id
                                        };
                                    } else {
                                        alert("Kuna tatizo kwenye taarifa, Tafadhali jaribu Tena.")
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

                branchOnChange() {
                    let obj = this;
                    this.leaders = [];
                    axios.get(`/api/super/areas/tawi/badirishwa/${this.branch}`)
                        .then(function(response) {
                            let responseData = Array;
                            if (response.data) {
                                responseData = response.data;
                                if (responseData.status === 'success') {
                                    if (true) {
                                        obj.leaders = responseData.leaders;
                                        obj.areaSelected = `Tawi - ${responseData.branch.name}`;
                                        obj.areaToSend = {
                                            'area': 'tawi',
                                            'id': responseData.branch.id
                                        };
                                    } else {
                                        alert("Kuna tatizo kwenye taarifa, Tafadhali jaribu Tena.")
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

                submitSial() {
                    const obj = this;
                    obj.hideDom = false;
                    axios.post(`/super/ziara/jaza`, {
                            yahusu: this.yahusu,
                            selectedSendToOptions: this.selectedSendToOptions,
                            ziara: this.ziara,
                            selectedCopyToOptions: this.selectedCopyToOption,
                            area: this.areaToSend,
                        })
                        .then(function(response) {
                            let responseData = Array;
                            if (response.data) {
                                responseData = response.data;
                                if (responseData.status === 'success') {
                                    if (true) {
                                        alert('Barua Imetumwa');
                                        location.href = `/super/ziara/fungua/${responseData.sialId}`;
                                    } else {
                                        obj.hideDom = true;
                                        alert("Kuna tatizo kwenye taarifa, Tafadhali jaribu Tena.")
                                    }
                                } else {
                                    obj.hideDom = true;
                                    alert(responseData.message)
                                }
                            }
                        })
                        .catch(function(error) {
                            obj.hideDom = true;
                            alert(error);
                        })
                        .then(() => {

                        })
                },
            },
            computed: {
                modelBtn: function() {
                    return {
                        btn: true,
                        'btn-primary': true,
                        'd-none': this.formPrintedHide,
                    }
                }
            },
            mounted() {
                const obj = this;
                if (this.oldChangamoto != '') {
                    this.continueBtn = false;
                }
                $('.letterToLeader').on('change', () => {
                    this.selectedSendToOptions = $('.letterToLeader').val();
                    this.ziaraChange();
                });

                var textArea = $('#content').on('summernote.change', () => {
                    var content = $('#content').summernote('code');
                    console.log( content );
                    this.ziara = content;
                    this.ziaraChange();
                });


                $('.letterCopyToLeader').on('change', () => {
                    this.selectedCopyToOption = $('.letterCopyToLeader').val();
                    this.ziaraChange();
                });

                $(document).ready(function() {
                    const sumNote = $('#ziaraId');
                    sumNote.on('keyup', function() {
                        var content = sumNote.summernote('code');
                    });
                });

                $('#ziaraId').on('keyup', function() {
                    console.log('changes are just been made in there')
                });
            }
        });
    </script>


@endsection
