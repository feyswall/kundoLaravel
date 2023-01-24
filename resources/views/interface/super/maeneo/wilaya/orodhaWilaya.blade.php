<?php
/**
  * Created by feyswal on 1/10/2023.
  * Time 2:57 PM.
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
                                        <h5 class="font-size-16 mb-1">Taarifa Kuhusiana Na Mkoa</h5>
                                    </div>
                                    <div class="flex-shrink-0"> <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                </div>
                            </div>
                        </a>
                        <div id="checkout-orodhaKata-collapse" class="collapse hide">
                            <div class="p-4 border-top">
                            <div class="row">


                            <div class="col-12">
                                <div class="p-2">
                                    <h3 class="fs-5 mb-3">Jina la Mkoa: <span class="fw-bold text-uppercase"> {{ $region->name }}</span></h3>
                                    <div style="border-top: #9393; border-top-style: dashed; border-width: 2px;" class="py-3">
                                        <div class="d-flex justify-content-between mb-3">
                                            <h3 class="fs-4">Viongozi wa Mkoa</h3>
                                            <button  data-bs-toggle="modal" data-bs-target="#ongezaKiongoziModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajili kiongozi Mkoa</button>
                                        </div>
                                        <div>
                                            <div class="d-flex justify-start gap-4 flex-wrap">
                                            @foreach( $region->leaders as $leader )
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
                                        <!-- model location here -->
                                        <x-system.modal id="ongezaKiongoziModal" aria="ongezaKiongoziMkoaLabel" size="modal-fullscreen" title="Ongeza Kiongozi Mkoa Hapa" >
                                            <x-slot:content>
                                                <form method="post" action="{{ route('super.leader.mkoa.ongeza') }}">
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
                                                                <input type="hidden" value="{{ $region->id }}" class="form-control" name="side_id" >
                                                                <input type="hidden" value="district_leader" class="form-control" name="table" >
                                                                <input type="hidden" value="district_id" class="form-control" name="side_column" >

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                                <select class="form-control" name="post_id">
                                                                    @foreach( \App\Models\Post::where('area', 'mkoa')->get() as $post )
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
                            </div> <!-- end col -->

                            



                        </div> <!-- end row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <x-system.collapse id="kamatiZaMkoa" title="kamati za mkoa">
                <x-slot:content>
                    @foreach( \App\Models\Group::with("posts")->where("basedOn", "mkoa")->get() as $group)
                            <x-system.collapse :id="$group->deep" :title="strtoupper($group->name)">
                                <x-slot:content>
                                    <x-system.groups-info :group="$group" :table="$region"/>     
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
                            <h2 class="mb-0">Taarifa Za Wilaya</h2>
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

                                <button  data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Ongeza Wilaya</button>

                                <x-system.wilaya-table :areas="$areas">
                                </x-system.wilaya-table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

                <!-- model location here -->
                <x-system.modal id="exampleModal" aria="orodhaWilayaLabel" size="modal-lg" title="Ongeza Wilaya Hapa" >
                    <x-slot:content>
                        <x-system.ongeza-wilaya-modal-form />
                    </x-slot:content>
                </x-system.modal>

            </div> <!-- container-fluid -->
    <!-- end main content-->
    @endsection

    @section("extra_script")
        <x-system.table-script id="superOrodhaWilayaTable">
        </x-system.table-script>
        @endsection