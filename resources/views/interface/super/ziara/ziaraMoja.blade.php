@extends("layouts.super_system")

@section("content")
    <div class="col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
             <div>
                <form action="{{ route('downloadPDF') }}" method="post" target="_blank">
                    @csrf
                    <input type="hidden" value="{{ 'ziara/'.$sial->letter_url }}" name="pdf">
                    <button  class="btn btn-dark float-end mt-lg-3 mt-sm-2" type="submit">pakua pdf ya barua</button>
                </form>
                     <a href="{{ route('super.sial.allList') }}"  class="btn btn-primary float-end mt-lg-3 mt-sm-2 mx-2">Orodha Barua Zote</a> 
            </div>
        </div>
        <div class="card-body">
            <div class="invoice-title">
                <div class="mb-4">
                </div>
                <div class="text-muted">
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <div class="row justify-content-center" >
                                <div class="col-md-10 col-sm-12">
                                    <div class="card shadow-none">
                                        <div class="card-body">
                                            <div class="row justify-content-start">
                                                <div class="col-lg-12 col-md-7 col-sm-6">
                                                    <h5><b>Barua Kwenda / {{ $sendTo->posts->first()->area }} /</b> {{ $area->name }}</h5>
                                                    {{-- <img src="{{ asset('assets/images/bunge.png')}}" alt="" class="w-100 mx-auto"> --}}
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row justify-content-end mt-3">
                                                    <div class="col-md-2 mt-4">
                                                        <address class="mini-text">
                                                            Tarehe: {{ Carbon\Carbon::parse($sial->created_at)->format("d M Y") }}<br>
                                                        </address>
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

                                            <div class="col-12 mt-3">
                                                <div class="row justify-content-center">
                                                    <div class="col-sm-12 col-md-8 text-center">
                                                        <h5><b>Yah: <span style="text-decoration: underline;">{{ $sial->title }}</span></b></h5>     
                                                    </div>
                                                </div>
                                                <p>Ngudu: <b>{{ ucfirst($sendTo->firstName) }} {{ ucfirst($sendTo->lastName) }} - {{ $sendTo->posts->first()->name }}</b></p>
                                            </div>


                                            <div class="col-12">
                                                <div class="row justify-content-start">
                                                    <div class="col-sm-12 col-md-12">
                                                            @php
                                                                $sialParticles = explode('-', $sial->note);
                                                            @endphp
                                                        @foreach ($sialParticles as $sialPiece)
                                                            <p>{{ $sialPiece }}</p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row justify-content-start mt-n3">
                                                <div class="col-sm-12 col-md-12 text-start">
                                                    <p><b>Nakala :-</b></p>
                                                    <div>
                                                        @foreach ($copyTo as $leader)
                                                            <p class="p-0 m-0">{{ $leader->posts->first()->name }} - <i>{{ ucfirst($leader->firstName) }} {{  ucfirst($leader->lastName) }}</i></p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection