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
 <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Changamoto</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <span><a type="button" id="view-pdf-btn" onclick="previewFile()"  class="btn btn-dark float-end mt-lg-3 mt-sm-2"><i class="la la-print"></i>Fungua PDF</a></span>
                            </div>
                            <div class="card-body">
                                <div class="invoice-title">
                                    <div class="mb-4">
                                    </div>
                                    <div class="text-muted"> 
                                            <div class="row justify-content-center">
                                                <div class="col-md-4 col-sm-12">
                                                    <h3 class="lead">Mkoa: <span class="font-italic">Dar-Es-Salaam</span></h3>
                                                    <h3 class="lead">Wilaya: <span class="font-italic">Temeke</span></h3>
                                                    <h3 class="lead">Jimbo: <span class="font-italic">Temeke Juu</span></h3>
                                                    <h3 class="lead">Jina la Mbunge: <span>Ramadhani</span></h3>
                                                    <h3 class="lead">Simu ya Mbunge: <span class="font-italic">0677777888</span></h3>

                                                </div>
                                              {{--   <div class="col-md-4 col-sm-12">
                                                    <h3 class="lead">Jina la Mkurugenzi: <span class="font-italic">Jumanne</span></h3>
                                                    <h3 class="lead">Simu ya Mkurugenzi: <span class="font-italic">0677777888</span></h3>
                                                    <h3 class="lead">Jina la mkuu wa Wilaya: <span class="font-italic">Kijembe</span></h3>
                                                    <h3 class="lead">Simu ya Mkuu wa wilaya: <span class="font-italic">0677777888</span></h3>
                                                    <h3 class="lead">Jina la Diwani: <span>Ramadhani</span></h3>
                                                    <h3 class="lead">Simu ya Diwani: <span class="font-italic">0677777888</span></h3>
                    
                                                </div> --}}
                                            </div>                            
                                        <div class="row justify-content-center">
                                            <div class="col-10">
                                                <div class="row justify-content-center" >
                                                    <div class="col-md-10 col-sm-12">
                                                        <div class="card shadow-none">
                                                            <div class="card-body">
                                                                <div class="row justify-content-center">
                                                                    <div class="col col-md-3">
                                                                        <img src="/assets/images/bunge.png" alt="" class="w-100 mx-auto">
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

                                                                <div class="col-12 mt-3">
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-sm-12 col-md-8 text-center">
                                                                            <h5><b>Changamoto Za Chama</b></h5>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-12">
                                                                    <div class="row justify-content-start">
                                                                        <div class="col-sm-12 col-md-12">
                                                                            <p>
                                                                               
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row justify-content-center mt-n3">
                                                                    <div class="col-sm-8 col-md-8 text-center">
                                                                        *Wako mtiifu katika ujenzi wa mawasiliano Bora katika Taifa
                                                                    </div>
                                                                </div>

                                                                <div class="row justify-content-center mt-n3">
                                                                    <div class="col-sm-6 col-md-4 text-center">
                                                                        <i>Leonard Singoma</i>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3 mb-3">
                                                <div class="row justify-content-center">

                                                    @foreach( $challenge->leader->user->assets as $pdf )

                                                            @if( \Illuminate\Support\Facades\Storage::exists("pdfs/$pdf->url"))
                                                            {{--<a>{{ \Illuminate\Support\Facades\Storage::download("pdfs/$pdf->url") }} pakua</a>--}}
                                                            @endif

                                                    <div class="col-md-3 col-sm-4">
                                                        <img src="{{ asset('assets/images/pdf.png') }}" class="card-img-top mx-auto w-50" alt="">
                                                        <form action="{{ route('downloadPDF') }}" method="post" target="_blank">
                                                            @csrf
                                                            <input type="hidden" value="{{ 'pdfs/'.$pdf->url }}" name="pdf">
                                                            <button class="btn btn-primary" type="submit">download</button>
                                                        </form>
                                                        {{--<a href="{{ \Illuminate\Support\Facades\Storage::url("pdfs/$pdf->url") }}" download>--}}
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>


                                            <div class="col-10">
                                                <span  class="text-danger mt-3">Imewasirishwa ...</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- container-fluid -->

    <!-- container-fluid -->
    @endsection

@section("extra_script")

    <script>
        var app = new Vue({
            el: '#app',
            data: {
                assets: {!! $challenge->leader->user->assets !!},
                pdfFiles: []
            },
            methods: {
                /* Function to render the file using PDF Embed API. */
                previewFile()
                    {
                        /* Initialize the AdobeDC View object */
                        var adobeDCView = new AdobeDC.View({
                            /* Pass your registered client id */
                            clientId: "336044bbef5c437097be95b7386b0fba"
                        });

                        /* Invoke the file preview API on Adobe DC View object */
                        adobeDCView.previewFile({
                            /* Pass information on how to access the file */
                            content: {
                                /* Location of file where it is hosted */
                                location: {
                                    url: "https://spottech.theforbins.com/storage/pdfs/myfile.pdf",
                                    /*
                                     If the file URL requires some additional headers, then it can be passed as follows:-
                                     header: [
                                     {
                                     key: "<HEADER_KEY>",
                                     value: "<HEADER_VALUE>",
                                     }
                                     ]
                                     */
                                },
                            },
                            /* Pass meta data of file */
                            metaData: {
                                /* file name */
                                fileName: "Changamoto.pdf"
                            }
                        }, viewerConfig);
                    }
            },
            computed: {

            },
            mounted(){

            }
        });
    </script>
@endsection