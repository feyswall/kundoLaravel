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

    <x-system.collapse id="kamatiZaChamaTarafa" title="kamati Za Chama Ngazi ya Tawi">
        <x-slot:content>
            @foreach( \App\Models\Group::with("posts.leaders")->where("basedOn", "tawi")->where('side', 'chama')->get() as $group)
                <x-system.collapse :id="$group->deep" :title="strtoupper($group->name)">
                    <x-slot:content>
                        <x-system.groups-info :group="$group" :table="$branch" />
                    </x-slot:content>
                </x-system.collapse>
            @endforeach
        </x-slot:content>
    </x-system.collapse>

    <x-system.collapse id="kamatiZaSerikaliTarafa" title="kamati Za Serikali Ngazi ya Tawi">
        <x-slot:content>
            @foreach( \App\Models\Group::with("posts.leaders")->where("basedOn", "tawi")->where('side', 'serikali')->get() as $group)
                <x-system.collapse :id="$group->deep" :title="strtoupper($group->name)">
                    <x-slot:content>
                        <x-system.groups-info :group="$group" :table="$branch" />
                    </x-slot:content>
                </x-system.collapse>
            @endforeach
        </x-slot:content>
    </x-system.collapse>

        <div class="col-12">
            <div class="card px-md-3">
                <div class="card-body">
                    <div class="d-flex justify-content-md-start justify-content-center flex-wrap my-2">
                        <h3 class="fs-5 me-3">Tawi la: <span class="fw-bold text-uppercase"> {{ $branch->name }}</span></h3>
                        <h3 class="fs-5 me-3">Kata ya: <span class="fw-bold text-uppercase"> {{ $branch->ward->name }}</span></h3>
                        <h3 class="fs-5 me-3">Tarafa ya: <span class="fw-bold text-uppercase"> {{ $branch->ward->division->name }}</span></h3>
                        <h3 class="fs-5 me-3">Halmashauri ya: <span class="fw-bold text-uppercase"> {{ $branch->ward->division->council->name }}</span></h3>
                        <h3 class="fs-5 me-3">Wilaya ya: <span class="fw-bold text-uppercase"> {{ $branch->ward->division->council->district->name }}</span></h3>
                        <h3 class="fs-5 me-3">Mkoa wa: <span class="fw-bold text-uppercase"> {{ $branch->ward->division->council->district->region->name }}</span></h3>
                    </div>
                    <div style="border-top: #9393; border-top-style: dashed; border-width: 2px;" class="py-3">
                        <div class="d-flex justify-content-md-between justify-content-center items-center flex-wrap-reverse mb-3">
                            <h3 class="fs-4 me-3">Viongozi Wa Chama Ngazi Ya Tawi</h3>
                            <div class="d-flex items-center justify-content-center gap-2">
                                <button data-bs-toggle="modal" data-bs-target="#ongezaKiongoziChamaModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajiri </button>
                                <a href="{{ route("super.areas.tawi.orodha", $branch->ward->id) }}" class="btn btn-primary btn-md mb-4">Rudi Kwenye Kata</a>
                            </div>
                        </div>
                        <div>
                            @php
                            $mwenyekiti = \App\Models\Post::where('deep', 'mwenyekiti_tawi')->first();
                            $katibu = \App\Models\Post::where('deep', 'katibu_tawi')->first();
                            $mwenezi = \App\Models\Post::where('deep', 'mwenezi_tawi')->first();
                            $mjumbe = \App\Models\Post::where('deep', 'mjumbe_tawi')->first();
                            @endphp


                            <div class="d-flex justify-start gap-4 flex-wrap">
                                @foreach( $branch->leaders->where('side', 'chama') as $leader )
                                    @if( $leader->pivot->isActive == true )
                                    <div class="text-center">
                                        <a class="fas fa-edit"  data-bs-toggle="modal" data-bs-target="#badiriTaarifaKiongoziChamaModal_{{ $leader->id }}"  data-bs-placement="top" title="Badilisha" href="#"></a>
                                        <h4 class="fs-5 text-capitalize">{{ $leader->firstName }} {{ $leader->lastName }}</h4>
                                        <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2">{{ \App\Models\Post::find( $leader->pivot->post_id )->name }}</small><br>
                                        <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2">{{ $leader->phone }}</small>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>


                         @foreach ($branch->leaders as $leader)
                                <x-system.modal id="badiriTaarifaKiongoziChamaModal_{{ $leader->id }}" aria="ongezaKiongoziKataLabel" size="modal-fullscreen" title="Ongeza Kiongozi Wa Chama Ngazi Ya Kata Hapa">
                                <x-slot:content>
                                        <x-system.edit-leader :leader="$leader" :route="route('super.leader.tawi.sasisha', $leader->id)" />
                                </x-slot:content>
                                </x-system.modal>
                        @endforeach


                        <!-- model location here -->
                        <x-system.modal id="ongezaKiongoziChamaModal" aria="orodhaTawiLabel" size="modal-fullscreen" title="Ongeza Kiongozi Wa Chama Ngazi Ya Tawi Hapa">
                            <x-slot:content>
                                <form method="post" action="{{ route('super.leader.tawi.ongeza') }}">
                                    @csrf
                                    <input type="hidden" value="chama" name="side">
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
                                                <label class="form-label" for="lastName">Jina La Mwisho</label>
                                                <input type="text" class="form-control" name="lastName" placeholder="eg: mgalanga simo">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="phone">Namba ya Simu</label>
                                                <input type="text" class="form-control" name="phone" placeholder="eg: 0678 987 897">

                                                <!-- data to simplify the validation process -->
                                                <input type="hidden" value="{{ $branch->id }}" class="form-control" name="side_id">
                                                <input type="hidden" value="branch_leader" class="form-control" name="table">
                                                <input type="hidden" value="branch_id" class="form-control" name="side_column">

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                <select class="form-control" name="post_id">
                                                    @foreach( \App\Models\Post::where('area', 'tawi')->where('side', 'chama')->get() as $post )
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


                    <div style="border-top: #9393; border-top-style: dashed; border-width: 2px;" class="py-3">
                        <div class="d-flex justify-content-md-between justify-content-center items-center flex-wrap-reverse">
                            <h3 class="fs-4 me-3">Viongozi Wa Serikali Ngazi Ya Tawi</h3>
                            <div class="d-flex items-center justify-content-center gap-2">
                                <button data-bs-toggle="modal" data-bs-target="#ongezaKiongoziSerikaliModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajiri </button>
                                <a href="{{ route("super.areas.tawi.orodha", $branch->ward->id) }}" class="btn btn-primary btn-md mb-4">Rudi Kwenye Kata</a>
                            </div>
                        </div>
                        <div>

                            <div class="d-flex justify-start gap-4 flex-wrap">
                                @foreach( $branch->leaders->where('side', 'serikali') as $leader )
                                    @if( $leader->pivot->isActive == true )
                                        <div class="text-center">
                                            <a class="fas fa-edit"  data-bs-toggle="modal" data-bs-target="#badiriTaarifaKiongoziSerikaliModal_{{ $leader->id }}"  data-bs-placement="top" title="Badilisha" href="#"></a>
                                            <h4 class="fs-5 text-capitalize">{{ $leader->firstName }} {{ $leader->lastName }}</h4>
                                            <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2">{{ \App\Models\Post::find( $leader->pivot->post_id )->name }}</small><br>
                                            <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2">{{ $leader->phone }}</small>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>


                        @foreach ($branch->leaders->where('side', 'serikali') as $leader)
                            <x-system.modal id="badiriTaarifaKiongoziSerikaliModal_{{ $leader->id }}" aria="ongezaKiongoziKataLabel" size="modal-fullscreen" title="Ongeza Kiongozi Wa Serikali Kata Hapa">
                                <x-slot:content>
                                    <x-system.edit-leader :leader="$leader" :route="route('super.leader.tawi.sasisha', $leader->id)" />
                                </x-slot:content>
                            </x-system.modal>
                        @endforeach


                    <!-- model location here -->
                        <x-system.modal id="ongezaKiongoziSerikaliModal" aria="orodhaTawiLabel" size="modal-fullscreen" title="Ongeza Tawi Hapa">
                            <x-slot:content>
                                <form method="post" action="{{ route('super.leader.tawi.ongeza') }}">
                                    @csrf
                                    <input type="hidden" value="serikali" name="side">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="firstName">Jina La Kwanza</label>
                                                <input type="text" class="form-control" name="firstName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="middleName">Jina La Kati</label>
                                                <input type="text" class="form-control" name="middleName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="lastName">Jina La Mwisho</label>
                                                <input type="text" class="form-control" name="lastName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="phone">Namba ya Simu</label>
                                                <input type="text" class="form-control" name="phone" placeholder="">

                                                <!-- data to simplify the validation process -->
                                                <input type="hidden" value="{{ $branch->id }}" class="form-control" name="side_id">
                                                <input type="hidden" value="branch_leader" class="form-control" name="table">
                                                <input type="hidden" value="branch_id" class="form-control" name="side_column">

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                <select class="form-control" name="post_id">
                                                    @foreach( \App\Models\Post::where('area', 'tawi')->where('side', 'serikali')->get() as $post )
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