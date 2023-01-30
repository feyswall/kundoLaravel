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
<div class="mb-3">
    <button data-bs-toggle="modal" data-bs-target="#tumaSmsModal" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i> Sajili Kiongozi</button>
       <x-system.modal id="tumaSmsModal" aria="smsKwaViongozi" size="modal-lg" title="Tuma Sms Kwa Viongozi">
            <x-slot:content>
                <form method="get" action="#" name="sendTextSmsForm" id="sendTextSmsForm">
                    <div class="mb-3">
                        <label for="message">Meseji</label>
                        <textarea rows="7" type="text" class="form-control" name="message"></textarea>
                    </div>
                   <div>
                     <button type="submit" class="btn btn-success btn-md">tuma message</button>
                   </div>
                </form>
                 <div class="row">
                        <div class="m-auto">
                            <div id="formLoader" style="display: none;" class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                   </div>
            </x-slot:content>
       </x-system.modal>
</div>
@foreach ($groups as $group)
    <x-system.sms-collapse :id="$group->deep" :title="strtoupper($group->name)" :gId="$group->id">
        <x-slot:content>
           @foreach ($group->posts as $post)

           <div class="row justify-content-start">
              <div class="col-md-12 col-sm-12">
                 <ul style="list-style-type: none;" class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{ $post->name }}</div>
                        </div>
                    </li>
                </ul>
              </div>
           </div>

           @endforeach
        <button  data-bs-toggle="modal" data-bs-target="#ongezaWadhifaModal{{$group->id}}" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i>Ongeza wadhifa</button>
        </x-slot:content>
        <x-slot:text>
        <div class="row justify-content-end">
            <div class="col-md-3 col-sm-6">
            </div>
        </div>
        </x-slot:text>
    </x-system.sms-collapse>


@endforeach


@endsection

@section("extra_script")

<x-system.table-script id="superOrodhaGroupsTable" />

<script>

        function leadersList() {
            let selectedToSend = [];
            let checkedInputs = $('input[type="checkbox"]:checked');
                for( let g=0; g<checkedInputs.length; g++){
                selectedToSend.push($(checkedInputs[g]).val());
            }
            return selectedToSend;
        }


        
        $("form[name='sendTextSmsForm']").on('submit', function(e){
            e.preventDefault();
            let selectedToSend = leadersList();
            let messageToSend = $(this).serializeArray()[0];
            if( messageToSend == null || selectedToSend.length < 1 ){
                alert("Hakikisha Unajaza Taarifa zote.")
            }else {
                if (confirm(`Tuma Sms ${selectedToSend.length}`)) {
                    sendAjaxSmsRequesto( messageToSend, selectedToSend );
                }
            }
        });



              let sendAjaxSmsRequesto = function( message, leaders){
                   $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $.ajax({
                        beforeSend: function() {
                            $('#sendTextSmsForm').css("display", "none");
                            $('#formLoader').css("display", 'flex');
                        },
                        dataType: "json",
                        type: "post",
                        url: '/sms/group/send',
                        data: {
                            message: message,
                            groups_ids: leaders,
                        },
                        success: function (response) {
                           console.log( response );
                            $('#sendTextSmsForm').css("display", "");
                            $('#formLoader').css("display", 'none');
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
                        complete: function(){
                             $('#sendTextSmsForm').css("display", "");
                            $('#formLoader').css("display", 'none');
                        }

                    });
            }

</script>

@endsection
