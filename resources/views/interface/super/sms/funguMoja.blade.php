<?php
/**
  * Created by feyswal on 1/25/2023.
  * Time 4:37 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>



@extends("layouts.super_system")

@section('extra_style')

@endsection

@section("content")

    <div class="container-fluid" id="app">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">Taarifa Za Sms</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">sms</a></li>
                            <li class="breadcrumb-item active">group</li>
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
                        <a href="{{ route('sms.orodha.group') }}" class="btn btn-primary btn-md mb-4">Rudi Kwenye Orodha</a>

                        <single-sms-table  :sms="{!! $sms->id !!}" :request_id="{!! $sms->request_id !!}"></single-sms-table>

                        <table id="allSmsTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Status</th>
                                <th>Group No_</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>phone</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach( $leaders as $key => $leader )
                                <tr>
                                    <td>
                                        @php $resp = \App\Http\Controllers\SmsServicesControlller::deriveryReport($leader->phone, $sms->request_id); @endphp
                                        @if( $resp['status'] == 'fail')
                                            <span><b class="text-primary">Loading...</b></span>
                                            @else
                                            @if( isset($resp['response']->error) )
                                                <span><b class="text-primary">Loading ...</b></span>
                                                @else
                                                <span><b class="text-{{ $resp['response']->status == "DELIVERED" ? 'success' : 'primary' }}">{{ $resp['response']->status }}</b></span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $leader->firstName }}</td>
                                    <td>{{ $leader->lastName }}</td>
                                    <td>{{ $leader->phone }}</td>
                                    <td>
                                        <a href="" class="btn btn-danger btn-sm">delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
            <div class="m-auto">
         
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div> <!-- end row -->

    </div> <!-- container-fluid -->
    <!-- end main content-->

@endsection

@section("extra_script")
    {{--<x-system.table-script id="allSmsTable" />--}}
    {{-- <script>
        const app = new  Vue({
            el: "#app",

            data: {
                sms: {!! $sms->id !!},
                leaders: @json($leaders),
            },

            methods: {
                fetchMessages() {

                }
            },
            created() {
                console.log( this.leaders );
            },
        });
    </script> --}}
@endsection