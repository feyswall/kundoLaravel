<?php
/**
  * Created by feyswal on 2/28/2023.
  * Time 1:05 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>

<?php
    $user = Illuminate\Support\Facades\Auth::user();
?>

@extends("layouts.general_system")

@section("content")
        @php
            $sials = App\Models\Sial::all();
            $desiredSials = [];
        @endphp
        @foreach ($sials as $sial)
            @if($sial->inToManyCopy($user) )
                @if($sial->inToManyCopy($user)->pivot)
                    @if( !($sial->inToManyCopy($user)->pivot->seen) )
                        @php $desiredSials[] = $sial;
                        @endphp
                    @endif
                @endif
            @endif

            @if($sial->inToManySend($user) )
                @if($sial->inToManySend($user)->pivot)
                    @if( !($sial->inToManySend($user)->pivot->seen) )
                        @php $desiredSials[] = $sial;
                        @endphp
                    @endif
                @endif
            @endif
        @endforeach
        @php
            $desiredSialsCollect = collect( $desiredSials );
        @endphp

        <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Nyumbani</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                            <li class="breadcrumb-item active">Nyumbani</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <a href="{{ route('general.sial.orodha')}}">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-end mt-2">
                                <div id="growth-chart"></div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1"><span data-plugin="counterup">
                                    {{ $desiredSialsCollect->count(); }}</span>
                                </h4>
                                <p class="text-muted mb-0">zisizosomwa</p>
                            </div>
                            <p class="text-muted mt-3 mb-0"><span class="text-success me-1">
                                <i class="mdi mdi-arrow-up-bold me-1"></i>{{ App\Models\Sial::all()->count() }}</span>
                                 Barua Zote
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- end col-->
        </div>
        <!-- end row-->
    </div>
    <!-- container-fluid -->
@endsection

@section("extra_script")
    <x-system.table-script id="datatable-viongoziWilayaTable" />
@endsection
