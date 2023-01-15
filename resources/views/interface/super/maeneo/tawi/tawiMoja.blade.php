<?php
/**
  * Created by feyswal on 1/13/2023.
  * Time 12:16 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>


@extends("layouts.super_system")

@section("content")
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <a href="#checkout-orodhaKata-collapse" class="text-dark" data-bs-toggle="collapse">
                    <div class="p-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i> </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1">Taarifa Kuhusiana Na Kata</h5>
                            </div>
                            <div class="flex-shrink-0"> <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                        </div>
                    </div>
                </a>
                <div id="checkout-orodhaKata-collapse" class="collapse hide">
                    <div class="p-4 border-top">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">Taarifa Za Tawi</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Maeneo</a></li>
                            <li class="breadcrumb-item active">Tawi</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2>Taarifa za tawi</h2>
                        <h4>{{ $branch->name }}</h4>

                        <h2>Mkoa</h2>
                        <h4>{{ $branch->ward->division->council->district->region->name }}</h4>

                        <h2>Wilaya</h2>
                        <h4>{{ $branch->ward->division->council->district->name }}</h4>

                        <h2>Halmashauri</h2>
                        <h4>{{ $branch->ward->division->council->name }}</h4>

                        <h2>Tarafa</h2>
                        <h4>{{ $branch->ward->division->name }}</h4>

                        <h2>Kata</h2>
                        <h4>{{ $branch->ward->name }}</h4>


                        <div>
                            <h1>Viongozi wa Tawi</h1>
                                <div>
                                    @php
                                        $mwenyekiti = \App\Models\Post::where('deep', 'mwenyekiti_tawi')->first();
                                        $katibu = \App\Models\Post::where('deep', 'katibu_tawi')->first();
                                        $mwenezi = \App\Models\Post::where('deep', 'mwenezi_tawi')->first();
                                        $mjumbe = \App\Models\Post::where('deep', 'mjumbe_tawi')->first();
                                    @endphp

                                    <div>
                                        @foreach( $branch->leaders as $leader )
                                            @if( $leader->pivot->isActive == true )
                                                <h3>{{ \App\Models\Post::find( $leader->pivot->post_id )->name }}</h3>
                                                <p>{{ $leader->firstName }} {{ $leader->lastName }} - <a href="#">badiri</a></p>
                                            @endif
                                        @endforeach
                                        <hr>
                                    </div>

                                </div>

                                <a href="{{ route("super.areas.tawi.orodha", $branch->ward->id) }}" class="btn btn-primary btn-md mb-4" >Rudi Kwenye Kata</a>
                                 <button  data-bs-toggle="modal" data-bs-target="#ongezaKiongoziModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajiri </button>
                                <!-- model location here -->
                                <x-system.modal id="ongezaKiongoziModal" aria="orodhaTawiLabel" size="modal-fullscreen" title="Ongeza Tawi Hapa" >
                                    <x-slot:content>
                                        <form method="post" action="{{ route('super.leader.tawi.ongeza') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12 col-md-4 col-lg-3">
                                                    <div class="mb-3 mb-4">
                                                        <label class="form-label" for="firstName">Jina La Kwanza</label>
                                                        <input type="text" class="form-control" name="firstName" placeholder="eg: mgalanga">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-lg-3">
                                                    <div class="mb-3 mb-4">
                                                        <label class="form-label" for="middleName">Jina La Kati</label>
                                                        <input type="text" class="form-control" name="middleName" placeholder="eg: mosi">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-lg-3">
                                                    <div class="mb-3 mb-4">
                                                        <label class="form-label" for="lastName">Jila La Mwisho</label>
                                                        <input type="text" class="form-control" name="lastName" placeholder="eg: mgalanga simo">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-lg-3">
                                                    <div class="mb-3 mb-4">
                                                        <label class="form-label" for="phone">Namba ya Simu</label>
                                                        <input type="text" class="form-control" name="phone" placeholder="eg: 0678 987 897">

                                                        <!-- data to simplify the validation process -->
                                                        <input type="hidden" value="{{ $branch->id }}" class="form-control" name="side_id" >
                                                        <input type="hidden" value="branch_leader" class="form-control" name="table" >
                                                        <input type="hidden" value="branch_id" class="form-control" name="side_column" >

                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-lg-3">
                                                    <div class="mb-3 mb-4">
                                                        <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                        <select class="form-control" name="post_id">
                                                            @foreach( \App\Models\Post::where('area', 'tawi')->get() as $post )
                                                                <option value="{{ $post->id }}">{{ $post->name }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" name="submit" class="btn btn-primary btn-md">Ongeza</button>
                                                </div>
                                            </div>
                                            </div>
                                        </form>
                                    </x-slot:content>
                                </x-system.modal>


                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->
    <!-- end main content-->
@endsection