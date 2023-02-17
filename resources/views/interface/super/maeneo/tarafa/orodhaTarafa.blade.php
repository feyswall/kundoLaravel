<?php

/**
 * Created by feyswal on 1/12/2023.
 * Time 1:46 PM.
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
                            <h5 class="font-size-16 mb-1">Taarifa za Halmashauri</h5>
                        </div>
                        <div class="flex-shrink-0"> <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                    </div>
                </div>
            </a>
            <div id="checkout-orodhaKata-collapse" class="collapse hide">
                <div class="p-4 border-top">
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <div class="px-md-3">
                                    <div class="d-flex justify-content-md-start justify-content-center flex-wrap my-2">
                                        <h3 class="fs-5 me-3">Halmashauri ya: <span class="fw-bold text-uppercase"> {{ $council->name }}</span></h3>
                                        <h3 class="fs-5 me-3">Wilaya ya: <span class="fw-bold text-uppercase"> {{ $council->district->name }}</span></h3>
                                        <h3 class="fs-5 me-3">Mkoa wa: <span class="fw-bold text-uppercase"> {{ $council->district->region->name }}</span></h3>
                                    </div>
                                    <div style="border-top: #9393; border-top-style: dashed; border-width: 2px;" class="py-3">
                                        <div class="d-flex justify-content-md-between justify-content-center items-center mb-3 flex-wrap-reverse">
                                            <h3 class="fs-4 me-3">Viongozi Wa Chama Halmashauri</h3>
                                            <button data-bs-toggle="modal" data-bs-target="#ongezaKiongoziChamaModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajili Kiongozi Wa Chama Hapa</button>
                                        </div>
                                        <div>
                                            <div class="d-flex justify-start gap-4 flex-wrap">
                                                @foreach( $council->leaders->where('side', 'chama') as $leader )
                                                    @if( $leader->pivot->isActive == true )
                                                    <div class="text-center">
                                                        <a class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Badilisha" href="{{ route("super.leader.tarafa.badili", $leader->id ) }}"></a>
                                                        <h4 class="fs-5 text-capitalize">{{ $leader->firstName }} {{ $leader->lastName }}</h4>
                                                        <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2">{{ \App\Models\Post::find( $leader->pivot->post_id )->name }}</small>
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- model location here -->
                                        <x-system.modal id="ongezaKiongoziChamaModal" aria="ongezaKiongoziTarafaLabel" size="modal-fullscreen" title="Ongeza Kiongozi Tarafa Hapa">
                                            <x-slot:content>
                                                <form method="post" action="{{ route('super.leader.halmashauri.ongeza') }}">
                                                    @csrf
                                                    <input type="hidden" name="side" value="chama">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="firstName">Jina La Kwanza</label>
                                                                <input type="text" class="form-control" name="firstName" value="{{ old('firstName') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="middleName">Jina La Kati</label>
                                                                <input type="text" class="form-control" name="middleName" value="{{ old('middleName') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="lastName">Jila La Mwisho</label>
                                                                <input type="text" class="form-control" name="lastName" value="{{ old('lastName') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="phone">Namba ya Simu</label>
                                                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">

                                                                <!-- data to simplify the validation process -->
                                                                <input type="hidden" value="{{ $council->id }}" class="form-control" name="side_id">
                                                                <input type="hidden" value="council_leader" class="form-control" name="table">
                                                                <input type="hidden" value="council_id" class="form-control" name="side_column">

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                                <select class="form-control" name="post_id">
                                                                    @foreach( \App\Models\Post::where('area', 'halmashauri')->where('side', 'chama')->get() as $post )
                                                                        <option {{ (old('post_id') == $post->id) ? 'selected' : '' }} value="{{ $post->id }}">{{ $post->name }}</option>
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

                    <div class="row">
                        <div class="col-12">
                            <div>
                                <div class="px-md-3">
                                    <div style="border-top: #9393; border-top-style: dashed; border-width: 2px;" class="py-3">
                                        <div class="d-flex justify-content-md-between justify-content-center items-center mb-3 flex-wrap-reverse">
                                            <h3 class="fs-4 me-3">Viongozi Wa Serikali Halmashauri</h3>
                                            <button data-bs-toggle="modal" data-bs-target="#ongezaKiongoziSerikaliModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajili Kiongozi Wa Serikali Hapa</button>
                                        </div>
                                        <div>
                                            <div class="d-flex justify-start gap-4 flex-wrap">
                                                @foreach( $council->leaders->where('side', 'serikali') as $leader )
                                                    @if( $leader->pivot->isActive == true )
                                                        <div class="text-center">
                                                            <a class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Badilisha" href="{{ route("super.leader.tarafa.badili", $leader->id ) }}"></a>
                                                            <h4 class="fs-5 text-capitalize">{{ $leader->firstName }} {{ $leader->lastName }}</h4>
                                                            <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2">{{ \App\Models\Post::find( $leader->pivot->post_id )->name }}</small>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- model location here -->
                                        <x-system.modal id="ongezaKiongoziSerikaliModal" aria="ongezaKiongoziTarafaLabel" size="modal-fullscreen" title="Ongeza Kiongozi Tarafa Hapa">
                                            <x-slot:content>
                                                <form method="post" action="{{ route('super.leader.halmashauri.ongeza') }}">
                                                    @csrf
                                                    <input type="hidden" name="side" value="serikali">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="firstName">Jina La Kwanza</label>
                                                                <input type="text" class="form-control" name="firstName" value="{{ old('firstName') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="middleName">Jina La Kati</label>
                                                                <input type="text" class="form-control" name="middleName" value="{{ old('middleName') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="lastName">Jila La Mwisho</label>
                                                                <input type="text" class="form-control" name="lastName" value="{{ old('lastName') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="phone">Namba ya Simu</label>
                                                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">

                                                                <!-- data to simplify the validation process -->
                                                                <input type="hidden" value="{{ $council->id }}" class="form-control" name="side_id">
                                                                <input type="hidden" value="council_leader" class="form-control" name="table">
                                                                <input type="hidden" value="council_id" class="form-control" name="side_column">

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                                <select class="form-control" name="post_id">
                                                                    @foreach( \App\Models\Post::where('area', 'halmashauri')->where('side', 'serikali ')->get() as $post )
                                                                        <option {{ (old('post_id') == $post->id) ? 'selected' : '' }} value="{{ $post->id }}">{{ $post->name }}</option>
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
            </div>
        </div>
    </div>
</div>
<x-system.collapse id="kamatiZaHalmashauri" title="kamati Ngazi ya Halmashauri">
    <x-slot:content>
        @foreach( \App\Models\Group::with("posts.leaders")->where("basedOn", "halmashauri")->get() as $group)
        <x-system.collapse :id="$group->deep" :title="strtoupper($group->name)">
            <x-slot:content>
                <x-system.groups-info :group="$group" :table="$council" />
            </x-slot:content>
        </x-system.collapse>
        @endforeach
    </x-slot:content>
</x-system.collapse>





<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h2 class="mb-0">Orodha Ya Tarafa</h2>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Maeneo</a></li>
                        <li class="breadcrumb-item active">Tarafa</li>
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

                    <button data-bs-toggle="modal" data-bs-target="#orodhaTarafaModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Ongeza Tarafa</button>
                    <a href="{{ route('super.areas.halmashauri.orodha', $council->district->id) }}" class="btn btn-primary btn-md mb-4">Rudi Katika Halmashauri</a>
                    <x-system.tarafa-table :areas="$areas">
                    </x-system.tarafa-table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- model location here -->
    <x-system.modal id="orodhaTarafaModal" aria="orodhaTarafaLabel" size="modal-lg" title="Ongeza Tarafa Hapa">
        <x-slot:content>
            <form method="post" action="{{ route('super.areas.tarafa.ongeza') }}">
                @csrf
                <div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3 mb-4">
                                <label class="form-label" for="billing-name">Jina La Mkoa</label>
                                <input type="text" readonly class="form-control" value="Bariadi">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3 mb-4">
                                <label class="form-label" for="billing-name">Jina La Wilaya</label>
                                <input type="text" class="form-control" readonly value="{{ $council->district->name }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3 mb-4">
                                <label class="form-label" for="billing-name">Jina La Halmashauri</label>
                                <input type="text" class="form-control" readonly value="{{ $council->name }}">
                                <input type="hidden" class="form-control" readonly value="{{ $council->id }}" name="council_id">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3 mb-4">
                                <label class="form-label" for="billing-name">Jina La Tarafa</label>
                                <input type="text" name="tarafa" class="form-control" placeholder="eg: mgeule juu">
                            </div>
                            @error("tarafa")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary btn-md">Ongeza</button>
                        </div>
                    </div>
            </form>
        </x-slot:content>
    </x-system.modal>

</div> <!-- container-fluid -->
<!-- end main content-->
@endsection

@section("extra_script")
<x-system.table-script id="superOrodhaTafaraTable">

</x-system.table-script>
@endsection