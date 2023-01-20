<?php
/**
  * Created by feyswal on 1/12/2023.
  * Time 6:37 PM.
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
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h2>Taarifa za Kata</h2>
                                            <h4>ya:{{ $ward->name }}</h4>

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
                                                        @foreach( $ward->leaders as $leader )
                                                               @if( $leader->pivot->isActive == true )
                                                                    <h3>{{ \App\Models\Post::find( $leader->pivot->post_id )->name }}</h3>
                                                                    <p>{{ $leader->firstName }} {{ $leader->lastName }} - <a href="#">badiri</a></p>
                                                                   @endif
                                                        @endforeach
                                                        <hr>
                                                    </div>

                                                     <button  data-bs-toggle="modal" data-bs-target="#ongezaKiongoziModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajiri </button>
                                                    <!-- model location here -->
                                                    <x-system.modal id="ongezaKiongoziModal" aria="ongezaKiongoziKataLabel" size="modal-fullscreen" title="Ongeza Kiongozi Wa Kata Hapa" >
                                                        <x-slot:content>
                                                            <form method="post" action="{{ route('super.leader.kata.ongeza') }}">
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
                                                                            <input type="hidden" value="{{ $ward->id }}" class="form-control" name="side_id" >
                                                                            <input type="hidden" value="leader_ward" class="form-control" name="table" >
                                                                            <input type="hidden" value="ward_id" class="form-control" name="side_column" >

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-4 col-lg-3">
                                                                        <div class="mb-3 mb-4">
                                                                            <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                                            <select class="form-control" name="post_id">
                                                                                @foreach( \App\Models\Post::where('area', 'kata')->get() as $post )
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




    <x-system.collapse id="kamatiZaKata" title="kamati Ngazi ya Kata">
        <x-slot:content>
            @foreach( \App\Models\Group::with("posts.leaders")->where("basedOn", "Kata")->get() as $group)
                <x-system.collapse :id="$group->deep" :title="strtoupper($group->name)">
                    <x-slot:content>
                       <x-system.groups-info :group="$group" :table="$ward"/>     
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
                    <h2 class="mb-0">Taarifa Za Matawi</h2>
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

                        <button  data-bs-toggle="modal" data-bs-target="#orodhaTawiModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Ongeza Tawi</button>
                        <a href="{{ route('super.areas.kata.orodha', $ward->division->id) }}" class="btn btn-primary btn-md mb-4">Rudi Kwenye Kata</a>
                    
                        <x-system.tawi-table :areas="$areas">
                        </x-system.tawi-table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <!-- model location here -->
        <x-system.modal id="orodhaTawiModal" aria="orodhaTawiLabel" size="modal-lg" title="Ongeza Tawi Hapa" >
            <x-slot:content>
                <form method="post" action="{{ route('super.areas.tawi.ongeza') }}">
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
                                    <input type="text" class="form-control" readonly value="{{ $ward->division->council->district->name }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Jina La Halmashauri</label>
                                    <input type="text" class="form-control" readonly value="{{ $ward->division->council->name }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Jina La Tarafa</label>
                                    <input type="text" class="form-control" readonly value="{{ $ward->division->name }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Jina La Kata</label>
                                    <input type="text" class="form-control" readonly value="{{ $ward->name }}">
                                    <input type="hidden" name="ward_id" class="form-control" readonly value="{{ $ward->id }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="tawi">Jina La Tawi</label>
                                    <input type="text" name="tawi" class="form-control" placeholder="eg: mgeule juu">
                                </div>
                                @error("tawi")
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
    <x-system.table-script id="superOrodhaKataTable">
    </x-system.table-script>
@endsection
