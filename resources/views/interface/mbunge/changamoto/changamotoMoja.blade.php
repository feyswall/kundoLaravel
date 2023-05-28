<?php
/**
  * Created by feyswal on 2/9/2023.
  * Time 5:19 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>

@php
    $state = $challenge->leader->states()->where('isActive', true)->first();
@endphp


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
                                <div>
                                    <form action="{{ route('downloadPDF') }}" method="post" target="_blank">
                                        @csrf
                                        <input type="hidden" value="{{ 'pdfs/'.$challenge->form_url }}" name="pdf">
                                        <button  class="btn btn-dark float-end mt-lg-3 mt-sm-2" type="submit">pakua pdf ya form</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="invoice-title">
                                    <div class="mb-4">

                                    </div>
                                    <div class="text-muted">
                                            <div class="row justify-content-center">
                                                <div class="col-md-8 col-sm-12">
                                                    <h3 class="lead">Mkoa: <span class="font-italic">{{ $state->district->region->name }}</span></h3>
                                                    <h3 class="lead">Wilaya: <span class="font-italic">{{ $state->district->name }}</span></h3>
                                                    <h3 class="lead">Jimbo: <span class="font-italic">{{ $state->name }}</span>
                                                    </h3>
                                                    <h3 class="lead">Jina la Mbunge: <span>
                                                        <b>{{ $challenge->leader->firstName }}  {{ $challenge->leader->lastName}}</b>
                                                    </span></h3>
                                                    <h3 class="lead">Simu ya Mbunge: <span class="font-italic">+{{ $challenge->leader->phone }}</span></h3>
                                                </div>
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


                                                                <div class="col-12 mt-3">
                                                                    <div class="row justify-content-start">
                                                                        <div class="col-sm-12 col-md-12">
                                                                            <h5>Yahusu: {{ $challenge->yahusu }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-12">
                                                                    <div class="row justify-content-start">
                                                                        <div class="col-sm-12 col-md-12">
                                                                             {!! $challenge->challenge !!}
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
                                                                        <i>Mhe: {{ $challenge->leader->firstName }} {{ $challenge->leader->lastName}}</i>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-10 mt-3 mb-3">
                                                <div class="row justify-content-center">
                                                    @foreach( $challenge->assets->where('user_id', \Illuminate\Support\Facades\Auth::user()->id ) as $pdf )
                                                            @if( \Illuminate\Support\Facades\Storage::exists("pdfs/$pdf->url"))
                                                            {{--<a>{{ \Illuminate\Support\Facades\Storage::download("pdfs/$pdf->url") }} pakua</a>--}}
                                                            @endif
                                                    <div class="col-md-10 col-sm-4">
                                                        <div class="row justify-content-start">
                                                             <div>
                                                                <span style="font-size: 2em;">Attachments</span>
                                                            </div>
                                                            <div class="col-sm-4 col-md-4 mt-2">
                                                                <img src="{{ asset('assets/images/pdf.png') }}" class="card-img-top mx-auto w-25" alt="">
                                                            </div>
                                                        </div>
                                                            <form action="{{ route('downloadPDF') }}" method="post" target="_blank">
                                                                @csrf
                                                                <input type="hidden" value="{{ 'pdfs/'.$pdf->url }}" name="pdf">
                                                                <button class="btn btn-primary my-3 btn-block" type="submit">download</button>
                                                            </form>
                                                            {{--<a href="{{ \Illuminate\Support\Facades\Storage::url("pdfs/$pdf->url") }}" download>--}}
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="col-10">
                                                @if( $challenge->status == "new")
                                                   @php
                                                        $createdAt = Carbon\Carbon::parse($challenge->created_at);
                                                    @endphp
                                                    <h4 class="text-danger"><b>{{ $createdAt->format('M d Y') }}</b></h4><hr>
                                                    <h5
                                                     class="text-danger mt-3">Imewasirishwa ...</h5>

                                                @elseif( $challenge->status == 'onProgress')
                                                  <div class="row justify-content-center">
                                                        <div class="col-sm-12 col-md-8">
                                                            @php
                                                                $createdAt = Carbon\Carbon::parse($challenge->created_at);
                                                            @endphp
                                                            <h4 class="text-warning"><b>{{ $createdAt->format('M d Y') }}</b></h4><hr>
                                                            <hr class="text-warning" style="border: 2px solid">
                                                            <span class="text-warning">
                                                                {{ $challenge->feedback }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                @elseif( $challenge->status == 'complete')
                                                <div class="row justify-content-center">
                                                        <div class="col-sm-12 col-md-8">
                                                            @php
                                                                $createdAt = Carbon\Carbon::parse($challenge->created_at);
                                                            @endphp
                                                            <h4 class="text-success"><b>{{ $createdAt->format('M d Y') }}</b></h4><hr>
                                                            <hr class="text-success" style="border: 2px solid">
                                                            <span class="text-success">
                                                                {{ $challenge->feedback }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                @endif

                                                @if ( $challenge->status != 'new')
                                                    @foreach( $challenge->assets->where('user_id', '!=', \Illuminate\Support\Facades\Auth::user()->id ) as $pdf )
                                                        @if( \Illuminate\Support\Facades\Storage::exists("pdfs/$pdf->url"))
                                                            <div class="row justify-content-center">
                                                                <div class="col-sm-12 col-md-8 mt-2">
                                                                    <div>
                                                                        <span style="font-size: 2em;">Attachments</span>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="col-md-3">
                                                                            <img src="{{ asset('assets/images/pdf.png') }}" class="card-img-top mx-auto w-25" alt="">
                                                                        </div>
                                                                    </div>
                                                                    <form action="{{ route('downloadPDF') }}" method="post" target="_blank">
                                                                        @csrf
                                                                        <input type="hidden" value="{{ 'pdfs/'.$pdf->url }}" name="pdf">
                                                                        <button class="btn btn-primary my-3 btn-block" type="submit">download</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif

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
