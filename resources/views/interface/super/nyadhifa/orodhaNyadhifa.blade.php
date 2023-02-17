<?php
/**
  * Created by feyswal on 1/26/2023.
  * Time 4:44 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>



@extends("layouts.super_system")

@section('extra_style')

@endsection

@section("content")

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">Taarifa Za Nyadhifa</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">sms</a></li>
                            <li class="breadcrumb-item active">orodha</li>
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
                        <button  data-bs-toggle="modal" data-bs-target="#ongezaWadhifaModal_" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i>Ongeza wadhifa</button>
                        <x-system.wadhifa-table id="wadhifaTable" :posts="$posts" />
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->
    <!-- end main content-->
    <x-system.modal id="ongezaWadhifaModal_" aria="ongezaWadhifaLabel" size="modal-lg" title="Fomu ya Kuongeza wadhifa" >
        <x-slot:content>
            <form method="POST" action="{{ route('super.posts.ongeza') }}" class="p-3">
                @csrf
                <input type="hidden" name="side" value="{{ $side }}">
                <div class="row">
                    <label for="area">Ngazi Ya:</label>
                    <select name="area" id="area" class="form-control mb-3">
                        <option value="mkoa">Mkoa</option>
                        <option value="wilaya">Wilaya</option>
                        <option value="halmashauri">Halmashauri</option>
                        <option value="tarafa">Tarafa</option>
                        <option value="kata">Kata</option>
                        <option value="tawi">tawi</option>
                    </select>
                </div>
                <div class="row">
                    <label for="post">Jina</label>
                    <input type="text" value="{{ old('post') }}" class="form-control" name="post">
                </div>
                <div class="row">
                    <label for="count">Idadi Ruhusiwa</label>
                    <input type="number" value="{{ old('count') }}" class="form-control" name="count">
                    @error('count')
                     <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-md btn-primary">Ongeza</button>
                </div>
            </form>
        </x-slot:content>
    </x-system.modal>
    <div class="m-auto">
      {!! $posts->links() !!}
    </div>

@endsection

@section("extra_script")
    <x-system.table-script id="wadhifaTable" />
@endsection

