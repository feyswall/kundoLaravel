@extends('layouts.super_system')
@section('content')
    {{dd($id)}}

    <x-system.modal id="badiliTaarifaKiongozi" aria="obadiliTaarifaKiongoziLabel" size="modal-fullscreen" title="Badili Taarifa za Kiongozi Mkoa" >
        <x-slot:content>
            {{-- {{ route('super.leader.mkoa.ongeza') }} --}}
            <form method="post" action="#">
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
                            <input type="hidden" value="" class="form-control" name="side_id" >
                            <input type="hidden" value="district_leader" class="form-control" name="table" >
                            <input type="hidden" value="district_id" class="form-control" name="side_column" >

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-3">
                        <div class="mb-3 mb-4">
                            <label class="form-label" for="wadhifa">Chagua Wadhifa</label>
                            <select class="form-control" name="post_id">
                                {{-- @foreach( \App\Models\Post::where('area', 'mkoa')->get() as $post )
                                    <option value="{{ $post->id }}">{{ $post->name }}</option>
                                @endforeach --}}
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
@endsection