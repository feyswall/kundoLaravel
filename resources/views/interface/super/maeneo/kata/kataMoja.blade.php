<?php
/**
  * Created by feyswal on 1/14/2023.
  * Time 3:14 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>


@extends("layouts.super_system")

@section("content")
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">Taarifa Za Kata</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Maeneo</a></li>
                            <li class="breadcrumb-item active">Kata</li>
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
                        <h2>Taarifa za Kata</h2>
                        <h4>{{ $ward->name }}</h4>

                        <h2>Mkoa</h2>
                        <h4>{{ $ward->division->council->district->region->name }}</h4>

                        <h2>Wilaya</h2>
                        <h4>{{ $ward->division->council->district->name }}</h4>

                        <h2>Halmashauri</h2>
                        <h4>{{ $ward->division->council->name }}</h4>

                        <h2>Tarafa</h2>
                        <h4>{{ $ward->division->name }}</h4>

                        <h2>Kata</h2>
                        <h4>{{ $ward->name }}</h4>


                        <div>
                            <h1>Viongozi wa Kata</h1>
                            <div>
                                @php
                                    $mwenyekiti = \App\Models\Post::where('deep', 'mwenyekiti')->first();
                                    $katibu = \App\Models\Post::where('deep', 'katibu')->first();
                                    $mwenezi = \App\Models\Post::where('deep', 'mwenezi')->first();
                                    $mjumbe = \App\Models\Post::where('deep', 'mjumbe wilaya')->first();
                                @endphp
                                <h3>Mwenyekiti</h3>
                                @foreach ( $branch->leaders as $leader )
                                    @if( $leader->pivot->post_id == $mwenyekiti->id )
                                        <p>{{ $leader->firstName }} {{ $leader->lastName }} - <a
                                                    href="#">badiri</a></p>
                                    @endif
                                @endforeach

                                <hr>

                                <h3>Katibu</h3>
                                @foreach ( $branch->leaders as $leader )
                                    @if( $leader->pivot->post_id == $katibu->id )
                                        <p>{{ $leader->firstName }} {{ $leader->lastName }} - <a href="#">badiri</a></p>
                                    @endif
                                @endforeach
                                <hr>

                                <h3>Mwenezi</h3>
                                @foreach ( $branch->leaders as $leader )
                                    @if( $leader->pivot->post_id == $mwenezi->id )
                                        <p>{{ $leader->firstName }} {{ $leader->lastName }} - <a href="#">badiri</a></p>
                                    @endif
                                @endforeach
                                <hr>


                                <h3>Mjumbe</h3>
                                @foreach ( $branch->leaders as $leader )
                                    @if( $leader->pivot->post_id == $mjumbe->id )
                                        <p>{{ $leader->firstName }} {{ $leader->lastName }} - <a href="#">badiri</a></p>
                                    @endif
                                @endforeach
                                <hr>



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
                                                        @foreach( \App\Models\Post::all() as $post )
                                                            <option value="{{ $post->id }}">{{ $post->deep }}</option>
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
