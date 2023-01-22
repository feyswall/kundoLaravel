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
                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">356</span></h4>
                            <p class="text-muted mb-0">Jumla ya watumiaji</p>
                        </div>
                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>2.65%</span> ya mwezi uliopita </p>
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
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Simu</th>
                                <th>Eneo</th>
                                <th>miaka</th>
                                <th>Start date</th>
                                <th></th>
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
                                                    <li>{{ $post->name }}</li>                                                    
                                                @endif
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>20</td>
                                    <td>2011/08/14</td>
                                    <td id="3">
                                        <button class="btn btn-warning" onclick="togglerButton(event)"><i onclick="" class="fas fa-user"></i></button>
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
                    <form name="sendTextSmsForm" method="post">
                        <div class="mb-3">
                            <label for="message">Meseji</label>
                            <textarea rows="7" type="text" class="form-control" name="message"></textarea>
                        </div>
                        <div>
                            <button id="smsInFormBtn" class="btn btn-primary btn-md" type="submit">tuma</button>
                        </div>
                    </form>
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


            let sendAjaxSmsRequest = function( message, leaders){
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $.ajax({
                        // beforeSend: function() {
                        // $('#smsInFormBtn').attr("disabled", true);
                        // },
                        dataType: "json",
                        type: "post",
                        url: 'sms/send',
                        data: {
                            message: message,
                            leaders_ids: leaders,
                        },
                        success: function (response) {
                            console.log( response );
                        }
                    });
            }
</script>

@endsection