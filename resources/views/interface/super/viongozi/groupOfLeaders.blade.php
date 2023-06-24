<?php
/**
  * Created by feyswal on 1/8/2023.
  * Time 4:38 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>

@extends("layouts.super_system")

@section("content")
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Orodha Viongozi</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                            <li class="breadcrumb-item active">orodha</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <!-- start row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="m-5">

                        </div>
                        <a href="{{ $backRoute }}" class="btn btn-sm btn-success mb-4">rudi nyuma</a>
                        <table id="viongoziWilayaTable"
                         class="table table-sm table-striped table-bordered dt-responsive nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th><input type="checkbox" name="select_all" value="1" id="viongoziWilayaTable-select-all"></th>
                                <th>Majina Kamili</th>
                                <th>Simu</th>
                                <th>wadhifa & maeneo</th>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $leaders as $leader )
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checker" name="leader_id" value="{{ $leader->id }}">
                                    </td>
                                    <td>{{ $leader->firstName }} {{ $leader->middleName == 'null' ? "" : $leader->mddleName }} {{ $leader->lastName  }} </td>
                                    <td>{{ $leader->phone }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($leader->posts as $post)
                                                <li>{{ $post->name }} - <b>{{ $post->area }}</b></li>
                                                    @php
                                                        $area_id = 0;
                                                        $relation_table = null;
                                                        $side_column = null;
                                                        $area_type = null;
                                                        $area = null;

                                                        $side_value = $post->id;
                                                        $leader_id = $leader->id;
                                                    @endphp

                                                @if ($post->area == 'shina')
                                                    @php
                                                        $relation_table = 'leader_trunk';
                                                        $side_column = 'trunk_id';
                                                        $area_type = 'App\Models\Trunk';
                                                        $area_string = 'Shina la ';
                                                        $area =  App\Http\Controllers\Super\AreasController::search_for_area(
                                                            $relation_table,
                                                            $side_column,
                                                            $side_value,
                                                            $leader_id,
                                                            $area_type
                                                        );
                                                        $branch = $area->branch;
                                                        $ward = $area->ward;
                                                        $division = $area->division;
                                                        $council = $area->council;
                                                        $district = $area->district;
                                                        $region = $area->region;
                                                        $area_stack = 'mkoa - '.$region->name.' | ';
                                                        $area_stack .= 'wilaya - '.$district->name.' | ';
                                                        $area_stack .= 'halmashauri - '.$council->name.' | ';
                                                        $area_stack .= 'tarafa - '.$division->name.' | ';
                                                        $area_stack .= 'kata - '.$ward->name.' | ';
                                                        $area_stack .= 'branch - '.$branch->name.' | ';
                                                        if($area){
                                                            echo "<p>".$area_stack."</p>";
                                                            echo $area_string.' <b>'.$area->name.'</b>';
                                                        }
                                                    @endphp
                                                @endif

                                                @if ($post->area == 'tawi')
                                                    @php
                                                        $relation_table = 'branch_leader';
                                                        $side_column = 'branch_id';
                                                        $area_type = 'App\Models\Branch';
                                                        $area_string = 'tawi la ';

                                                        $area =  App\Http\Controllers\Super\AreasController::search_for_area(
                                                            $relation_table,
                                                            $side_column,
                                                            $side_value,
                                                            $leader_id,
                                                            $area_type
                                                        );
                                                        $ward = $area->ward;
                                                        $division = $area->division;
                                                        $council = $area->council;
                                                        $district = $area->district;
                                                        $region = $area->region;
                                                        $area_stack = 'mkoa - '.$region->name.' | ';
                                                        $area_stack .= 'wilaya - '.$district->name.' | ';
                                                        $area_stack .= 'halmashauri - '.$council->name.' | ';
                                                        $area_stack .= 'tarafa - '.$division->name.' | ';
                                                        $area_stack .= 'kata - '.$ward->name.' | ';
                                                        if($area){
                                                            echo "<p>".$area_stack."</p>";
                                                            echo $area_string.' <b>'.$area->name.'</b>';
                                                        }
                                                    @endphp
                                                @endif

                                                @if ($post->area == 'kata')
                                                    @php
                                                        $relation_table = 'leader_ward';
                                                        $side_column = 'ward_id';
                                                        $area_type = 'App\Models\Ward';
                                                        $area_string = 'kata ya ';
                                                        $area =  App\Http\Controllers\Super\AreasController::search_for_area(
                                                            $relation_table,
                                                            $side_column,
                                                            $side_value,
                                                            $leader_id,
                                                            $area_type
                                                        );
                                                        $division = $area->division;
                                                        $council = $area->council;
                                                        $district = $area->district;
                                                        $region = $area->region;
                                                        $area_stack = 'mkoa - '.$region->name.' | ';
                                                        $area_stack .= 'wilaya - '.$district->name.' | ';
                                                        $area_stack .= 'halmashauri - '.$council->name.' | ';
                                                        $area_stack .= 'tarafa - '.$division->name.' | ';
                                                        if($area){
                                                            echo "<p>".$area_stack."</p>";
                                                            echo $area_string.' <b>'.$area->name.'</b>';
                                                        }
                                                    @endphp
                                                @endif

                                                @if ($post->area == 'tarafa')
                                                    @php
                                                        $relation_table = 'division_leader';
                                                        $side_column = 'division_id';
                                                        $area_type = 'App\Models\Division';
                                                        $area_string = 'tarafa ya ';

                                                        $area =  App\Http\Controllers\Super\AreasController::search_for_area(
                                                            $relation_table,
                                                            $side_column,
                                                            $side_value,
                                                            $leader_id,
                                                            $area_type
                                                        );
                                                        $council = $area->council;
                                                        $district = $area->district;
                                                        $region = $area->region;
                                                        $area_stack = 'mkoa - '.$region->name.' | ';
                                                        $area_stack .= 'wilaya - '.$district->name.' | ';
                                                        $area_stack .= 'halmashauri - '.$council->name.' | ';
                                                        if($area){
                                                            echo "<p>".$area_stack."</p>";
                                                            echo $area_string.' <b>'.$area->name.'</b>';
                                                        }
                                                    @endphp
                                                @endif

                                                @if ($post->area == 'halmashauri')
                                                    @php
                                                        $relation_table = 'council_leader';
                                                        $side_column = 'council_id';
                                                        $area_type = 'App\Models\Council';
                                                        $area_string = 'halmashauri ya ';

                                                        $area =  App\Http\Controllers\Super\AreasController::search_for_area(
                                                            $relation_table,
                                                            $side_column,
                                                            $side_value,
                                                            $leader_id,
                                                            $area_type
                                                        );
                                                        $district = $area->district;
                                                        $region = $area->region;
                                                        $area_stack = 'mkoa - '.$region->name.' | ';
                                                        $area_stack .= 'wilaya - '.$district->name.' | ';
                                                        if($area){
                                                            echo "<p>".$area_stack."</p>";
                                                            echo $area_string.' <b>'.$area->name.'</b>';
                                                        }
                                                    @endphp
                                                @endif

                                                @if ($post->area == 'wilaya')
                                                    @php
                                                        $relation_table = 'district_leader';
                                                        $side_column = 'district_id';
                                                        $area_type = 'App\Models\District';
                                                        $area_string = 'wilaya ya ';

                                                        $area =  App\Http\Controllers\Super\AreasController::search_for_area(
                                                            $relation_table,
                                                            $side_column,
                                                            $side_value,
                                                            $leader_id,
                                                            $area_type
                                                        );
                                                        $region = $area->region;
                                                        $area_stack = 'mkoa - '.$region->name.' | ';
                                                        if($area){
                                                            echo "<p>".$area_stack."</p>";
                                                            echo $area_string.' <b>'.$area->name.'</b>';
                                                        }
                                                    @endphp
                                                @endif


                                                @if ($post->area == 'jimbo')
                                                    @php
                                                        $relation_table = 'leader_state';
                                                        $side_column = 'state_id';
                                                        $area_type = 'App\Models\State';
                                                        $area_string = 'jimbo la ';

                                                        $area =  App\Http\Controllers\Super\AreasController::search_for_area(
                                                            $relation_table,
                                                            $side_column,
                                                            $side_value,
                                                            $leader_id,
                                                            $area_type
                                                        );
                                                        $district = $area->district;
                                                        $region = $area->region;
                                                        $area_stack = 'mkoa - '.$region->name.' | ';
                                                        $area_stack .= 'wilaya - '.$district->name.' | ';
                                                        if($area){
                                                            echo "<p>".$area_stack."</p>";
                                                            echo $area_string.' <b>'.$area->name.'</b>';
                                                        }
                                                    @endphp
                                                @endif

                                                @if ($post->area == 'mkoa')
                                                    @php
                                                        $relation_table = 'leader_region';
                                                        $side_column = 'region_id';
                                                        $area_type = 'App\Models\Region';
                                                        $area_string = 'mkoa wa simiyu';
                                                    @endphp
                                                @endif

                                                @php

                                                @endphp


                                                <ul class="mb-2">
                                                    @foreach ($post->groups as $group)
                                                        <li>{{ $group->name }}</li>
                                                    @endforeach
                                                </ul>
                                            @endforeach
                                        </ul>
                                    </td>
                                     <td>
                                       <div style="display: inline-block">
                                        <a class="float-left btn btn-sm btn-success"
                                            href="{{ route('super.leader.fungua', $leader->id)}}">
                                            fungua
                                        </a>
                                        {{-- <a class="float-left btn btn-sm btn-warning"  data-bs-toggle="modal"
                                            data-bs-target="#badiriTaarifaKiongoziModal_{{ $leader->id }}"
                                            data-bs-placement="top" title="Badilisha" href="#">
                                            badiri
                                        </a> --}}
                                       </div>
                                     </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
                @foreach ($leaders as $leader)
                    <x-system.modal id="badiriTaarifaKiongoziModal_{{ $leader->id }}" aria="ongezaKiongoziKataLabel" size="modal-fullscreen" title="Ongeza Kiongozi Wa Kata Hapa">
                        <x-slot:content>
                            <x-system.edit-leader :leader="$leader" :route="route('super.leader.kata.sasisha', $leader->id)" />
                        </x-slot:content>
                    </x-system.modal>
                @endforeach
                    <!-- end row -->
                    <x-system.modal id="sendTextSms" aria="sendSms" size="modal-lg" title="Tuma Sms Hapa">
                <x-slot:content>
                    <form id="sendTextSmsFormId" name="sendTextSmsForm" method="post">
                        <div class="mb-3">
                            <label for="message">Meseji</label>
                            <textarea rows="7" type="text" class="form-control" name="message"></textarea>
                        </div>
                        <div>
                            <button id="smsInFormBtn" class="btn btn-primary btn-md" type="submit">tuma</button>
                        </div>
                        <div class="mt-3">
                                @php $resultBalance = \App\Http\Controllers\SmsServicesControlller::checkBalance(); @endphp
                                @if ( $resultBalance['status'] )
                                    @if ( $resultBalance['status'] == 'success' )
                                        @if( isset($resultBalance['response']->data) )
                                                <h4>Balance {{ $resultBalance['response']->data->credit_balance; }}</h4>
                                                <h4>Utaweza kutuma SMS {{ \App\Http\Controllers\SmsServicesControlller::supportedSms() }}</h4>
                                            @endif
                                    @endif
                                @endif
                        </div>
                    </form>
                   <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-5 col-sm-6">
                            <div class="m-auto">
                                <div id="formLoader" style="display: none;" class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                   </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-5 col-sm-6">
                            <div id="smsSuccess" style="display: none;0">
                                <img src="{{ asset('assets/images/loader.gif') }}" alt="success gif">
                            </div>
                        </div>
                    </div>
                </x-slot:content>
            </x-system.modal>
    </div>
    <!-- container-fluid -->
@endsection

@section('extra_script')
<script>
    let table = "begin";
        $(document).ready (function () {

        table = $('#viongoziWilayaTable')
            .DataTable ({
                "fnDrawCallback": function (oSettings) {
                        //   console.log(this.api().page.info())
                        },
                lengthChange: !1,
                buttons: ['excel', 'pdf', {
                text: 'send sms',
                action: function ( e, dt, node, config ) {
                    $("#sendTextSms").modal('show');
                }
            }],
        });

            table.buttons ()
            .container ().appendTo ('#viongoziWilayaTable_wrapper .col-md-6:eq(0)'), $ ('.dataTables_length select')
            .addClass ('form-select form-select-sm');

               // Handle click on "Select all" control
            $('#viongoziWilayaTable-select-all').on('click', function(){
                // Get all rows with search applied
                var rows = table.rows({ 'search': 'applied' }).nodes();
                // Check/uncheck checkboxes for all rows in the table
                let leftRows = $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });
        });

        // Handle click on checkbox to set state of "Select all" control
        $('#viongoziWilayaTable tbody').on('change', 'input[type="checkbox"]', function(){
                let remainingRows = table.rows({ 'search': 'applied' }).nodes();
                let selectedRows = $('input[type="checkbox"]:checked', remainingRows);
                let finalTable = $('#viongoziWilayaTable-select-all');
                if(remainingRows.length != selectedRows.length){
                    finalTable.prop('checked', false);
                }else{
                    finalTable.prop('checked', true);
                }
        });


        $("form[name='sendTextSmsForm']").on('submit', function(e){
            e.preventDefault();
            let messageToSend = $(this).serializeArray()[0];
            let nowRows = table.rows({ 'search': 'applied' }).nodes();
            let selectedToSend = [];
            let vls = $('input[type="checkbox"]:checked', nowRows);
            for( let g=0; g<vls.length; g++){
            selectedToSend.push($(vls[g]).val());
            }
            sendAjaxSmsRequest(messageToSend, selectedToSend);
        });


            let sendAjaxSmsRequest = function( message, leaders ) {
                let allowed = {!! $resultBalance['response'] ? $resultBalance['response']->data->credit_balance : 0 !!}
                    console.log( leaders );
                if( confirm(`Idadi ya sms Unazojaribu kutuma ni ${leaders.length} Idadi Hii Itapungua kama kuna namba zenye kujirudia.`)){
                    if( allowed < 0 ){
                        if ( confirm("Hatukuweza Kufanya Makadirio Ya Salio. Endelea") ){
                                sendAjaxSmsRequesto( message, leaders );
                        }
                    }else{
                        if( allowed < leaders.length ){
                            alert(` Salio Lako Halitoshi kutuma SMS ${leaders.length} `)
                        }else if( leaders.length < 1 ){
                            alert(` Tafadhali Chagua Watu Wa Kutumiwa SMS `)
                        }
                        else {
                            sendAjaxSmsRequesto( message, leaders );
                        }
                    }
                }
            };


            let sendAjaxSmsRequesto = function( message, leaders){
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $.ajax({
                        beforeSend: function() {
                            $('#sendTextSmsFormId').css("display", "none");
                            $('#formLoader').css("display", 'flex');
                        },
                        dataType: "json",
                        type: "post",
                        url: '/sms/send',
                        data: {
                            message: message,
                            leaders_ids: leaders,
                        },
                        success: function (response) {
                            if( response.status == 'fail' || response.status == 'error' ){
                                alert( response.message );
                                $('#formLoader').css("display", 'none');
                                $('#sendTextSmsFormId').css("display", "block");
                            }else {
                                $('#formLoader').css("display", 'none');
                                $('#smsSuccess').css("display", "flex");
                                if ( response.obj ){
                                    window.location = `/sms/orodha/show/${response.obj.id}`;
                                }else{
                                    location.reload();
                                }
                            }
                        },
                        error:function(x,e) {
                            if (x.status==0) {
                                alert('You are offline!!\n Please Check Your Network.');
                            } else if(x.status==404) {
                                alert('Requested URL not found.');
                            } else if(x.status==500) {
                                alert('Internel Server Error.');
                            } else if(e=='parsererror') {
                                alert('Error.\nParsing JSON Request failed.');
                            } else if(e=='timeout'){
                                alert('Request Time out.');
                            } else {
                                alert('Unknow Error.\n'+x.responseText);
                            }
                            $('#sendTextSmsFormId').css("display", "");
                            $('#formLoader').css("display", 'none');
                        },

                    });
            }
</script>

@endsection
