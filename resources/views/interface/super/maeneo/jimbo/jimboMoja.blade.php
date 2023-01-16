<?php
/**
  * Created by feyswal on 1/16/2023.
  * Time 10:16 AM.
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
                    <h2 class="mb-0">Taarifa Za Jimbo</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Maeneo</a></li>
                            <li class="breadcrumb-item active">Jimbo</li>
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
                        <h2>Taarifa za Jimbo</h2>
                        <h4>{{ $state->name }}</h4>

                        <h2>Mkoa</h2>
                        <h4>{{ $state->district->region->name }}</h4>

                        <h2>Wilaya</h2>
                        <h4>{{ $state->district->name }}</h4>

                        <div>
                            <h1>Viongozi wa Jimbo</h1>
                            <div>
                                @foreach( $state->leaders as $leader )
                                    @if( $leader->pivot->isActive == true )
                                        <h3>{{ \App\Models\Post::find( $leader->pivot->post_id )->name }}</h3>
                                        <p>{{ $leader->firstName }} {{ $leader->lastName }} - <a href="#">badiri</a></p>
                                    @endif
                                @endforeach
                            </div>

                            <a href="{{ route("super.areas.jimbo.orodha", $state->district->id) }}" class="btn btn-primary btn-md mb-4" >Rudi Kwenye Wilaya</a>
                            <button  data-bs-toggle="modal" data-bs-target="#ongezaKiongoziModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajiri  Kiongozi</button>
                            <!-- model location here -->
                            <x-system.modal id="ongezaKiongoziModal" aria="orodhaTawiLabel" size="modal-fullscreen" title="Ongeza Tawi Hapa" >
                                <x-slot:content>
                                    <form method="post" action="{{ route('super.leader.jimbo.ongeza') }}">
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
                                                    <input type="hidden" value="{{ $state->id }}" class="form-control" name="side_id" >
                                                    <input type="hidden" value="leader_state" class="form-control" name="table" >
                                                    <input type="hidden" value="state_id" class="form-control" name="side_column" >

                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-3">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                    <select class="form-control" name="post_id">
                                                       @foreach( \App\Models\Post::where('area', 'jimbo')->get() as $post )
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

