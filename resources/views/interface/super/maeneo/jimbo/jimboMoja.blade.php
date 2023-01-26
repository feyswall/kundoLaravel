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
            <div class="card px-md-3">
                <div class="card-body">
                    <div class="d-flex justify-content-md-start justify-content-center flex-wrap my-2">
                        <h3 class="fs-5 me-3">Jimbo la: <span class="fw-bold text-uppercase"> {{ $state->name }}</span></h3>
                        <h3 class="fs-5 me-3">Wilaya ya: <span class="fw-bold text-uppercase"> {{ $state->district->name }}</span></h3>
                        <h3 class="fs-5 me-3">Mkoa wa: <span class="fw-bold text-uppercase"> {{ $state->district->region->name }}</span></h3>
                    </div>
                    <div style="border-top: #9393; border-top-style: dashed; border-width: 2px;" class="py-3">
                        <div class="d-flex justify-content-md-between justify-content-center items-center flex-wrap-reverse mb-3">
                            <h3 class="fs-4 me-3">Viongozi wa Jimbo</h3>
                            <div class="d-flex items-center justify-content-center gap-2">
                                <button data-bs-toggle="modal" data-bs-target="#ongezaKiongoziModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajiri Kiongozi</button>
                                <a href="{{ route("super.areas.jimbo.orodha", $state->district->id) }}" class="btn btn-primary btn-md mb-4">Rudi Kwenye Wilaya</a>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-start gap-4 flex-wrap">
                                @foreach( $state->leaders as $leader )
                                @if( $leader->pivot->isActive == true )

                                <div class="text-center">
                                    <a class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Badilisha" href=""></a>
                                    <h4 class="fs-5 text-capitalize">{{ $leader->firstName }} {{ $leader->lastName }}</h4>
                                    <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2">{{ \App\Models\Post::find( $leader->pivot->post_id )->name }}</small>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <!-- model location here -->
                        <x-system.modal id="ongezaKiongoziModal" aria="orodhaTawiLabel" size="modal-fullscreen" title="Ongeza Tawi Hapa">
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
                                                <input type="hidden" value="{{ $state->id }}" class="form-control" name="side_id">
                                                <input type="hidden" value="leader_state" class="form-control" name="table">
                                                <input type="hidden" value="state_id" class="form-control" name="side_column">

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