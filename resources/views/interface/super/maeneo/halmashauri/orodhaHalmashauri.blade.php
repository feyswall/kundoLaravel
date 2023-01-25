<?php
/**
  * Created by feyswal on 1/12/2023.
  * Time 11:58 AM.
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
                                <h5 class="font-size-16 mb-1">Taarifa Kuhusiana Na Wilaya</h5>
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
                                        <h3 class="fs-5 mb-3">Taarifa za Wilaya: <span class="fw-bold text-uppercase"> {{ $district->name }}</span></h3>

                                        <h5>Mkoa</h5>
                                        <span>{{ $district->region->name }}</span>

                                        <h5>Wilaya</h5>
                                        <span>{{ $district->name }}</span>

                                        <div>
                                            <h1>Viongozi wa Wilaya</h1>
                                             <div>
                                            <div class="d-flex justify-start gap-4 flex-wrap">
                                            @foreach( $district->leaders as $leader )
                                                    @if( $leader->pivot->isActive == true )
                                                    <div class="text-center">
                                                        <a class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Badilisha" href="{{ route("super.leader.wilaya.badili", $leader->id ) }}"></a>
                                                        <h4 class="fs-5 text-capitalize">{{ $leader->firstName }} {{ $leader->lastName }}</h4>
                                                        <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2" >{{ \App\Models\Post::find( $leader->pivot->post_id )->name }}</small>
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                            <button  data-bs-toggle="modal" data-bs-target="#ongezaKiongoziModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajiri kiongozi wilaya </button>
                                            <!-- model location here -->
                                            <x-system.modal id="ongezaKiongoziModal" aria="ongezaKiongoziWilayaLabel" size="modal-fullscreen" title="Ongeza Kiongozi  Hapa" >
                                                <x-slot:content>
                                                    <form method="post" action="{{ route('super.leader.wilaya.ongeza') }}">
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
                                                                    <input type="hidden" value="{{ $district->id }}" class="form-control" name="side_id" >
                                                                    <input type="hidden" value="district_leader" class="form-control" name="table" >
                                                                    <input type="hidden" value="district_id" class="form-control" name="side_column" >

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-4 col-lg-3">
                                                                <div class="mb-3 mb-4">
                                                                    <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                                    <select class="form-control" name="post_id">
                                                                        @php $posts = \App\Models\Post::where('area', 'wilaya')->get(); @endphp
                                                                        @foreach( $posts as $post )
                                                                            <option value="{{ $post->id }}">{{ $post->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>


                                                              {{-- <div class="col-sm-12 col-md-4 col-lg-3">
                                                                <div class="mb-3 mb-4">
                                                                    <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                                    <select class="form-control" name="post_id">
                                                                        @php $district2 = \App\Models\District::where('id', $district->id)->first(); @endphp
                                                                        @foreach ($posts as $post)>
                                                                                $leadersDistr_id = []; 
                                                                                @foreach ($district2->leaders as $leader)
                                                                                    @if ( $leader->posts->contains($post->id) )
                                                                                        @foreach ($leader->posts as $post)
                                                                                            @if ( $post->pivot->isActive == false)
                                                                                                @php $leadersDistr_id[] = $post->id; @endphp
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @endif
                                                                                @endforeach
                                                                    
                                                                        @endforeach

                                                                        @php 
                                                                            $posts3 = \App\Models\Post::whereIn('id', $leadersDistr_id)->get();
                                                                        @endphp
                                                                        @foreach( $posts3 as $post )
                                                                            <option value="{{ $post->id }}">{{ $post->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div> --}}


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



    <x-system.collapse id="kamatiZaWilaya" title="kamati za wilaya">
        <x-slot:content>
            @foreach( \App\Models\Group::with("posts.leaders")->where("basedOn", "wilaya")->get() as $group)
                <x-system.collapse :id="$group->deep" :title="strtoupper($group->name)">
                    <x-slot:content>
                       <x-system.groups-info :group="$group" :table="$district"/>
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
                    <h2 class="mb-0">Taarifa Za Halmashauri</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Maeneo</a></li>
                            <li class="breadcrumb-item active">Wilaya</li>
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
                        <button  data-bs-toggle="modal" data-bs-target="#orodhaHalmashauriModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Ongeza Almashauri</button>
                        <a href="{{ route('super.areas.wilaya.orodha') }}" class="btn btn-primary btn-md mb-4">Rudi Wilayani</a>
                        <x-system.halmashauri-table :district="$district" :areas="$areas" :headers="['Jina la Halmashauri','Idadi Ya Wilaya','Idadi Ya Tarafa', '']" />
                        <!-- model location here -->
                        <x-system.modal id="orodhaHalmashauriModal" aria="orodhaHalmashauriLabel" size="modal-lg" title="Ongeza Almashauri Hapa" >
                            <x-slot:content>
                                <form method="post" action="{{ route('super.areas.halmashauri.ongeza') }}">
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
                                                    <input type="text" class="form-control" readonly value="{{ $district->name }}">
                                                    <input type="hidden" class="form-control" name="wilaya_id" readonly value="{{ $district->id }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="billing-name">Jina La Halmashauri</label>
                                                    <input type="text" name="halmashauri" class="form-control" placeholder="eg: mgeule juu">
                                                </div>
                                                @error("halmashauri")
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
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
    <!-- end main content-->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-5">
                        <h2>Orodha Majimbo</h2>
                        <button  data-bs-toggle="modal" data-bs-target="#orodhaJimboModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Ongeza Majimbo</button>

                        <x-system.jimbo-table :states="$states" :district="$district"></x-system.jimbo-table>

                    </div>
                    <!-- model location states here -->
                    <x-system.modal id="orodhaJimboModal" aria="orodhaJimboLabel" size="modal-lg" title="Ongeza Jimbo Hapa" >
                        <x-slot:content>
                            <form method="post" action="{{ route('super.areas.jimbo.ongeza') }}">
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
                                                <input type="text" class="form-control" readonly value="{{ $district->name }}">
                                                <input type="hidden" class="form-control" name="district_id" readonly value="{{ $district->id }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="billing-name">Jina La Jimbo</label>
                                                <input type="text" name="jimbo" class="form-control" placeholder="eg: mgeule juu">
                                            </div>
                                            @error("jimbo")
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
                </div>
            </div>
        </div>
    </div>


@endsection

@section("extra_script")
    <x-system.table-script id="superOrodhaHalmashauriTable" />
    <x-system.table-script id="superOrodhaJimboTable" />
@endsection
