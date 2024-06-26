<?php

/**
 * Created by feyswal on 1/12/2023.
 * Time 11:58 AM.
 * EastCoders & G3NET.
 * contacts: +255 628 960 877
 */

use \Illuminate\Support\Facades\DB;
?>

@extends("layouts.assistants_system")

@section("content")
    <div  id="app">
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
                                <div class="flex-shrink-0"><i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                </div>
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
                                                <h3 class="fs-5 me-3">Wilaya ya: <span class="fw-bold text-uppercase">
                                                     {{ $district->name }}</span></h3>
                                                <h3 class="fs-5 me-3">Mkoa wa: <span class="fw-bold text-uppercase">
                                                     {{ $district->region->name }}</span></h3>
                                            </div>
                                            <div style="border-top: #9393; border-top-style: dashed; border-width: 2px;"
                                            class="py-3">
                                                <div class="d-flex justify-content-md-between justify-content-center
                                                 items-center mb-3 flex-wrap-reverse">
                                                    <h3 class="fs-4 me-3">Viongozi Wa Chama Wilaya</h3>
                                                    <button data-bs-toggle="modal" data-bs-target="#ongezaKiongoziChamaModal"
                                                            class="btn btn-info btn-md mb-4 text-capitalize">
                                                            <i class="fas fa-plus"> </i>
                                                        Sajiri kiongozi Wa Chama wilaya
                                                    </button>
                                                </div>
                                                <div>
                                                    <div class="d-flex justify-start gap-4 flex-wrap">
                                                        @php
                                                            $districtLeaders = $district->leaders()->where('isActive', true)
                                                            ->get();
                                                            $chamaPostsWithLeaderCollection =
                                                                \App\Http\Controllers\Assistants\PostsController::postWithLeaders(
                                                                $districtLeaders, 'chama', 'wilaya');
                                                        @endphp

                                                        @foreach($chamaPostsWithLeaderCollection as $key => $leaderColl)
                                                            @php $ps = \App\Models\Post::find($key); @endphp
                                                            @foreach($leaderColl as $id => $ldr)
                                                                <div class="text-start">
                                                                    <a class="fas fa-edit"  data-bs-toggle="modal"
                                                                       data-bs-target="#badiriTaarifaKiongoziChamaModal_{{ $ldr->id }}"
                                                                       data-bs-placement="top" title="Badilisha" href="#">
                                                                    </a>

                                                                    {{-- <a class="fas fa-trash text-danger"  data-bs-toggle="modal"
                                                                       data-bs-target="#futaTaarifaKiongoziChamaModal_{{ $ldr->id }}"
                                                                       data-bs-placement="top" title="Badilisha" href="#">
                                                                    </a> --}}
                                                                    <x-system.assistant.modal id="futaTaarifaKiongoziChamaModal_{{ $ldr->id }}" aria="futaKiongoziKataLabel"
                                                                                    size="modal-sm" title="Je Unahitaji Kumvua Madarakani Kiongozi?">
                                                                        <x-slot:content>
                                                                            <form action="{{ route('assistants.leader.unpower')}}" method="POST">
                                                                                @csrf
                                                                                @method('put')
                                                                                <input type="hidden" name="table" value="districts">
                                                                                <input type="hidden" name="column_id" value="district_id">
                                                                                <input type="hidden" name="column_value" value="{{ $district->id }}">

                                                                                <input name='leader_id' value="{{ $ldr->id }}" type="hidden">
                                                                                <input name="post_id" value="{{ $ps->id }}" type="hidden">
                                                                                <button class="btn btn-danger btn-lg" type="submit">NDIO</button>
                                                                            </form>
                                                                        </x-slot:content>
                                                                    </x-system.assistant.modal>
                                                                    <h4 class="fs-5 text-capitalize">{{ $ldr->firstName }} {{ $ldr->lastName }}</h4>
                                                                    <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2">
                                                                        {{ $ps->name }}</small><br>
                                                                    <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2">
                                                                        +{{ $ldr->phone }}</small>
                                                                </div>
                                                            @endforeach
                                                            <div class="row w-100"></div>
                                                        @endforeach
                                                        <hr>
                                                    </div>
                                                </div>
                                                @foreach ($chamaPostsWithLeaderCollection as $leaderColl)
                                                    @foreach( $leaderColl as $ldr )
                                                        <x-system.assistant.modal id="badiriTaarifaKiongoziChamaModal_{{ $ldr->id }}"
                                                                        aria="ongezaKiongoziKataLabel" size="modal-fullscreen"
                                                                        title="Ongeza Kiongozi Wa Wilaya Hapa">
                                                            <x-slot:content>
                                                                <x-system.assistant.edit-leader :leader="$ldr" :route="route('assistants.leader.wilaya.sasisha', $ldr->id )" />
                                                            </x-slot:content>
                                                        </x-system.assistant.modal>
                                                    @endforeach
                                                @endforeach
                                                <!-- model location here -->
                                                <x-system.assistant.modal id="ongezaKiongoziChamaModal" aria="ongezaKiongoziWilayaLabel" size="modal-fullscreen" title="Ongeza Kiongozi Wa Chama  Hapa">
                                                    <x-slot:content>
                                                        <button v-on:click="changeSides()"
                                                                class="btn btn-success btn-sm mb-lg-4" type="button" id="readyRegistered">
                                                            @{{ togglerBtnText }}
                                                        </button>
                                                        <form method="post"
                                                              :class="{'d-none': formToggler}"
                                                              action="{{ route('assistants.leader.wilaya.ongeza') }}">
                                                            @csrf
                                                            <div class="row">
                                                                <x-system.assistant.leader-basic-inputs></x-system.assistant.leader-basic-inputs>
                                                                <div>
                                                                    <!-- data to simplify the validation process -->
                                                                    <input type="hidden" value="{{ $district->id }}" class="form-control" name="side_id">
                                                                    <input type="hidden" value="district_leader" class="form-control" name="table">
                                                                    <input type="hidden" value="district_id" class="form-control" name="side_column">
                                                                    <input type="hidden" name="side" value="chama">
                                                                </div>
                                                                <div class="col-sm-12 col-md-4 col-lg-3">
                                                                    <div class="mb-3 mb-4">
                                                                        <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                                        <select class="form-control" name="post_id" required>
                                                                            @php $posts = \App\Models\Post::where('area', 'wilaya')->where('side', 'chama')->get(); @endphp
                                                                            @foreach( $posts as $post )
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
                                                        <form  method="post"
                                                               action="{{ route('assistants.leader.wilaya.ongeza') }}"
                                                               :class="{'d-none': !formToggler}">
                                                            @csrf
                                                            <h4>Endapo Kiongozi Ameshasajiriwa Muongeze Wadhifa Hapa</h4>
                                                            <div class="col-sm-12 col-md-4 col-lg-3">
                                                                <div class="mb-3 mb-4">
                                                                    <select class="form-control" name="leader_id" required>
                                                                        <option value="">choose leader</option>
                                                                        @foreach( \App\Models\Leader::select('id', 'firstName', 'lastName')->orderBy('firstName')->get() as $ldr )
                                                                            <option value="{{ $ldr->id }}">{{ $ldr->firstName }}  {{ $ldr->lastName }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div>
                                                                    <!-- data to simplify the validation process -->
                                                                    <input type="hidden" value="{{ $district->id }}" class="form-control" name="side_id">
                                                                    <input type="hidden" value="district_leader" class="form-control" name="table">
                                                                    <input type="hidden" value="district_id" class="form-control" name="side_column">
                                                                    <input type="hidden" name="withLeader" value="true">
                                                                    <input type="hidden" value="chama" name="side">
                                                                </div>
                                                                <div class="col-sm-12 col-md-4 col-lg-3">
                                                                    <div class="mb-3 mb-4">
                                                                        <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                                        <select class="form-control" name="post_id" required>
                                                                            @foreach( \App\Models\Post::where('area', 'wilaya')->where('side', 'chama')->get() as $post )
                                                                                <option value="{{ $post->id }}">{{ $post->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">Ongeza</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </x-slot:content>
                                                </x-system.assistant.modal>
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
                                                    <h3 class="fs-4 me-3">Viongozi Wa Serikali Wilaya</h3>
                                                    <button data-bs-toggle="modal" data-bs-target="#ongezaKiongoziSerikaliModal" class="btn btn-info btn-md mb-4 text-capitalize"><i class="fas fa-plus"> </i> Sajiri kiongozi Wa Serikali wilaya </button>
                                                </div>
                                                <div>
                                                    <div class="d-flex justify-start gap-4 flex-wrap">
                                                        @php
                                                            $districtLeaders = $district->leaders()->where('isActive', true)->get();
                                                            $serikaliPostsWithLeaderCollection = \App\Http\Controllers\assistants\PostsController::postWithLeaders(
                                                            $districtLeaders, 'serikali', 'wilaya');
                                                        @endphp

                                                        @foreach($serikaliPostsWithLeaderCollection as $key => $leaderColl)
                                                            @php $ps = \App\Models\Post::find($key); @endphp
                                                            @foreach($leaderColl as $id => $ldr)
                                                                <div class="text-center">
                                                                    <a class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top"
                                                                       title="Badilisha" href="{{ route("assistants.leader.wilaya.badili", $ldr->id ) }}">
                                                                    </a>
                                                                    {{-- <a class="fas fa-trash text-danger"  data-bs-toggle="modal"
                                                                       data-bs-target="#futaTaarifaKiongoziSerikaliModal_{{ $ldr->id }}"
                                                                       data-bs-placement="top" title="Badilisha" href="#">
                                                                    </a> --}}
                                                                    <x-system.assistant.modal id="futaTaarifaKiongoziSerikaliModal_{{ $ldr->id }}" aria="futaKiongoziKataLabel"
                                                                                    size="modal-sm" title="Je Unahitaji Kumvua Madarakani Kiongozi?">
                                                                        <x-slot:content>
                                                                            <form action="{{ route('assistants.leader.unpower')}}" method="POST">
                                                                                @csrf
                                                                                @method('put')
                                                                                <input type="hidden" name="table" value="districts">
                                                                                <input type="hidden" name="column_id" value="district_id">
                                                                                <input type="hidden" name="column_value" value="{{ $district->id }}">

                                                                                <input name='leader_id' value="{{ $ldr->id }}" type="hidden">
                                                                                <input name="post_id" value="{{ $ps->id }}" type="hidden">
                                                                                <button class="btn btn-danger btn-lg" type="submit">NDIO</button>
                                                                            </form>
                                                                        </x-slot:content>
                                                                    </x-system.assistant.modal>
                                                                    <h4 class="fs-5 text-capitalize">{{ $ldr->firstName }} {{ $ldr->lastName }}</h4>
                                                                    <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2">{{ $ps->name  }}</small>
                                                                </div>
                                                            @endforeach
                                                            <div class="row w-100"></div>
                                                        @endforeach
                                                        <hr>
                                                    </div>
                                                </div>
                                                <!-- model location here -->
                                                <x-system.assistant.modal id="ongezaKiongoziSerikaliModal" aria="ongezaKiongoziWilayaLabel" size="modal-fullscreen" title="Ongeza Kiongozi Wa Serikali Hapa">
                                                    <x-slot:content>
                                                        <button v-on:click="changeSides()"
                                                                class="btn btn-success btn-sm mb-lg-4" type="button" id="readyRegistered">
                                                            @{{ togglerBtnText }}
                                                        </button>
                                                        <form method="post"
                                                              :class="{'d-none': formToggler}"
                                                            action="{{ route('assistants.leader.wilaya.ongeza') }}">
                                                            @csrf
                                                            <input type="hidden" name="side" value="serikali">
                                                            <div class="row">
                                                                <x-system.assistant.leader-basic-inputs>?</x-system.assistant.leader-basic-inputs>
                                                                <div>
                                                                    <!-- data to simplify the validation process -->
                                                                    <input type="hidden" value="{{ $district->id }}" class="form-control" name="side_id">
                                                                    <input type="hidden" value="district_leader" class="form-control" name="table">
                                                                    <input type="hidden" value="district_id" class="form-control" name="side_column">
                                                                    <input type="hidden" name="side" value="serikali">
                                                                </div>
                                                                <div class="col-sm-12 col-md-4 col-lg-3">
                                                                    <div class="mb-3 mb-4">
                                                                        <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                                        <select class="form-control" name="post_id">
                                                                            @php
                                                                                $posts = \App\Models\Post::where('area', 'wilaya')
                                                                                ->where('side', 'serikali')->get();
                                                                            @endphp
                                                                            @foreach( $posts as $post )
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
                                                        <form  method="post"
                                                               action="{{ route('assistants.leader.wilaya.ongeza') }}"
                                                               :class="{'d-none': !formToggler}">
                                                            @csrf
                                                            <h4>Endapo Kiongozi Ameshasajiriwa Muongeze Wadhifa Hapa</h4>
                                                            <div class="col-sm-12 col-md-4 col-lg-3">
                                                                <div class="mb-3 mb-4">
                                                                    <select class="form-control" name="leader_id" required>
                                                                        <option value="">choose leader</option>
                                                                        @foreach( \App\Models\Leader::select('id', 'firstName', 'lastName')->orderBy('firstName')->get() as $ldr )
                                                                            <option value="{{ $ldr->id }}">{{ $ldr->firstName }}  {{ $ldr->lastName }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div>
                                                                    <!-- data to simplify the validation process -->
                                                                    <input type="hidden" value="{{ $district->id }}" class="form-control" name="side_id">
                                                                    <input type="hidden" value="district_leader" class="form-control" name="table">
                                                                    <input type="hidden" value="district_id" class="form-control" name="side_column">
                                                                    <input type="hidden" name="withLeader" value="true">
                                                                    <input type="hidden" value="serikali" name="side">
                                                                </div>
                                                                <div class="col-sm-12 col-md-4 col-lg-3">
                                                                    <div class="mb-3 mb-4">
                                                                        <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                                        <select class="form-control" name="post_id">
                                                                            @foreach( \App\Models\Post::where('area', 'wilaya')->where('side', 'serikali')->get() as $post )
                                                                                <option value="{{ $post->id }}">{{ $post->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">Ongeza</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </x-slot:content>
                                                </x-system.assistant.modal>
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

        <x-system.assistant.collapse id="kamatiZaChamaWilaya" title="kamati Za Chama wilaya">
            <x-slot:content>
                @foreach( \App\Models\Group::with("posts.leaders")->where("basedOn", "wilaya")->where('side', 'chama')->get() as $group)
                    <x-system.assistant.collapse :id="$group->deep" :title="strtoupper($group->name)">
                        <x-slot:content>
                            <x-system.assistant.groups-info :group="$group" :table="$district" />
                        </x-slot:content>
                    </x-system.assistant.collapse>
                @endforeach
            </x-slot:content>
        </x-system.assistant.collapse>

        <x-system.assistant.collapse id="kamatiZaWilaya" title="kamati Za Serikali wilaya">
            <x-slot:content>
                @foreach( \App\Models\Group::with("posts.leaders")->where("basedOn", "wilaya")->where('side', 'serikali')->get() as $group)
                    <x-system.assistant.collapse :id="$group->deep" :title="strtoupper($group->name)">
                        <x-slot:content>
                            <x-system.assistant.groups-info :group="$group" :table="$district" />
                        </x-slot:content>
                    </x-system.assistant.collapse>
                @endforeach
            </x-slot:content>
        </x-system.assistant.collapse>

        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h2 class="mb-0">Orodha Ya Halmashauri</h2>
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
                            <button data-bs-toggle="modal" data-bs-target="#orodhaHalmashauriModal" class="btn btn-info btn-sm mb-4"><i class="fas fa-plus"> </i> Ongeza Halmashauri</button>
                            <a href="{{ route('assistants.areas.wilaya.orodha') }}" class="btn btn-primary btn-sm mb-4">Rudi Mkoani</a>
                            <x-system.assistant.halmashauri-table :district="$district" :areas="$areas" :headers="['Jina la Halmashauri','Idadi ya Tarafa','Idadi Ya Kata', 'Idadi ya Matawi', '']" />
                            <!-- model location here -->
                            <x-system.assistant.modal id="orodhaHalmashauriModal" aria="orodhaHalmashauriLabel" size="modal-lg" title="Ongeza Halmashauri Hapa">
                                <x-slot:content>
                                    <form method="post" action="{{ route('assistants.areas.halmashauri.ongeza') }}">
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
                                                        <input type="text" name="halmashauri" class="form-control" value="{{ old('halmashauri') }}">
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
                            </x-system.assistant.modal>
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
                        <div>
                            <h2>Orodha ya Majimbo</h2>
                            <button data-bs-toggle="modal" data-bs-target="#orodhaJimboModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Ongeza Majimbo</button>

                            <x-system.assistant.jimbo-table :states="$states" :district="$district"></x-system.assistant.jimbo-table>

                        </div>
                        <!-- model location states here -->
                        <x-system.assistant.modal id="orodhaJimboModal" aria="orodhaJimboLabel" size="modal-lg" title="Ongeza Jimbo Hapa">
                            <x-slot:content>
                                <form method="post" action="{{ route('assistants.areas.jimbo.ongeza') }}">
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
                        </x-system.assistant.modal>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("extra_script")
<x-system.assistant.table-script id="assistantsOrodhaHalmashauriTable" />
<x-system.assistant.table-script id="assistantsOrodhaJimboTable" />
<script>
        let app =  new Vue({
            el: '#app',
            data() {
                return {
                    formToggler: true,
                    togglerBtnText: 'kwa aliyesajiriwa',
                }
            },
            methods: {
                changeSides: function(){
                    this.formToggler = !this.formToggler;
                    this.togglerBtnText = ( this.formToggler ? 'kwa aliyesajiriwa' : 'sajiri mpya');
                }
            },
        });
    </script>
@endsection
