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
    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <a href="#checkout-orodhaKata-collapse" class="text-dark" data-bs-toggle="collapse">
                    <div class="p-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i> </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1"></h5>Orodha ya viongozi
                            </div>
                            <div class="flex-shrink-0"> <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-12">
           <div class="card">
               <div class="card-body">
                <div class="mb-3">
                    <h4 class="text-lead">{{  $group->name  }}</h4>
                </div>
                <div>
                    <a
                        class="btn btn-sm btn-primary mb-2"
                        href="{{ url()->previous() }}">
                        <iconify-icon icon="material-symbols:settings-backup-restore"></iconify-icon>
                             Nyuma
                    </a>
                </div>
                <table id="superLeadersGroupTable" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <th>Wadhifa</th>
                        <th>Jina</th>
                        <th>Simu</th>
                        {{-- <th>eneo</th> --}}
                        <th>#</th>
                        <th></th>
                    </thead>
                    <tbody>

                    @foreach( $leaders as $key => $allLeader)
                        @php
                            $post = \App\Models\Post::find($key);
                        @endphp
                        @foreach( $allLeader as $keyl => $leader )
                        <tr>
                            <td>{{ $post->name  }}</td>
                            <td>{{ strtolower($leader->firstName) }} {{ strtolower($leader->lastName) }}</td>
                            <td class="d-block mb-2">{{ $leader->phone }}</td>
                            {{-- <td style="" class="" >
                                <p>
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
                                </p>
                            </td> --}}
                            <td style="background: #f5f6f8;"
                                class="rounded text-black text-capitalize fw-bold px-2 py-2" >{{ $keyl + 1 }}
                            </td>
                            <td><a href="{{ route('super.leader.fungua', $leader->id) }}" class="btn btn-sm btn-primary"><span class="fas fa-folder-open""></span></a></td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
           </div>
        </div>
    </div>


@endsection

@section("extra_script")

    <script>
        var tableTitle = "{{ strtoupper($group->name) }}";
        $ (document).ready (function () {
            $ (
                '#datatable'
            ).DataTable (), $ ('#superLeadersGroupTable')
                .DataTable ({
                    "iDisplayLength": 30,
                    lengthChange: !1,
                    buttons: [{
                        extend: 'pdfHtml5',
                        title: tableTitle,
                    },
                    {
                        extend: 'excelHtml5',
                        title: tableTitle
                    }
                ],

                    "order": [[ 0, "asc" ]],
                    columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets:   0
                    }],
                select: {
                style:    'os',
                selector: 'td:first-child'
                    },
                order: [[ 0, 'asc' ]]
            })
            .buttons ()
            .container ().appendTo ('#superLeadersGroupTable_wrapper .col-md-6:eq(0)'), $ ('.dataTables_length select')
            .addClass ('form-select form-select-sm');
        });
    </script>

@endsection

