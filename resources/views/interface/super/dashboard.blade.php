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
                    <h4 class="mb-0">Welcome</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">user</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <!-- end page title -->
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end mt-2">
                            <div id="total-revenue-chart"></div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">
                                @php $balanceFunct = \App\Http\Controllers\SmsServicesControlller::CheckBalance(); @endphp
                                @if ( $balanceFunct['status'] )
                                    @if ( $balanceFunct['status'] == "success")
                                        @if ( isset($balanceFunct['response']->data) )
                                            {{ $balanceFunct['response']->data->credit_balance }}
                                        @endif
                                    @endif
                                @endif
                            </span></h4>
                            <p class="text-muted mb-0">Sms Credit Balance</p>
                        </div>
                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1">
                            <i class="mdi mdi-arrow-up-bold me-1"></i>
                            {{ \App\Http\Controllers\SmsServicesControlller::supportedSms() }}</span>Sms Capacity  </p>
                    </div>
                </div>
            </div>
            <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end mt-2">
                            <div id="orders-chart"> </div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">55</span></h4>
                            <p class="text-muted mb-0">Changamoto</p>
                        </div>
                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>0.82%</span> ya mwezi uliopita </p>
                    </div>
                </div>
            </div>
            <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end mt-2">
                            <div id="customers-chart"> </div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">45</span></h4>
                            <p class="text-muted mb-0">Waliofadhiliwa</p>
                        </div>
                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>6.24%</span> ya mwaka uliopita</p>
                    </div>
                </div>
            </div>
            <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end mt-2">
                            <div id="growth-chart"></div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">12</span></h4>
                            <p class="text-muted mb-0">Walioajiliwa </p>
                        </div>
                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>10.51%</span> ya mwaka uliopita</p>
                    </div>
                </div>
            </div>
            <!-- end col-->
        </div>
        <!-- end row-->
        <div class="row">
            <div class="col-xl-6">

                <!--end card-->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Orodha ya watumiaji</h4>
                        <table id="viongoziWilayaTable" class="table table-striped table-bordered dt-responsive nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th><input type="checkbox" name="select_all" value="1" id="viongoziWilayaTable-select-all"></th>
                                <th>Jina/kwnza</th>
                                <th>Jina/kati</th>
                                <th>Jina/mwisho</th>
                                <th>Simu</th>
                                <th>Kamati</th>
                                <th>Kamati</th>
                                {{-- <th>miaka</th>
                                <th>Start date</th>
                                <th></th> --}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $leaders as $leader )
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checker" name="leader_id" value="{{ $leader->id }}">
                                    </td>
                                    <td>{{ $leader->firstName }}</td>
                                    <td>{{ $leader->middleName }}</td>
                                    <td>{{ $leader->lastName }}</td>
                                    <td>{{ $leader->phone }}</td>
                                    <td>
                                        <ul>
                                           @foreach ($leader->posts as $post)
                                                @if ( $post->pivot->isActive )
                                                    @foreach ($post->groups as $group)
                                                        <li><b>{{ $group->name }}</b></li>
                                                    @endforeach                                                 
                                                @endif
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($leader->posts as $post)
                                                @if ( $post->pivot->isActive )
                                                    <li>{{ $post->name }}</li>                                                    
                                                @endif
                                            @endforeach
                                        </ul>
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
                                        <h4>Balance {{ $resultBalance['response']->data->credit_balance; }}</h4>
                                        <h4>Utaweza kutuma SMS {{ \App\Http\Controllers\SmsServicesControlller::supportedSms() }}</h4>
                                    @endif
                                @endif
                        </div>
                    </form>
                   <div class="row">
                        <div class="m-auto">
                            <div id="formLoader" style="display: none;" class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                   </div>
                   <div id="smsSuccess" style="display: none">
                        <h1 class="text-success" style="margin-right: 50px;">Sms Zimetumwa!</h1>
                        <div id="formLoader"  class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
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


            let sendAjaxSmsRequest = function( message, leaders) {
                let allowed = {!! $resultBalance['response'] ? $resultBalance['response']->data->credit_balance : 0 !!}
                    console.log( leaders )
                if( confirm(`Idadi ya sms Unazojaribu kutuma ni ${leaders.length} Idadi Hii Itapungua kama kuna namba zenye kujirudia.`)){
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
                        url: 'sms/send',
                        data: {
                            message: message,
                            leaders_ids: leaders,
                        },
                        success: function (response) {
                            console.log( response );
                            if( response.status == 'fail' || response.status == 'error' ){
                                alert( response.message );
                                $('#formLoader').css("display", 'none');
                                $('#sendTextSmsFormId').css("display", "block");
                            }else {
                                $('#formLoader').css("display", 'none');
                                $('#smsSuccess').css("display", "flex");
//                                location.reload();
                            }
                        },
                        complete: function() {
                        }
                        
                    });
            }
</script>

@endsection