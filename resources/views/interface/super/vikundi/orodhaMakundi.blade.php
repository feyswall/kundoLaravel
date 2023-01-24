<?php
/**
  * Created by feyswal on 1/17/2023.
  * Time 3:16 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>



@extends("layouts.super_system")

@section('extra_style')

@endsection

@section("content")
    <!-- Start right Content here -->
    <!-- ============================================================== -->
@foreach ($groups as $group)
    <x-system.collapse :id="$group->deep" :title="strtoupper($group->name)" >
        <x-slot:content>
           @foreach ($group->posts as $post)
           @php
                // $leader_id = Illuminate\Support\Facades\DB::table("leader_post")
                // ->where('isActive', 'true')
                // ->where('post_id', $post->id)
                // ->pluck('leader_id');
           @endphp
           <form method="POST" action="{{ route('super.group.toaWadhifa') }}" id="removePostForm">
            @csrf
             <input type="hidden" name="group" value="{{ $group->id }}">
             <input type="hidden" name="post" value="{{ $post->id }}">
           </form>

           <div class="row justify-content-start mb-3">
              <div class="col-md-6 col-sm-12">
                 <ol class="list-group list-group-numbered">
              <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                  <div class="fw-bold">{{ $post->name }}</div>
                </div>
                <button class="btn  btn-sm btn-danger" onclick="
                if(confirm('Bonyeza ndio kukubali  kutoa.')) {
                  let formOne = document.querySelector('#removePostForm');
                  formOne.submit();
                }
              " ><i>futa wadhifa</i></a></button>
              </li>
            </ol>
              </div>
           </div>

           @endforeach
               <button  data-bs-toggle="modal" data-bs-target="#ongezaWadhifaModal{{$group->id}}" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i>Ongeza wadhifa</button>



        </x-slot:content>
    </x-system.collapse>


      <x-system.modal id="ongezaWadhifaModal{{ $group->id }}" aria="ongezaWadhifaLabel" size="modal-lg" title="Ongeza Wadhifa Katika Kamati" >
            <x-slot:content>
              <form method="POST" action="{{ route('super.group.ongezaWadhifa') }}">
                @csrf
                <div class="row">
                    <select name="post" id="post" class="form-control mb-3">
                      @foreach ( App\Models\Post::all() as $post )
                        @if ( $group->posts->contains($post->id) )
                          <option value="{{ $post->id }}" class="text-danger" disabled><b>{{ $post->name }}</b></option>
                        @else
                        <option value="{{ $post->id }}">{{ $post->name }}</option>
                        @endif
                      @endforeach
                    </select>
                </div>
                <div class="row">
                  <input type="hidden" value="{{ $group->id }}" name="group">
                </div>
                <div>
                  <button type="submit" class="btn btn-md btn-primary">Ongeza</button>
                </div>
              </form>
            </x-slot:content>
      </x-system.modal>
@endforeach


@endsection

@section("extra_script")
    <x-system.table-script id="superOrodhaGroupsTable" />
@endsection
