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
                                                <input type="number" class="form-control" placeholder="+{{ $mbunge->leader->phone }}" v-model="nambaYaSimuMbunge" readonly>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="mb-4">
                                                <label class="form-label" for="billing-address">Wasilisha Changamoto</label>
                                                <textarea @keyup="changamotoChange()" class="form-control" rows="3" placeholder="Andika Hapa.." v-model="changamoto"></textarea>
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
                                                        {{--<img src="/assets/images/bunge.png" alt="" class="w-50 mx-auto">--}}
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
                                                        <i>_______</i>
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
                                <form action="{{  route('generatePDF') }}" method="POST" target="_blank">
                                    @csrf
                                    <input type="hidden" v-bind:value="changamoto" name="changamoto">
                                    <input readonly="" type="hidden" name="firstName" value="{{ $mbunge->leader->firstName }}">
                                    <input readonly type="hidden" name="lastName" value="{{ $mbunge->leader->lastName }}">
                                    <button type="submit"  v-bind:class="{ btn: niButton, 'btn-dark': niButton, 'd-none': fichaPrint }">
                                        <i class="la la-print"></i>
                                        Print Fomu
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <a href="" class="btn btn-primary btn-block">endelea >>></a>
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
                    changamoto: '',
                    route: '',
                    jinaLaMbunge: "{!! $mbunge->name !!}" ,
                    nambaYaSimuMbunge: '',
                    fichaPrint: true,
                    niButton: true,
                    formPrintedHide: true,
            },
            methods: {
                nameChanges(){
                    console.log("The right ways are there...");
                },
                formChanged(){
                    console.log("the form is changebd a bit");
                },
                changamotoChange(){
                    this.fichaPrint = this.changamoto.trim().length < 1;
                },
                printLetter() {
                    console.log( this.changamoto );
                },
            },
            computed: {
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