<?php
/**
 * Created by feyswal on 2/9/2023.
 * Time 5:19 PM.
 * EastCoders & G3NET.
 * contacts: +255 628 960 877
 */
?>


@extends('layouts.mbunge_system')

@section('content')
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
                                    <div class="flex-shrink-0"> <i
                                            class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
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
                                                <input type="number" class="form-control"
                                                    placeholder="+{{ $mbunge->leader->phone }}" v-model="nambaYaSimuMbunge"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="mb-4">
                                                <label class="form-label" for="billing-address">Yahusu</label>
                                                <input required class="form-control" v-model="yahusu">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="mb-4">
                                                <label class="form-label" for="billing-address">Wasilisha Changamoto</label>
                                                <textarea @keyup="changamotoChange()" class="form-control" rows="6" placeholder="Andika Hapa.."
                                                    v-model="changamoto"></textarea>
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
                                                        {{-- <img src="/assets/images/bunge.png" alt="" class="w-50 mx-auto"> --}}
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
                                                        <h5><b>YAH: </b>
                                                            @{{ yahusu }}
                                                        </h5>
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
                                                        <i>Mhe. {{ $mbunge->leader->firstName }}
                                                            {{ $mbunge->leader->lastName }}</i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <form method="POST" action="{{ route('mbunge.challenges.jaza') }}" id="withPdfForm"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="yahusu" v-model="yahusu">
                                    <div class="col-md-12 col-sm-12 my-2">
                                        <label for="" class="form-label">
                                            Ambatanisha (pdf)
                                            (Pdf yenye maelezo ya kuunga mkono barua yako**)
                                        </label>
                                        <input type="file" class="form-control" accept="application/pdf"
                                            name="pdfFile">
                                        @error('pdfFile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="from" value="chama">
                                    <input type="hidden" v-bind:value="changamoto" name="changamoto">
                                </form>
                                <form action="{{ route('generatePDF') }}" method="POST" target="_blank">
                                    @csrf
                                    <input type="hidden" v-bind:value="changamoto" name="changamoto">
                                    <input readonly="" type="hidden" name="firstName"
                                        value="{{ $mbunge->leader->firstName }}">
                                    <input readonly type="hidden" name="lastName"
                                        value="{{ $mbunge->leader->lastName }}">
                                    <button v-on:click="showContinueBtn()" type="submit"
                                        v-bind:class="{ btn: niButton, 'btn-dark': niButton, 'd-none': fichaPrint }">
                                        <i class="la la-print"></i>
                                        Print Barua
                                    </button>
                                </form>
                                <button type="submit" form="withPdfForm"
                                    v-bind:class="{ 'd-none': continueBtn,'my-3': niButton, 'btn': niButton, 'btn-primary': niButton, 'btn-block': niButton }">endelea
                                    >>></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- container-fluid -->
@endsection

@section('extra_script')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                yahusu: 'Changamoto za jimbo',
                changamoto: "{!! old('changamoto') !!}",
                continueBtn: true,
                route: '',
                jinaLaMbunge: "{!! $mbunge->name !!}",
                nambaYaSimuMbunge: '',
                fichaPrint: true,
                niButton: true,
                formPrintedHide: true,
                oldChangamoto: "{!! old('changamoto') !!}"
            },
            methods: {
                showContinueBtn() {
                    this.continueBtn = false;
                },
                nameChanges() {
                    console.log("The right ways are there...");
                },
                formChanged() {
                    console.log("the form is changebd a bit");
                },
                changamotoChange() {
                    this.fichaPrint = this.changamoto.trim().length < 1;
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
                if (this.oldChangamoto != '') {
                    this.continueBtn = false;
                }
                console.log("just get into it")
            }
        });
    </script>
@endsection
