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
                                            <h3 class="fs-4">Viongozi wa Kichama Mkoa</h3>
                                            <button  data-bs-toggle="modal" data-bs-target="#ongezaKiongoziChamaModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajili kiongozi Wa Chama Mkoa</button>
                                        </div>
                                        <div>
                                            <div class="d-flex justify-start gap-4 flex-wrap">
                                                @php
                                                    $wardLeaders = $region->leaders()->where('isActive', true)->get();
                                                    $chamaPostsWithLeaderCollection = \App\Http\Controllers\Super\PostsController::postWithLeaders(
                                                    $wardLeaders, 'chama', 'mkoa');
                                                @endphp
                                                @foreach($chamaPostsWithLeaderCollection as $key => $leaderColl)
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
                                                    <x-system.modal id="futaTaarifaKiongoziChamaModal_{{ $ldr->id }}" aria="futaKiongoziKataLabel"
                                                         size="modal-sm" title="Je Unahitaji Kumvua Madarakani Kiongozi?">
                                                        <x-slot:content>
                                                            <form action="{{ route('super.leader.unpower')}}" method="POST">
                                                                @csrf
                                                                @method('put')
                                                                <input type="hidden" name="table" value="regions">
                                                                <input type="hidden" name="column_id" value="region_id">
                                                                <input type="hidden" name="column_value" value="{{ $region->id }}">

                                                                <input name='leader_id' value="{{ $ldr->id }}" type="hidden">
                                                                <input name="post_id" value="{{ $ps->id }}" type="hidden">
                                                                <button class="btn btn-danger btn-lg" type="submit">NDIO</button>
                                                            </form>
                                                        </x-slot:content>
                                                    </x-system.modal>
                                                        <h4 class="fs-5 text-capitalize">{{ $ldr->firstName }} {{ $ldr->lastName }}</h4>
                                                        <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2" >{{ $ps->name }}</small><br>
                                                        <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2" >+{{ $ldr->phone }}</small>
                                                    </div>
                                                    @endforeach
                                                    <div class="row w-100"></div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @foreach ($chamaPostsWithLeaderCollection as $leaderColl)
                                            @foreach( $leaderColl as $ldr )
                                                <x-system.modal id="badiriTaarifaKiongoziChamaModal_{{ $ldr->id }}"
                                                                aria="ongezaKiongoziKataLabel" size="modal-fullscreen"
                                                                title="Ongeza Kiongozi Wa Wilaya Hapa">
                                                    <x-slot:content>
                                                        <x-system.edit-leader :leader="$ldr"
                                                                              :route="route('super.leader.mkoa.sasisha', $ldr->id )" />
                                                    </x-slot:content>
                                                </x-system.modal>
                                            @endforeach
                                        @endforeach
                                        <!-- model location here -->
                                        <x-system.modal id="ongezaKiongoziChamaModal" aria="ongezaKiongoziMkoaLabel" size="modal-fullscreen" title="Ongeza Kiongozi Wa Chama Mkoa Hapa" >
                                            <x-slot:content>
                                                <form method="post" action="{{ route('super.leader.mkoa.ongeza') }}">
                                                    @csrf
                                                    <input type="hidden" name="side" value="chama">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="firstName">Jina La Kwanza</label>
                                                                <input type="text" class="form-control" name="firstName"  value="{{ old('firstName') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="middleName">Jina La Kati</label>
                                                                <input type="text" class="form-control" name="middleName" value="{{ old('middleName') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="lastName">Jila La Mwisho</label>
                                                                <input type="text" class="form-control" name="lastName" value="{{ old('lastName') }} ">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                                            <div class="mb-3 mb-4">
                                                                <label class="form-label" for="phone">Namba ya Simu</label>
                                                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">

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
                                                                    @foreach( \App\Models\Post::where('area', 'mkoa')->where('side', 'chama')->get() as $post )
                                                                        <option {{ ( old('post_id') == $post->id ) ? 'selected' : ''}} value="{{ $post->id }}">{{ $post->name }}</option>
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
                        </div>




                                <!-- end row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="p-2">
                                        <div style="border-top: #9393; border-top-style: dashed; border-width: 2px;" class="py-3">
                                            <div class="d-flex justify-content-between mb-3">
                                                <h3 class="fs-4">Viongozi wa Kiserikali Mkoa</h3>
                                                <button  data-bs-toggle="modal" data-bs-target="#ongezaKiongoziSerikaliModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajili kiongozi Wa Serikali Mkoa</button>
                                            </div>
                                            <div>
                                                <div class="d-flex justify-start gap-4 flex-wrap">
                                                    @php
                                                        $wardLeaders = $region->leaders()->where('isActive', true)->get();
                                                        $serikaliPostsWithLeaderCollection = \App\Http\Controllers\Super\PostsController::postWithLeaders(
                                                        $wardLeaders, 'serikali', 'mkoa');
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
                                                            <x-system.modal id="futaTaarifaKiongoziSerikaliModal_{{ $ldr->id }}" aria="futaKiongoziKataLabel"
                                                                 size="modal-sm" title="Je Unahitaji Kumvua Madarakani Kiongozi?">
                                                                <x-slot:content>
                                                                    <form action="{{ route('super.leader.unpower')}}" method="POST">
                                                                        @csrf
                                                                        @method('put')
                                                                        <input type="hidden" name="table" value="regions">
                                                                        <input type="hidden" name="column_id" value="region_id">
                                                                        <input type="hidden" name="column_value" value="{{ $region->id }}">

                                                                        <input name='leader_id' value="{{ $ldr->id }}" type="hidden">
                                                                        <input name="post_id" value="{{ $ps->id }}" type="hidden">
                                                                        <button class="btn btn-danger btn-lg" type="submit">NDIO</button>
                                                                    </form>
                                                                </x-slot:content>
                                                            </x-system.modal>
                                                                <h4 class="fs-5 text-capitalize">{{ $ldr->firstName }} {{ $ldr->lastName }}</h4>
                                                                <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2" >{{ $ps->name }}</small>
                                                                <br>
                                                                <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2" >+{{ $ldr->phone }}</small>

                                                            </div>
                                                        @endforeach
                                                        <div class="row w-100"></div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @foreach ($serikaliPostsWithLeaderCollection as $leaderColl)
                                                @foreach( $leaderColl as $ldr )
                                                    <x-system.modal id="badiriTaarifaKiongoziSerikaliModal_{{ $ldr->id }}"
                                                                    aria="badiri taarifa katika mkoa" size="modal-fullscreen"
                                                                    title="Badiri Taarifa apa">
                                                        <x-slot:content>
                                                            <x-system.edit-leader :leader="$ldr"
                                                                                  :route="route('super.leader.mkoa.sasisha', $ldr->id )" />
                                                        </x-slot:content>
                                                    </x-system.modal>
                                            @endforeach
                                        @endforeach
                                            <!-- model location here -->
                                            <x-system.modal id="ongezaKiongoziSerikaliModal" aria="ongezaKiongoziMkoaLabel" size="modal-fullscreen" title="Ongeza Kiongozi Wa Serikali Mkoa Hapa" >
                                                <x-slot:content>
                                                    <form method="post" action="{{ route('super.leader.mkoa.ongeza') }}">
                                                        @csrf
                                                        <input type="hidden" name="side" value="serikali">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-4 col-lg-3">
                                                                <div class="mb-3 mb-4">
                                                                    <label class="form-label" for="firstName">Jina La Kwanza</label>
                                                                    <input type="text" class="form-control" name="firstName"  value="{{ old('firstName') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-4 col-lg-3">
                                                                <div class="mb-3 mb-4">
                                                                    <label class="form-label" for="middleName">Jina La Kati</label>
                                                                    <input type="text" class="form-control" name="middleName" value="{{ old('middleName') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-4 col-lg-3">
                                                                <div class="mb-3 mb-4">
                                                                    <label class="form-label" for="lastName">Jila La Mwisho</label>
                                                                    <input type="text" class="form-control" name="lastName" value="{{ old('lastName') }} ">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-4 col-lg-3">
                                                                <div class="mb-3 mb-4">
                                                                    <label class="form-label" for="phone">Namba ya Simu</label>
                                                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">

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
                                                                        @foreach( \App\Models\Post::where('area', 'mkoa')->where('side', 'serikali')->get() as $post )
                                                                            <option {{ ( old('post_id') == $post->id ) ? 'selected' : ''}} value="{{ $post->id }}">{{ $post->name }}</option>
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





                            </div>
                            <!-- end row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <x-system.collapse id="kamatiZaChamaMkoa" title="Chama Mkoa">
                <x-slot:content>
                    @foreach( \App\Models\Group::with("posts")->where("basedOn", "mkoa")->where('side', 'chama')->get() as $group)
                            <x-system.collapse :id="$group->deep" :title="strtoupper($group->name)">
                                <x-slot:content>
                                    <x-system.groups-info :group="$group" :table="$region"/>
                                </x-slot:content>
                            </x-system.collapse>
                        @endforeach
                </x-slot:content>
            </x-system.collapse>


            <x-system.collapse id="kamatiZaSerikaliMkoa" title="Serikali Mkoa">
                <x-slot:content>
                    @foreach( \App\Models\Group::with("posts")->where("basedOn", "mkoa")->where('side', 'serikali')->get() as $group)
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
