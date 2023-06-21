<?php

/**
 * Created by feyswal on 1/13/2023.
 * Time 12:16 PM.
 * EastCoders & G3NET.
 * contacts: +255 628 960 877
 */
?>


@extends("layouts.assistants_system")

@section("content")
<!-- Start right Content here -->
<!-- ============================================================== -->

<div id="app">
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

        <x-system.assistant.collapse id="kamatiZaChamaTarafa" title="kamati Za Chama Ngazi ya Tawi">
            <x-slot:content>
                @foreach( \App\Models\Group::with("posts.leaders")->where("basedOn", "tawi")->where('side', 'chama')->get() as $group)
                    <x-system.assistant.collapse :id="$group->deep" :title="strtoupper($group->name)">
                        <x-slot:content>
                            <x-system.assistant.groups-info :group="$group" :table="$branch" />
                        </x-slot:content>
                    </x-system.assistant.collapse>
                @endforeach
            </x-slot:content>
        </x-system.assistant.collapse>

        <x-system.assistant.collapse id="kamatiZaSerikaliTarafa" title="kamati Za Serikali Ngazi ya Tawi">
            <x-slot:content>
                @foreach( \App\Models\Group::with("posts.leaders")->where("basedOn", "tawi")->where('side', 'serikali')->get() as $group)
                    <x-system.assistant.collapse :id="$group->deep" :title="strtoupper($group->name)">
                        <x-slot:content>
                            <x-system.assistant.groups-info :group="$group" :table="$branch" />
                        </x-slot:content>
                    </x-system.assistant.collapse>
                @endforeach
            </x-slot:content>
        </x-system.assistant.collapse>

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
                                <a href="{{ route("assistants.areas.tawi.orodha", $branch->ward->id) }}" class="btn btn-primary btn-md mb-4">Rudi Kwenye Kata</a>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-start gap-4 flex-wrap">
                                @php
                                    $serBranchLeaders = $branch->leaders()->where('isActive', true)->get();
                                    $serikaliPostsWithLeaderCollection = \App\Http\Controllers\assistants\PostsController::postWithLeaders(
                                    $serBranchLeaders, 'chama', 'tawi');
                                @endphp

                                @foreach($serikaliPostsWithLeaderCollection as $key => $leaderColl)
                                    @php $ps = \App\Models\Post::find($key); @endphp
                                    @foreach($leaderColl as $id => $ldr)
                                        <div class="text-start">
                                            <a class="fas fa-edit"  data-bs-toggle="modal"
                                               data-bs-target="#badiriTaarifaKiongoziChamaModal_{{ $ldr->id }}"
                                               data-bs-placement="top" title="Badilisha" href="#">
                                            </a>
                                            <a class="fas fa-trash text-danger"  data-bs-toggle="modal"
                                               data-bs-target="#futaTaarifaKiongoziChamaModal_{{ $ldr->id }}"
                                               data-bs-placement="top" title="Badilisha" href="#">
                                            </a>
                                            <x-system.assistant.modal id="futaTaarifaKiongoziChamaModal_{{ $ldr->id }}"
                                                            aria="futaKiongoziKataLabel" size="modal-sm"
                                                            title="Je Unahitaji Kumvua Madarakani Kiongozi?">
                                                <x-slot:content>
                                                   <x-system.assistant.unpower-form
                                                        :route="route('assistants.leader.unpower')"
                                                        table="branches"
                                                        column_id="branch_id"
                                                        :column_value="$branch->id"
                                                        :leader_id="$ldr->id"
                                                        :post_id="$ps->id"
                                                        >
                                                    </x-system.assistant.unpower-form>
                                                </x-slot:content>
                                            </x-system.assistant.modal>
                                            <h4 class="fs-5 text-capitalize">{{ $ldr->firstName }} {{ $ldr->lastName }}</h4>
                                            <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2">{{ $ps->name }}</small><br>
                                            <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2">{{ $ldr->phone }}</small>
                                        </div>
                                    @endforeach
                                    <div class="row w-100"></div>
                                @endforeach
                            </div>
                        </div>

                        @foreach ($serikaliPostsWithLeaderCollection as $leaderColl)
                            @foreach( $leaderColl as $id => $ldr )
                                <x-system.assistant.modal id="badiriTaarifaKiongoziChamaModal_{{ $ldr->id }}"
                                                aria="ongezaKiongoziKataLabel" size="modal-fullscreen"
                                                title="Ongeza Kiongozi Wa Chama Ngazi Ya Kata Hapa">
                                    <x-slot:content>
                                        <x-system.assistant.edit-leader :leader="$ldr"
                                                              :route="route('assistants.leader.tawi.sasisha', $ldr->id)" />
                                    </x-slot:content>
                                </x-system.assistant.modal>
                        @endforeach
                    @endforeach

                    <!-- model location here -->
                        <x-system.assistant.modal id="ongezaKiongoziChamaModal" aria="orodhaTawiLabel"
                                        size="modal-fullscreen" title="Ongeza Kiongozi Wa Chama Ngazi Ya Tawi Hapa">
                            <x-slot:content>

                            <button v-on:click="changeSides()"
                                    class="btn btn-success btn-sm mb-lg-4" type="button" id="readyRegistered">
                                @{{ togglerBtnText }}
                            </button>

                                <form method="post" action="{{ route('assistants.leader.tawi.ongeza') }}"
                                     :class="{'d-none': formToggler}">
                                    @csrf
                                    <input type="hidden" value="chama" name="side">
                                    <div class="row">
                                        <x-system.assistant.leader-basic-inputs></x-system.assistant.leader-basic-inputs>
                                        <div>
                                            <!-- data to simplify the validation process -->
                                            <input type="hidden" value="{{ $branch->id }}" class="form-control" name="side_id">
                                            <input type="hidden" value="branch_leader" class="form-control" name="table">
                                            <input type="hidden" value="branch_id" class="form-control" name="side_column">
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                <select class="form-control" name="post_id" required>
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

                                <form  method="post"
                                        action="{{ route('assistants.leader.tawi.ongeza') }}"
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
                                            <input type="hidden" value="{{ $branch->id }}" class="form-control" name="side_id">
                                            <input type="hidden" value="branch_leader" class="form-control" name="table">
                                            <input type="hidden" value="branch_id" class="form-control" name="side_column">
                                            <input type="hidden" name="withLeader" value="true">
                                            <input type="hidden" value="chama" name="side">
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
                                                <button type="submit" name="submit" class="btn btn-primary btn-sm">Ongeza</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </x-slot:content>
                        </x-system.assistant.modal>
                    </div>


                    <div style="border-top: #9393; border-top-style: dashed; border-width: 2px;" class="py-3">
                        <div class="d-flex justify-content-md-between justify-content-center items-center flex-wrap-reverse">
                            <h3 class="fs-4 me-3">Viongozi Wa Serikali Ngazi Ya Tawi</h3>
                            <div class="d-flex items-center justify-content-center gap-2">
                                <button data-bs-toggle="modal" data-bs-target="#ongezaKiongoziSerikaliModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajiri </button>
                                <a href="{{ route("assistants.areas.tawi.orodha", $branch->ward->id) }}"
                                    class="btn btn-primary btn-md mb-4">Rudi Kwenye Kata</a>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-start gap-4 flex-wrap">
                                @php
                                    $serBranchLeaders = $branch->leaders()->where('isActive', true)->get();
                                    $serikaliPostsWithLeaderCollection = \App\Http\Controllers\assistants\PostsController::postWithLeaders(
                                    $serBranchLeaders, 'serikali', 'tawi');
                                @endphp

                                @foreach($serikaliPostsWithLeaderCollection as $key => $leaderColl)
                                    @php $ps = \App\Models\Post::find($key); @endphp
                                    @foreach($leaderColl as $id => $ldr)
                                        <div class="text-start">
                                            <a class="fas fa-edit"  data-bs-toggle="modal"
                                                data-bs-target="#badiriTaarifaKiongoziSerikaliModal_{{ $ldr->id }}"
                                                data-bs-placement="top" title="Badilisha" href="#">
                                            </a>
                                            <a class="fas fa-trash text-danger"  data-bs-toggle="modal"
                                               data-bs-target="#futaTaarifaKiongoziSerikaliModal_{{ $ldr->id }}"
                                               data-bs-placement="top" title="Badilisha" href="#">
                                            </a>
                                            <x-system.assistant.modal id="futaTaarifaKiongoziSerikaliModal_{{ $ldr->id }}"
                                                aria="futaKiongoziKataLabel" size="modal-sm"
                                                title="Je Unahitaji Kumvua Madarakani Kiongozi?">
                                                <x-slot:content>
                                                    <x-system.assistant.unpower-form
                                                        :route="route('assistants.leader.unpower')"
                                                        table="branches"
                                                        column_id="branch_id"
                                                        :column_value="$branch->id"
                                                        :leader_id="$ldr->id"
                                                        :post_id="$ps->id"
                                                        >
                                                    </x-system.assistant.unpower-form>
                                                </x-slot:content>
                                            </x-system.assistant.modal>
                                            <h4 class="fs-5 text-capitalize">{{ $ldr->firstName }} {{ $ldr->lastName }}</h4>
                                            <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2">{{ $ps->name }}</small><br>
                                            <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2">{{ $ldr->phone }}</small>
                                        </div>
                                    @endforeach
                                    <div class="row w-100"></div>
                                @endforeach
                            </div>
                        </div>


                        @foreach ($serikaliPostsWithLeaderCollection as $key => $leaderColl)
                            @foreach($leaderColl as $id => $ldr)
                                <x-system.assistant.modal id="badiriTaarifaKiongoziSerikaliModal_{{ $ldr->id }}"
                                                aria="ongezaKiongoziKataLabel" size="modal-fullscreen"
                                                title="Ongeza Kiongozi Wa Serikali Kata Hapa">
                                    <x-slot:content>
                                        <x-system.assistant.edit-leader :leader="$ldr"
                                            :route="route('assistants.leader.tawi.sasisha', $ldr->id)" />
                                    </x-slot:content>
                                </x-system.assistant.modal>
                            @endforeach
                        @endforeach


                        <!-- model location here -->
                        <x-system.assistant.modal id="ongezaKiongoziSerikaliModal" aria="orodhaTawiLabel"
                                        size="modal-fullscreen" title="Ongeza Tawi Hapa">
                            <x-slot:content>
                                <button v-on:click="changeSides()"
                                        class="btn btn-success btn-sm mb-lg-4" type="button" id="readyRegistered">
                                    @{{ togglerBtnText }}
                                </button>

                                <form
                                    method="post"
                                    :class="{'d-none': !formToggler}"
                                    action="{{ route('assistants.leader.tawi.ongeza') }}">
                                    @csrf
                                    <div class="row">
                                        <x-system.assistant.leader-basic-inputs></x-system.assistant.leader-basic-inputs>
                                        <div>
                                            <!-- data to simplify the validation process -->
                                            <input type="hidden" value="{{ $branch->id }}" class="form-control" name="side_id">
                                            <input type="hidden" value="branch_leader" class="form-control" name="table">
                                            <input type="hidden" value="branch_id" class="form-control" name="side_column">
                                            <input type="hidden" value="serikali" name="side">

                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                <select class="form-control" name="post_id" required>
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

                                <form  method="post"
                                       action="{{ route('assistants.leader.tawi.ongeza') }}"
                                       :class="{'d-none': formToggler}">
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
                                            <input type="hidden" value="{{ $branch->id }}" class="form-control" name="side_id">
                                            <input type="hidden" value="branch_leader" class="form-control" name="table">
                                            <input type="hidden" value="branch_id" class="form-control" name="side_column">
                                            <input type="hidden" name="withLeader" value="true">
                                            <input type="hidden" value="serikali" name="side">
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                <select class="form-control" name="post_id" required>
                                                    @foreach( \App\Models\Post::where('area', 'tawi')->where('side', 'serikali ')->get() as $post )
                                                        <option {{ (old('post_id') == $post->id) ? 'selected' : '' }} value="{{ $post->id }}">{{ $post->name }}</option>
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
    </div> <!-- container-fluid -->

    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div>
                    <h2>Orodha ya Mashina</h2>
                    <button data-bs-toggle="modal" data-bs-target="#ongezaShinaModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Ongeza Shina</button>
                    <x-system.assistant.shina-table :trunks="$trunks" :branch="$branch"></x-system.assistant.shina-table>

                    <!-- model location here -->
                    <x-system.assistant.modal id="ongezaShinaModal" aria="ongezaShinaLabel" size="modal-lg" title="Ongeza Shina Hapa Tarafa Hapa">
                        <x-slot:content>
                            <form method="post" action="{{ route('assistants.areas.shina.ongeza') }}">
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
                                                <input type="text" class="form-control" readonly value="{{ $branch->ward->division->council->district->name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="billing-name">Jina La Halmashauri</label>
                                                <input type="text" class="form-control" readonly value="{{ $branch->ward->division->council->name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="billing-name">Jina La Tarafa</label>
                                                <input type="text" class="form-control" readonly value="{{ $branch->ward->division->name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="billing-name">Jina La Kata</label>
                                                <input type="text" class="form-control" readonly value="{{ $branch->ward->name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="billing-name">Jina La Tawi</label>
                                                <input type="text" class="form-control" readonly value="{{ $branch->name }}">
                                                <input type="hidden" name="branch_id" class="form-control" readonly value="{{ $branch->id }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3 mb-4">
                                                <label class="form-label" for="billing-name">Jina La Shina</label>
                                                <input type="text" name="shina" class="form-control" placeholder="" required>
                                            </div>
                                            @error("shina")
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
<!-- end main content-->
</div>

@endsection


@section("extra_script")
    <x-system.assistant.table-script id="assistantsOrodhaShinaTable"></x-system.assistant.table-script>
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
