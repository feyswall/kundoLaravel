<?php
/**
  * Created by feyswal on 1/31/2023.
  * Time 5:24 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>


<?php

/**
 * Created by feyswal on 1/12/2023.
 * Time 11:58 AM.
 * EastCoders & G3NET.
 * contacts: +255 628 960 877
 */

use \Illuminate\Support\Facades\DB;
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
                                <h5 class="font-size-16 mb-1">Taarifa Kuhusiana Na Wilaya</h5>
                            </div>
                            <div class="flex-shrink-0"> <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
           <div class="card">
               <div class="card-body">
                    @foreach( $leaders as $key => $allLeader)
                        @php
                            $post = \App\Models\Post::find($key);
                        @endphp
                        <h3>{{ $post->name  }}</h3>
                        <div class="row mb-4">
                            @foreach( $allLeader as $keyl => $leader )
                                <div class="col-md-3 col-sm-12 col-12 p-3">
                                    <div class="text-center">
                                        <h4 class="fs-5 text-capitalize mb-1">{{ $leader->firstName }} {{ $leader->lastName }}</h4>
                                        <span class="d-block mb-2">{{ $leader->phone }}</span>
                                        <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2" >
                                            @php
                                                $area = $post->area;
                                                if ( $area == 'tawi'){
                                                    if ($leader->branches()->where('isActive', true)->first()) {
                                                        echo $leader->branches()->where('isActive', true)->first()->name;
                                                    }
                                                }elseif ( $area == 'kata'){
                                                    if ($leader->wards()->where('isActive', true)->first()) {
                                                        echo $leader->wards()->where('isActive', true)->first()->name;
                                                    }
                                                }elseif ( $area == 'tarafa'){
                                                    if ($leader->divisions()->where('isActive', true)->first()) {
                                                        echo $leader->divisions()->where('isActive', true)->first()->name;
                                                    }
                                                }elseif ( $area == 'halmashauri'){
                                                    if ($leader->councils()->where('isActive', true)->first()) {
                                                        echo $leader->councils()->where('isActive', true)->first()->name;
                                                    }
                                                }elseif ( $area == 'wilaya'){
                                                    if ($leader->districts()->where('isActive', true)->first()) {
                                                        echo $leader->districts()->where('isActive', true)->first()->name;
                                                    }
                                                }elseif ( $area == 'mkoa'){
                                                    if ($leader->regions()->where('isActive', true)->first()) {
                                                        echo $leader->regions()->where('isActive', true)->first()->name;

                                                    }
                                                }
                                            @endphp
                                        </small>
                                        <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2" >{{ $keyl + 1 }}</small>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endforeach
               </div>
           </div>
        </div>
    </div>


@endsection

@section("extra_script")
    <x-system.table-script id="superOrodhaHalmashauriTable" />
    <x-system.table-script id="superOrodhaJimboTable" />
@endsection
