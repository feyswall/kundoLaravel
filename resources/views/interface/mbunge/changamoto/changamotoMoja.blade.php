<?php
/**
  * Created by feyswal on 2/9/2023.
  * Time 5:19 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>


@extends("layouts.mbunge_system")

@section("content")
    <div class="container-fluid" id="app">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Ukurasa wa Mbunge</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Changamoto</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row justify-content-between">
            <div class="col-xl-6 col-md-6 col-sm-12">
                <div class="custom-accordion">
                    <div class="card">

                        <a href="#checkout-billinginfo-collapse" class="text-dark" data-bs-toggle="collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i> </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Changamoto za Chama</h5>
                                        <!--                                                <p class="text-muted text-truncate mb-0">Sed ut perspiciatis unde omnis iste</p>-->
                                    </div>
                                    <div class="flex-shrink-0"> <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                </div>
                            </div>
                        </a>
                        <div id="checkout-billinginfo-collapse" class="collapse show">
                            <div class="p-4 border-top">
                                <form>
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-12" id="halmashauriInputDiv">
                                                <div class="mb-4 mb-lg-0">
                                                    <label class="form-label">Halmashauri</label>
                                                    <select class="form-control form-select" v-model="halmashauri" title="Country" onchange="halmashauriInputChange(event)">
                                                        <option value="">Chagua Halmashauri</option>
                                                        <option value="AF">Halmashari 1</option>
                                                        <option value="AL">Halmashauri 2</option>
                                                        <option value="DZ">Halmashauri 3</option>
                                                        <option value="AS">Halmashauri 4</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12" id="kitongojiInputDiv">
                                                <div class="mb-4 mb-lg-0">
                                                    <label class="form-label">Jimbo</label>
                                                    <select class="form-control form-select" v-model="jimbo" title="Country" onChange="kitongojiInputChange(event)">
                                                        <option value="">Chagua Jimbo</option>
                                                        <option value="AF">Jimbo 1</option>
                                                        <option value="AL">Jimbo 2</option>
                                                        <option value="DZ">Jimbo 3</option>
                                                        <option value="AS">Jimbo 4</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12" id="kataInputDiv">
                                                <div class="mb-4 mb-lg-0">
                                                    <label class="form-label">kata</label>
                                                    <select class="form-control form-select" v-model="kata" title="Country" onChange="kataInputChange(event)">
                                                        <option value="">Chagua Kata</option>
                                                        <option value="AF">Kata 1</option>
                                                        <option value="AL">Kata 2</option>
                                                        <option value="DZ">Kata 3</option>
                                                        <option value="AS">Kata 4</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12" id="mtaaInputDiv">
                                                <div class="mb-4 mb-lg-0">
                                                    <label class="form-label">Mtaa</label>
                                                    <select class="form-control form-select" title="Country" v-model="tawi" onchange="tawiInputChange(event)">
                                                        <option value="">Chagua Mtaa</option>
                                                        <option value="AF">Mtaa 1</option>
                                                        <option value="AL">Mtaa 2</option>
                                                        <option value="DZ">Mtaa 3</option>
                                                        <option value="AS">Mtaa 4</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $mbunge = \Illuminate\Support\Facades\Auth::user();
                                        @endphp
                                        <div class="row mt-md-5">
                                            <span class="lead">Taarifa za mbunge</span>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="" class="form-label">{{ $mbunge->name }}</label>
                                                <input type="text" class="form-control" v-model="jinaLaMbunge" readonly>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="" class="form-label">Namba ya simu ya mbunge</label>
                                                <input type="number" class="form-control" placeholder="eg: 0628 678 878" v-model="nambaYaSimuMbunge">
                                            </div>
                                        </div>

                                        <div class="row mt-md-5">
                                            <span class="lead">Taarifa za Mkuu Wa Wilaya</span>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="" class="form-label">Jina la Mkuu wa wilaya</label>
                                                <input type="text" class="form-control" v-model="jinaLaMKuuWilaya">
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="" class="form-label">Namba ya simu ya Mkuu wa Wilaya</label>
                                                <input type="number" class="form-control" placeholder="eg: 0628 678 878" v-model="nambaYaSimuMkuuWilaya">
                                            </div>
                                        </div>
                                        <div class="row mt-md-5">
                                            <span class="lead">Taarifa za Mkurugenzi</span>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="" class="form-label">Jina la Mkurugenzi</label>
                                                <input type="text" class="form-control" v-model="jinaLaMkurugenzi">
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="" class="form-label">Namba ya simu ya Mkurugenzi</label>
                                                <input type="number" class="form-control" placeholder="eg: 0628 678 878" v-model="nambaYaSimuMkurugenzi">
                                            </div>
                                        </div>
                                        <div class="row mt-md-5">
                                            <span class="lead">Taarifa za diwani</span>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="" class="form-label">Jina la Diwani</label>
                                                <input type="text" class="form-control" v-model="jinaLaDiwani">
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="" class="form-label">Namba ya simu ya Diwani</label>
                                                <input type="number" class="form-control" placeholder="eg: 0628 678 878" v-model="nambaYaSimuDiwani">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="mb-4">
                                                <label class="form-label" for="billing-address">Jaza Changamoto zilizopo katika eneo Hilo</label>
                                                <textarea @keyup="changamotoChange()" class="form-control" id="billing-address" rows="3" placeholder="Andika Hapa.." v-model="changamoto"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row my-4">

                </div>
                <!-- end row-->
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card shadow-none">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-2">
                                                        <img src="/assets/images/bunge.png" alt="" class="w-50 mx-auto">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row mt-3">
                                                    <div class="col-md-5 mt-4">
                                                        <address class="mini-text">
                                                            Eng. Kundo Andrea Mathew ,<br>
                                                            Naibu Waziri,<br>
                                                            Wizara Habari, Mawasiliano na Teknolojia ya Habari ,<br>
                                                            Dodoma- Magufuli City<br>
                                                        </address>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row justify-content-center">
                                                    <div class="col-sm-12 col-md-8 text-center">
                                                        <h5><b>Changamoto Za Chama</b></h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row justify-content-start">
                                                    <div class="col-sm-12 col-md-12">
                                                        <p style="line-height: 2;">
                                                            @{{ changamoto }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row justify-content-center">
                                                    <div class="col-sm-8 col-md-8 text-center">
                                                        Wako mtiifu katika ujenzi wa mawasiliano Bora katika Taifa
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row justify-content-center">
                                                    <div class="col-sm-8 col-md-4 text-center">
                                                        <i>___________________</i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row justify-content-center">
                                                    <div class="col-sm-6 col-md-4 text-center">
                                                        <i>Leonard Singoma</i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 d-none" >
                                                <div class="row justify-content-center" style="margin-top: 400px;">
                                                    <div class="col-sm-6 col-md-4 text-center">
                                                        <i>Leonard Singoma</i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <a v-on:click.stop.prevent="printInvoice('printable-proforma')" v-bind:class="{ btn: niButton, 'btn-dark': niButton, 'd-none': fichaPrint }"><i class="la la-print"></i> Print Fomu</a>
                            </div>
                        </div>
                    </div>
                </div>
                <A HREF="formKwenyeQueue.php" class="btn btn-primary btn-block">endelea >>></A>
            </div>
        </div>

    </div>
    <!-- container-fluid -->
    @endsection

@section("extra_script")

    <script>
        var app = new Vue({
            el: '#app',
            data: {
                    name: '',
                    mkoa: '',
                    wilaya: '',
                    halmashauri: '',
                    jimbo: '',
                    kata: '',
                    tawi: '',
                    jinaLaMbunge: "{!! $mbunge->name !!}",
                    nambaYaSimuMbunge: '',
                    jinaLaMkuuWilaya: '',
                    nambaYaSimuMkuuWilaya: '',
                    jinaLaMkurugenzi: '',
                    nambaYaSimuMkurugenzi: '',
                    jinaLaDiwani: '',
                    nambaYaSimuDiwani: '',
                    changamoto: '',
                    fichaPrint: true,
                    niButton: true,
                    formPrintedHide: true,
            },
            methods: {
                nameChanges: function(){
                    console.log("The right ways are there...");
                },
                formChanged: function () {
                    console.log("the form is changebd a bit");
                },
                changamotoChange: function () {
                    this.fichaPrint = this.changamoto.trim().length < 1;
                },
                printInvoice: function (id) {
                    var element = document.getElementById(id);
                    var opt = {
                        margin: [0.3, 0.3, 0.3, 0.8],
                        filename: 'myfile.pdf',
                        image: {
                            type: 'jpeg',
                            quality: 2,
                        },
                        html2canvas: {
                            scale: 1
                        },
                        jsPDF: {
                            unit: 'cm',
                            format: 'letter',
                            orientation: 'portrait'
                        }
                    };
                    html2pdf().set(opt).from(element).save();
                    // Sho print button
                    this.formPrintedHide = false;
                },
            },
            computed: {
                formText(){
                    return "just is my name";
                },
                muunganoWaData(){
                    return "there";
                },
                modelBtn: function () {
                    return {
                        btn:  true,
                        'btn-primary':  true,
                        'd-none': this.formPrintedHide,
                    }
                }
            },
            mounted(){
                console.log("just get into it")
            }
        });
    </script>
@endsection