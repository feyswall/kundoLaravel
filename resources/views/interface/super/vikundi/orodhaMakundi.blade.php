<?php
/**
  * Created by feyswal on 1/17/2023.
  * Time 3:16 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>



@extends("layouts.super_system")

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
            <h3>{{ $post->name }}</h3>
           @endforeach
           <button class="btn btn-primary btn-md mt-3" type="submit">ongeza kiongozi</button>
           <button class="btn btn-danger btn-md mt-3" type="submit">toa kiongozi</button>
        </x-slot:content>
    </x-system.collapse>
@endforeach


@endsection

@section("extra_script")
    <x-system.table-script id="superOrodhaHalmashauriTable" />
@endsection
