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
                                <h5 class="font-size-16 mb-1">Taarifa Kuhusiana Na Halmashauri</h5>
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
                                        <h4>ya:{{ $council->name }}</h4>

                                        <h2>Mkoa</h2>
                                        <h4>{{ $council->district->region->name }}</h4>

                                        <h2>Wilaya</h2>
                                        <h4>{{ $council->district->name }}</h4>

                                        <h2>Halmashauri</h2>
                                        <h4>{{ $council->name }}</h4>

                                        <div>
                                            <h1>Viongozi wa Halmashauri</h1>
                                            <div>
                                                @foreach( $council->leaders as $leader )
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
                                                    <form method="post" action="{{ route('super.leader.halmashauri.ongeza') }}">
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
                                                                    <input type="hidden" value="{{ $council->id }}" class="form-control" name="side_id" >
                                                                    <input type="hidden" value="council_leader" class="form-control" name="table" >
                                                                    <input type="hidden" value="council_id" class="form-control" name="side_column" >

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-4 col-lg-3">
                                                                <div class="mb-3 mb-4">
                                                                    <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                                    <select class="form-control" name="post_id">
                                                                        @foreach( \App\Models\Post::where('area', 'halmashauri')->get() as $post )
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
                    <h2 class="mb-0">Taarifa Za Tarafa</h2>
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

                        <button  data-bs-toggle="modal" data-bs-target="#orodhaTarafaModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Ongeza Tarafa</button>
                        <a href="{{ route('super.areas.halmashauri.orodha', $council->district->id) }}" class="btn btn-primary btn-md mb-4">Rudi Katika Halmashauri</a>
                        {{-- <table id="superOrodhaTafaraTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Jina la Tarafa</th>
                                <th>Idadi Ya  Kata</th>
                                <th>Idadi Ya Matawi</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach( $areas as $key => $division )
                                <tr>
                                    <td>{{ $division->name }}</td>
                                    <td>{{ $division->wards()->count() }}</td>
                                    <td>
                                        @php
                                            $counter = 0;
                                            foreach ( $division->wards as $ward ){
                                            $counter += $ward->branches()->count();
                                            }
                                            echo $counter;
                                        @endphp
                                    </td>
                                    <td>
                                        <a href="{{ route("super.areas.kata.orodha", $division->id) }}" class="btn btn-primary">fungua</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table> --}}   
                        
                        <x-system.table-tarafa :areas="$areas">
                        </x-system.table-tarafa>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <!-- model location here -->
        <x-system.modal id="orodhaTarafaModal" aria="orodhaTarafaLabel" size="modal-lg" title="Ongeza Tarafa Hapa" >
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
    <script>
        $ (document).ready (function () {
            $ (
                '#datatable'
            ).DataTable (), $ ('#superOrodhaWilayaTable')
                .DataTable ({lengthChange: !1, buttons: ['excel', 'pdf'], "order": [[ 1, "desc" ]]})
                .buttons ()
                .container ().appendTo ('#superOrodhaTafaraTable_wrapper .col-md-6:eq(0)'), $ ('.dataTables_length select')
                .addClass ('form-select form-select-sm');
        });
    </script>
@endsection

