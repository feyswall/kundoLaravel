<?php

/**
 * Created by feyswal on 1/12/2023.
 * Time 4:46 PM.
 * EastCoders & G3NET.
 * contacts: +255 628 960 877
 */
?>


@extends("layouts.assistants_system")

@section("content")
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="row" id="app">
    <div class="col-12">
        <div class="card">
            <a href="#checkout-orodhaKata-collapse" class="text-dark" data-bs-toggle="collapse">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2">
                        </i> </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="font-size-16 mb-1">Taarifa za Tarafa</h5>
                        </div>
                        <div class="flex-shrink-0"> <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                    </div>
                </div>
            </a>
            <div id="checkout-orodhaKata-collapse" class="collapse hide">
                <div class="p-4 border-top">
                    <div class="row">
                        <div class="col-12">
                            <div class="px-md-3">
                                <div>
                                    <div class="d-flex justify-content-md-start justify-content-center flex-wrap my-2">
                                        <h3 class="fs-5 me-3">Tarafa ya: <span class="fw-bold text-uppercase"> {{ $division->name }}</span></h3>
                                        <h3 class="fs-5 me-3">Halmashauri ya: <span class="fw-bold text-uppercase"> {{ $division->council->name }}</span></h3>
                                        <h3 class="fs-5 me-3">Wilaya ya: <span class="fw-bold text-uppercase"> {{ $division->council->district->name }}</span></h3>
                                        <h3 class="fs-5 me-3">Mkoa wa: <span class="fw-bold text-uppercase"> {{ $division->council->district->region->name }}</span></h3>
                                    </div>
                                    <div style="border-top: #9393; border-top-style: dashed; border-width: 2px;" class="py-3">
                                        <div class="d-flex justify-content-md-between justify-content-center items-center flex-wrap-reverse mb-3">
                                            <h3 class="fs-4 me-3">Viongozi wa chama Tarafa</h3>
                                            <button data-bs-toggle="modal" data-bs-target="#ongezaKiongoziChamaModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajili Kiongozi Wa Chama </button>
                                        </div>
                                        <div>
                                            <div class="d-flex justify-start gap-4 flex-wrap">
                                                @php
                                                    $districtLeaders = $division->leaders()->where('isActive', true)->get();
                                                    $chamaPostsWithLeaderCollection =
                                                    \App\Http\Controllers\Assistants\PostsController::postWithLeaders(
                                                    $districtLeaders, 'chama', 'tarafa');
                                                @endphp

                                                @foreach($chamaPostsWithLeaderCollection as $key => $leaderColl)
                                                    @php $ps = \App\Models\Post::find($key); @endphp
                                                    @foreach($leaderColl as $id => $ldr)
                                                        <div class="text-center">
                                                            <a class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Badilisha" href="{{ route("assistants.leader.kata.badili", $ldr->id ) }}">
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
                                                                        <input type="hidden" name="table" value="divisions">
                                                                        <input type="hidden" name="column_id" value="division_id">
                                                                        <input type="hidden" name="column_value" value="{{ $division->id }}">

                                                                        <input name='leader_id' value="{{ $ldr->id }}" type="hidden">
                                                                        <input name="post_id" value="{{ $ps->id }}" type="hidden">
                                                                        <button class="btn btn-danger btn-lg" type="submit">NDIO</button>
                                                                    </form>
                                                                </x-slot:content>
                                                            </x-system.assistant.modal>
                                                            <h4 class="fs-5 text-capitalize">{{ $ldr->firstName }} {{ $ldr->lastName }}</h4>
                                                            <small style="background: #f5f6f8;"
                                                            class="rounded text-black text-capitalize fw-bold px-2 py-2">{{ $ps->name }}</small>
                                                        </div>
                                                    @endforeach
                                                    <div class="row w-100"></div>
                                                @endforeach
                                                <hr>
                                            </div>
                                        </div>
                                        <!-- model location here -->
                                        <x-system.assistant.modal id="ongezaKiongoziChamaModal" aria="ongezaKiongoziTarafaLabel"
                                        size="modal-fullscreen" title="Ongeza Kiongozi Chama Tarafa Hapa">
                                            <x-slot:content>
                                                <button v-on:click="changeSides()"
                                                class="btn btn-success btn-sm mb-lg-4" type="button">
                                                     @{{ togglerBtnText }}
                                                </button>

                                                <form
                                                :class="{'d-none': !formToggler}"
                                                method="post"
                                                action="{{ route('assistants.leader.tarafa.ongeza') }}">
                                                    @csrf
                                                    <input type="hidden" name="side" value="chama">
                                                    <div class="row">
                                                        <x-system.assistant.leader-basic-inputs></x-system.assistant.leader-basic-inputs>
                                                        <div>
                                                            <!-- data to simplify the validation process -->
                                                            <input type="hidden" value="{{ $division->id }}" class="form-control" name="side_id">
                                                            <input type="hidden" value="division_leader" class="form-control" name="table">
                                                            <input type="hidden" value="division_id" class="form-control" name="side_column">
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                                <select class="form-control" name="post_id" required>
                                                                    @foreach( \App\Models\Post::where('area', 'tarafa')->where('side', 'chama')->get() as $post )
                                                                    <option {{ ( old('post_id') == $post->id) ? 'selected' : '' }} value="{{ $post->id }}">{{ $post->name }}</option>
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

                                                <form  method="post"
                                                action="{{ route('assistants.leader.tarafa.ongeza') }}"
                                                :class="{'d-none': formToggler}">
                                                    @csrf
                                                    <h4>Endapo Kiongozi Ameshasajiriwa Muongeze Wadhifa Hapa</h4>
                                                    <div class="col-sm-12 col-md-4 col-lg-3">
                                                        <div class="mb-3 mb-4">
                                                            <select class="form-control" name="leader_id">
                                                                <option value="">choose leader</option>
                                                                @foreach( \App\Models\Leader::select('id', 'firstName', 'lastName')
                                                                ->where('side', 'chama')->orderBy('firstName')->get() as $leader )
                                                                <option value="{{ $leader->id }}">{{ $leader->firstName }}  {{ $leader->lastName }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-4 col-lg-3">
                                                        <div class="mb-3 mb-4">
                                                            <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                            <select class="form-control" name="post_id" required>
                                                                @foreach( \App\Models\Post::where('area', 'tarafa')
                                                                ->where('side', 'chama')->get() as $post )
                                                                    <option value="{{ $post->id }}">{{ $post->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <!-- data to simplify the validation process -->
                                                            <input type="hidden" value="{{ $division->id }}" class="form-control" name="side_id">
                                                            <input type="hidden" value="division_leader" class="form-control" name="table">
                                                            <input type="hidden" value="division_id" class="form-control" name="side_column">
                                                            <input type="hidden" name="withLeader" value="true">
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
                        </div>
                    </div> <!-- end col -->

                    <div class="row">
                        <div class="col-12">
                            <div class="px-md-3">
                                <div>
                                    <div style="border-top: #9393; border-top-style: dashed; border-width: 2px;" class="py-3">
                                        <div class="d-flex justify-content-md-between justify-content-center items-center
                                         flex-wrap-reverse mb-3">
                                            <h3 class="fs-4 me-3">Viongozi Wa Serikali Tarafa</h3>
                                            <button data-bs-toggle="modal" data-bs-target="#ongezaKiongoziSerikaliModal"
                                             class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajili Kiongozi Wa Serikali </button>
                                        </div>
                                        <div>
                                            <div class="d-flex justify-start gap-4 flex-wrap">
                                                @php
                                                    $divisionLeaders = $division->leaders()->where('isActive', true)->get();
                                                    $serikaliPostsWithLeaderCollection =
                                                    \App\Http\Controllers\Assistants\PostsController::postWithLeaders(
                                                    $divisionLeaders, 'serikali', 'tarafa');
                                                @endphp

                                                @foreach($serikaliPostsWithLeaderCollection as $key => $leaderColl)
                                                    @php $ps = \App\Models\Post::find($key); @endphp
                                                    @foreach($leaderColl as $id => $ldr)
                                                        <div class="text-start">
                                                            <a class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top"
                                                             title="Badilisha" href="{{ route("assistants.leader.kata.badili", $ldr->id ) }}">
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
                                                                        <input type="hidden" name="table" value="divisions">
                                                                        <input type="hidden" name="column_id" value="division_id">
                                                                        <input type="hidden" name="column_value" value="{{ $division->id }}">

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
                                                                {{  $ps->name }}</small>
                                                        </div>
                                                    @endforeach
                                                    <div class="row w-100"></div>
                                                @endforeach
                                                <hr>
                                            </div>
                                        </div>
                                        <!-- model location here -->
                                        <x-system.assistant.modal id="ongezaKiongoziSerikaliModal" aria="ongezaKiongoziTarafaLabel"
                                         size="modal-fullscreen" title="Ongeza Kiongozi Wa Serikali Tarafa Hapa">
                                            <x-slot:content>
                                                <button v-on:click="changeSides()"
                                                class="btn btn-success btn-sm mb-lg-4" type="button" id="readyRegistered">
                                                     @{{ togglerBtnText }}
                                                </button>

                                                <form method="post"
                                                :class="{'d-none': formToggler}"
                                                action="{{ route('assistants.leader.tarafa.ongeza') }}">
                                                    @csrf
                                                    <input type="hidden" name="side" value="serikali">
                                                    <div class="row">
                                                        <x-system.assistant.leader-basic-inputs></x-system.assistant.leader-basic-inputs>
                                                        <div>
                                                             <!-- data to simplify the validation process -->
                                                             <input type="hidden" value="{{ $division->id }}" class="form-control" name="side_id">
                                                             <input type="hidden" value="division_leader" class="form-control" name="table">
                                                             <input type="hidden" value="division_id" class="form-control" name="side_column">
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                                <select class="form-control" name="post_id" required>
                                                                    @foreach( \App\Models\Post::where('area', 'tarafa')
                                                                    ->where('side', 'serikali')->get() as $post )
                                                                        <option {{ ( old('post_id') == $post->id) ? 'selected' : '' }} value="{{ $post->id }}">{{ $post->name }}</option>
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
                                                action="{{ route('assistants.leader.tarafa.ongeza') }}"
                                                :class="{'d-none': !formToggler}">
                                                    @csrf
                                                    <h4>Endapo Kiongozi Ameshasajiriwa Muongeze Wadhifa Hapa</h4>
                                                    <div class="col-sm-12 col-md-4 col-lg-3">
                                                        <div class="mb-3 mb-4">
                                                            <select class="form-control" name="leader_id">
                                                                <option value="">choose leader</option>
                                                                @foreach( \App\Models\Leader::select('id', 'firstName', 'lastName')
                                                                    ->orderBy('firstName')->get() as $leader )
                                                                <option value="{{ $leader->id }}">
                                                                    {{ $leader->firstName }}  {{ $leader->lastName }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-4 col-lg-3">
                                                        <div class="mb-3 mb-4">
                                                            <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                            <select class="form-control" name="post_id">
                                                                @foreach( \App\Models\Post::where('area', 'tarafa')
                                                                ->where('side', 'serikali')->get() as $post )
                                                                <option value="{{ $post->id }}">{{ $post->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <!-- data to simplify the validation process -->
                                                            <input type="hidden" value="{{ $division->id }}" class="form-control" name="side_id">
                                                            <input type="hidden" value="division_leader" class="form-control" name="table">
                                                            <input type="hidden" value="division_id" class="form-control" name="side_column">
                                                            <input type="hidden" name="withLeader" value="true">
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
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
    </div>
</div>

<x-system.assistant.collapse id="kamatiZaChamaTarafa" title="kamati Za Chama Ngazi ya Tarafa">
    <x-slot:content>
        @foreach( \App\Models\Group::with("posts.leaders")->where("basedOn", "tarafa")->where('side', 'chama')->get() as $group)
        <x-system.assistant.collapse :id="$group->deep" :title="strtoupper($group->name)">
            <x-slot:content>
                <x-system.assistant.groups-info :group="$group" :table="$division" />
            </x-slot:content>
        </x-system.assistant.collapse>
        @endforeach
    </x-slot:content>
</x-system.assistant.collapse>

<x-system.assistant.collapse id="kamatiZaSerikaliTarafa" title="kamati Za Serikali Ngazi ya Tarafa">
    <x-slot:content>
        @foreach( \App\Models\Group::with("posts.leaders")->where("basedOn", "tarafa")->where('side', 'serikali')->get() as $group)
            <x-system.assistant.collapse :id="$group->deep" :title="strtoupper($group->name)">
                <x-slot:content>
                    <x-system.assistant.groups-info :group="$group" :table="$division" />
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
                <h2 class="mb-0">Orodha Ya Kata</h2>
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
                    <button data-bs-toggle="modal" data-bs-target="#orodhaKataModal" class="btn btn-info btn-sm mb-4"><i class="fas fa-plus"> </i> Ongeza Kata</button>
                    <a href="{{ route('assistants.areas.tarafa.orodha', $division->council->id) }}" class="btn btn-primary btn-sm mb-4">Rudi Kwenye Halmashauri</a>
                    <x-system.assistant.kata-table :areas="$areas">
                    </x-system.assistant.kata-table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- model location here -->
    <x-system.assistant.modal id="orodhaKataModal" aria="orodhaHalmashauriLabel" size="modal-lg" title="Ongeza Kata Hapa">
        <x-slot:content>
            <form method="post" action="{{ route('assistants.areas.kata.ongeza') }}">
                @csrf
                <div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3 mb-4">
                                <label class="form-label" for="billing-name">Jina La Mkoa</label>
                                <input type="text" readonly class="form-control" value="Simiyu">
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
                            <button type="submit" name="submit" class="btn btn-primary btn-sm">Ongeza</button>
                        </div>
                    </div>
            </form>
        </x-slot:content>
    </x-system.assistant.modal>

</div> <!-- container-fluid -->
<!-- end main content-->
@endsection

@section("extra_script")
<x-system.table-script id="assistantsOrodhaKataTable">
</x-system.table-script>

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
