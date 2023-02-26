<?php
/**
  * Created by feyswal on 2/13/2023.
  * Time 1:03 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>

@php
    $state = $challenge->leader->states()->where('isActive', true)->first();
@endphp


@extends("layouts.super_system")

@section("content")
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
                                                <div class="col col-md-2 col-sm-6">
                                                    <img src="{{ asset('assets/images/bunge.png')}}" alt="" class="w-100 mx-auto">
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
                                                        <h5><b>Yah: </b>{{ $challenge->yahusu }}</h5>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="row justify-content-start">
                                                    <div class="col-sm-12 col-md-12">
                                                        <p>
                                                            {{ $challenge->challenge }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center mt-n3">
                                                <div class="col-sm-6 col-md-4 text-center">
                                                    <i>Mhe: {{ $challenge->leader->firstName }} {{ $challenge->leader->lastName }}</i>
                                                    <div>
                                                        <img style="max-width: 200px;" src="../../assets/images/sign.jpeg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mt-3 mb-3">
                            <div class="row justify-content-center">
                                @foreach( $challenge->assets->where('user_id','!=', \Illuminate\Support\Facades\Auth::user()->id ) as $pdf )
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

                
                        @if ( $challenge->status == 'new' )
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-8">
                                <div>
                                    <form action="{{ route('super.challenge.updateChallenge', $challenge) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div>
                                            <label for="">Ahadi</label>
                                            <textarea name="feedback" type="text" class="form-control" rows="7">{!! old('feedback') !!}</textarea>
                                        </div>
                                        <div class="mt-2">
                                            <label for="">Ambatanisha PDF</label>
                                            <input type="file" class="form-control" accept="application/pdf" name="pdfFile">
                                    </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary btn-md mt-3">Hifadhi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @elseif ($challenge->status == 'onProgress')
                            <div class="row justify-content-center">
                                <div class="col-sm-12 col-md-8">
                                    @php
                                        $createdAt = Carbon\Carbon::parse($challenge->created_at);
                                    @endphp
                                    <h4 class="text-warning"><b>{{ $createdAt->format('M d Y') }}</b></h4><hr>
                                    <span class="text-warning">
                                        {{ $challenge->feedback }}
                                    </span>
                                    <div class="my-3">
                                         <form action="{{ route('super.challenge.acomplished', $challenge->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button onclick="markCompleteFunct(event)" class="btn btn-success btn-sm" type="button">
                                            imetatuliwa
                                        </button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if( $challenge->status == 'complete' )
                            <div class="row justify-content-center">
                                <div class="col-sm-12 col-md-8">
                                    @php
                                        $createdAt = Carbon\Carbon::parse($challenge->created_at);
                                    @endphp
                                    <h4 class="text-success"><b>{{ $createdAt->format('M d Y') }}</b></h4><hr>
                                    <span class="text-success">
                                        {{ $challenge->feedback }}
                                    </span>
                                </div>
                            </div>
                        @endif

                        @if ( $challenge != 'new')
                            @foreach( $challenge->assets->where('user_id', \Illuminate\Support\Facades\Auth::user()->id ) as $pdf )
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
@endsection

@section("extra_script")
<script>
    $(document).ready(function(){
        
    });
    function markCompleteFunct(event){
            event.preventDefault();
           if( confirm('Bonyeza OK kuthibitisha') ){
                $(event.target).parent('form').submit();
           }
        }
</script>
@endsection