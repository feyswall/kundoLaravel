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
                            <h5 class="font-size-16 mb-1">Taarifa Kuhusiana Na Kata ya <b>{{ $ward->name }}</b></h5>
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
                                        <h3 class="fs-5 me-3">Kata ya: <span class="fw-bold text-uppercase"> {{ $ward->name }}</span></h3>
                                        <h3 class="fs-5 me-3">Tarafa ya: <span class="fw-bold text-uppercase"> {{ $ward->division->name }}</span></h3>
                                        <h3 class="fs-5 me-3">Halmashauri ya: <span class="fw-bold text-uppercase"> {{ $ward->division->council->name }}</span></h3>
                                        <h3 class="fs-5 me-3">Wilaya ya: <span class="fw-bold text-uppercase"> {{ $ward->division->council->district->name }}</span></h3>
                                        <h3 class="fs-5 me-3">Mkoa wa: <span class="fw-bold text-uppercase"> {{ $ward->division->council->district->region->name }}</span></h3>
                                    </div>
                                    <div style="border-top: #9393; border-top-style: dashed; border-width: 2px;" class="py-3">
                                        <div class="d-flex justify-content-md-between justify-content-center items-center flex-wrap-reverse mb-3">
                                            <h3 class="fs-4 me-3">Viongozi Wa Chama Kata</h3>
                                            <button data-bs-toggle="modal" data-bs-target="#ongezaKiongoziChamaModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajili Kiongozi Wa Chama</button>
                                        </div>

                                        <div>
                                            <div class="d-flex justify-start gap-4 flex-wrap">
                                                @php
                                                $wardLeaders = $ward->leaders->where('side', 'chama');
                                                $postValue = '';
                                                @endphp
                                                @foreach( $wardLeaders  as $leader )
                                                    @if( $leader->pivot->isActive == true )
                                                        @php
                                                            $postName = \App\Models\Post::find( $leader->pivot->post_id )->name;
                                                        @endphp
                                                        <div class="text-center">
                                                            <a class="fas fa-edit"  data-bs-toggle="modal" data-bs-target="#badiriTaarifaKiongoziChamaModal_{{ $leader->id }}"  data-bs-placement="top" title="Badilisha" href="#"></a>
                                                            <a class="fas fa-trash text-danger"  data-bs-toggle="modal"
                                                            data-bs-target="#futaTaarifaKiongoziChamaModal_{{ $leader->id }}"
                                                            data-bs-placement="top" title="Badilisha" href="#">
                                                            </a>
                                                        <x-system.modal id="futaTaarifaKiongoziChamaModal_{{ $leader->id }}" aria="futaKiongoziKataLabel"
                                                             size="modal-sm" title="Je Unahitaji Kumvua Madarakani Kiongozi?">
                                                            <x-slot:content>
                                                                <form action="{{ route('super.leader.unpower')}}" method="POST">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="hidden" name="table" value="wards">
                                                                    <input type="hidden" name="column_id" value="ward_id">
                                                                    <input type="hidden" name="column_value" value="{{ $ward->id }}">

                                                                    <input name='leader_id' value="{{ $leader->id }}" type="hidden">
                                                                    <input name="post_id" value="{{ $leader->pivot->post_id }}" type="hidden">
                                                                    <button class="btn btn-danger btn-lg" type="submit">NDIO</button>
                                                                </form>
                                                            </x-slot:content>
                                                        </x-system.modal>
                                                            <h4 class="fs-5 text-capitalize">{{ $leader->firstName }} {{ $leader->lastName }}</h4>
                                                            <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2">{{ $postName }}</small>
                                                        </div>
                                                        @if( $postValue == $postName )
                                                        @else
                                                            @php $postValue = $postName; @endphp
                                                            <div class="row w-100"></div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                <hr>
                                            </div>
                                        </div>
                                        @foreach ( $ward->leaders->where('side', 'chama') as $leader)
                                             <x-system.modal id="badiriTaarifaKiongoziChamaModal_{{ $leader->id }}" aria="ongezaKiongoziKataLabel" size="modal-fullscreen" title="Ongeza Kiongozi Wa Kata Hapa">
                                                <x-slot:content>
                                                     <x-system.edit-leader :leader="$leader" :route="route('super.leader.kata.sasisha', $leader->id)" />
                                                </x-slot:content>
                                             </x-system.modal>
                                        @endforeach
                                        <!-- model location here -->
                                        <x-system.modal id="ongezaKiongoziChamaModal" aria="ongezaKiongoziKataLabel" size="modal-fullscreen" title="Ongeza Kiongozi Wa Kata Hapa">
                                            <x-slot:content>
                                                <form method="post" action="{{ route('super.leader.kata.ongeza') }}">
                                                    @csrf
                                                    <input type="hidden" name="side" value="chama">
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
                                                                <input type="hidden" value="{{ $ward->id }}" class="form-control" name="side_id">
                                                                <input type="hidden" value="leader_ward" class="form-control" name="table">
                                                                <input type="hidden" value="ward_id" class="form-control" name="side_column">

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                                <select class="form-control" name="post_id">
                                                                    @foreach( \App\Models\Post::where('area', 'kata')->where('side', 'chama')->get() as $post )
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

                    <div class="row">
                        <div class="col-12">
                            <div class="px-md-3">
                                <div>
                                    <div style="border-top: #9393; border-top-style: dashed; border-width: 2px;" class="py-3">
                                        <div class="d-flex justify-content-md-between justify-content-center items-center flex-wrap-reverse mb-3">
                                            <h3 class="fs-4 me-3">Viongozi Wa Serikali Kata</h3>
                                            <button data-bs-toggle="modal" data-bs-target="#ongezaKiongoziSerikaliModal"
                                            class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajili Kiongozi Wa Serikali</button>

                                        </div>

                                        <div>
                                            <div class="d-flex justify-start gap-4 flex-wrap">
                                                @foreach( $ward->leaders->where('side', 'serikali') as $leader )
                                                    @if( $leader->pivot->isActive == true )
                                                        <div class="text-center">
                                                            <a class="fas fa-edit"  data-bs-toggle="modal" data-bs-target="#badiriTaarifaKiongoziSerikaliModal_{{ $leader->id }}"  data-bs-placement="top" title="Badilisha" href="#"></a>
                                                            <a class="fas fa-trash text-danger"  data-bs-toggle="modal"
                                                            data-bs-target="#futaTaarifaKiongoziSerikaliModal_{{ $leader->id }}"
                                                            data-bs-placement="top" title="Badilisha" href="#">
                                                            </a>
                                                        <x-system.modal id="futaTaarifaKiongoziSerikaliModal_{{ $leader->id }}" aria="futaKiongoziKataLabel"
                                                             size="modal-sm" title="Je Unahitaji Kumvua Madarakani Kiongozi?">
                                                            <x-slot:content>
                                                                <form action="{{ route('super.leader.unpower')}}" method="POST">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="hidden" name="table" value="wards">
                                                                    <input type="hidden" name="column_id" value="ward_id">
                                                                    <input type="hidden" name="column_value" value="{{ $ward->id }}">

                                                                    <input name='leader_id' value="{{ $leader->id }}" type="hidden">
                                                                    <input name="post_id" value="{{ $leader->pivot->post_id }}" type="hidden">
                                                                    <button class="btn btn-danger btn-lg" type="submit">NDIO</button>
                                                                </form>
                                                            </x-slot:content>
                                                        </x-system.modal>
                                                            <h4 class="fs-5 text-capitalize">{{ $leader->firstName }} {{ $leader->lastName }}</h4>
                                                            <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2">{{ \App\Models\Post::find( $leader->pivot->post_id )->name }}</small>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                <hr>
                                            </div>
                                        </div>
                                        @foreach ( $ward->leaders->where('side', 'serikali') as $leader)
                                            <x-system.modal id="badiriTaarifaKiongoziSerikaliModal_{{ $leader->id }}" aria="ongezaKiongoziKataLabel" size="modal-fullscreen" title="Ongeza Kiongozi Wa Serikali Kata Hapa">
                                                <x-slot:content>
                                                    <x-system.edit-leader :leader="$leader" :route="route('super.leader.kata.sasisha', $leader->id)" />
                                                </x-slot:content>
                                            </x-system.modal>
                                    @endforeach
                                    <!-- model location here -->
                                        <x-system.modal id="ongezaKiongoziSerikaliModal" aria="ongezaKiongoziKataLabel" size="modal-fullscreen" title="Ongeza Kiongozi Wa Kata Hapa">
                                            <x-slot:content>
                                                <form method="post" action="{{ route('super.leader.kata.ongeza') }}">
                                                    @csrf
                                                    <input type="hidden" name="side" value="serikali">
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
                                                                <input type="hidden" value="{{ $ward->id }}" class="form-control" name="side_id">
                                                                <input type="hidden" value="leader_ward" class="form-control" name="table">
                                                                <input type="hidden" value="ward_id" class="form-control" name="side_column">

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                                                                <select class="form-control" name="post_id">
                                                                    @foreach( \App\Models\Post::where('area', 'kata')->where('side', 'serikali')->get() as $post )
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




<x-system.collapse id="kamatiZaChamaKata" title="kamati Za Chama Ngazi ya Kata">
    <x-slot:content>
        @foreach( \App\Models\Group::with("posts.leaders")->where("basedOn", "Kata")->where('side', 'chama')->get() as $group)
        <x-system.collapse :id="$group->deep" :title="strtoupper($group->name)">
            <x-slot:content>
                <x-system.groups-info :group="$group" :table="$ward" />
            </x-slot:content>
        </x-system.collapse>
        @endforeach
    </x-slot:content>
</x-system.collapse>


<x-system.collapse id="kamatiZaSerikaliKata" title="kamati Za Serikali Ngazi ya Kata">
    <x-slot:content>
        @foreach( \App\Models\Group::with("posts.leaders")->where("basedOn", "Kata")->where('side', 'serikali')->get() as $group)
            <x-system.collapse :id="$group->deep" :title="strtoupper($group->name)">
                <x-slot:content>
                    <x-system.groups-info :group="$group" :table="$ward" />
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
                <h2 class="mb-0">Orodha Ya Matawi</h2>
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

                    <button data-bs-toggle="modal" data-bs-target="#orodhaTawiModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Ongeza Tawi</button>
                    <a href="{{ route('super.areas.kata.orodha', $ward->division->id) }}" class="btn btn-primary btn-md mb-4">Rudi Kwenye Kata</a>

                    <x-system.tawi-table :areas="$areas">
                    </x-system.tawi-table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- model location here -->
    <x-system.modal id="orodhaTawiModal" aria="orodhaTawiLabel" size="modal-lg" title="Ongeza Tawi Hapa">
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
