<?php
/**
  * Created by feyswal on 1/12/2023.
  * Time 4:46 PM.
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
                                <h5 class="font-size-16 mb-1">Taarifa Kuhusiana Na Tarafa</h5>
                            </div>
                            <div class="flex-shrink-0"> <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                        </div>
                    </div>
                </a>
                <div id="checkout-orodhaKata-collapse" class="collapse hide">
                    <div class="p-4 border-top">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h2>Taarifa za Kata</h2>
                                        <h4>ya:{{ $division->name }}</h4>

                                        <h2>Mkoa</h2>
                                        <h4>{{ $division->council->district->region->name }}</h4>

                                        <h2>Wilaya</h2>
                                        <h4>{{ $division->council->district->name }}</h4>

                                        <h2>Halmashauri</h2>
                                        <h4>{{ $division->council->name }}</h4>

                                        <h2>Tarafa</h2>
                                        <h4>{{ $division->name }}</h4>

                                        <h2>Kata</h2>
                                        <h4>{{ $division->name }}</h4>


                                        <div>
                                            <h1>Viongozi wa Tarafa</h1>
                                            <div>
                                                @foreach( $division->leaders as $leader )
                                                    @if( $leader->pivot->isActive == true )
                                                        <h3>{{ \App\Models\Post::find( $leader->pivot->post_id )->name }}</h3>
                                                        <p>{{ $leader->firstName }} {{ $leader->lastName }} - <a href="#">badiri</a></p>
                                                    @endif
                                                @endforeach
                                                <hr>
                                            </div>

                                            <button  data-bs-toggle="modal" data-bs-target="#ongezaKiongoziModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajiri </button>
                                            <!-- model location here -->
                                            <x-system.modal id="ongezaKiongoziModal" aria="ongezaKiongoziTarafaLabel" size="modal-fullscreen" title="Ongeza Kiongozi Tarafa Hapa" >
                                                <x-slot:content>
                                                    <form method="post" action="{{ route('super.leader.tarafa.ongeza') }}">
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
                                                                    <input type="hidden" value="{{ $division->id }}" class="form-control" name="side_id" >
                                                                    <input type="hidden" value="division_leader" class="form-control" name="table" >
                                                                    <input type="hidden" value="division_id" class="form-control" name="side_column" >

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-4 col-lg-3">
                                                                <div class="mb-3 mb-4">
                                                                    <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                                    <select class="form-control" name="post_id">
                                                                        @foreach( \App\Models\Post::where('area', 'tarafa')->get() as $post )
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
                        <button  data-bs-toggle="modal" data-bs-target="#orodhaKataModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Ongeza Kata</button>
                        <a href="{{ route('super.areas.tarafa.orodha', $division->council->id) }}" class="btn btn-primary btn-md mb-4">Rudi Kwenye Tarafa</a>
                        <x-system.kata-table :areas="$areas">
                        </x-system.kata-table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <!-- model location here -->
        <x-system.modal id="orodhaKataModal" aria="orodhaHalmashauriLabel" size="modal-lg" title="Ongeza Kata Hapa" >
            <x-slot:content>
                <form method="post" action="{{ route('super.areas.kata.ongeza') }}">
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
                                    <input type="text" class="form-control" readonly value="{{ $division->council->district->name }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Jina La Halmashauri</label>
                                    <input type="text" class="form-control" readonly value="{{ $division->council->name }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Jina La Tarafa</label>
                                    <input type="text" class="form-control" readonly value="{{ $division->name }}">
                                    <input type="hidden" name="division_id" class="form-control" readonly value="{{ $division->id }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Jina La Kata</label>
                                    <input type="text" name="kata" class="form-control" placeholder="eg: mgeule juu">
                                </div>
                                @error("kata")
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
    <script>
        $ (document).ready (function () {
            $ (
                '#datatable'
            ).DataTable (), $ ('#superOrodhaWilayaTable')
                .DataTable ({lengthChange: !1, buttons: ['excel', 'pdf'], "order": [[ 1, "desc" ]]})
                .buttons ()
                .container ().appendTo ('#superOrodhaKataTable_wrapper .col-md-6:eq(0)'), $ ('.dataTables_length select')
                .addClass ('form-select form-select-sm');
        });
    </script>
@endsection
