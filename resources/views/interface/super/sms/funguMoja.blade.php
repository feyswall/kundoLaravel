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
                        <div>
                            <table v-if="!loader" id="allSmsTable"
                                   class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                    <tr v-for="smsLeader in smsWithLeaders">
                                        <td v-if="smsLeader.status == 'DELIVERED'" class="text-success"><b>@{{ smsLeader.status }}</b></td>
                                        <td v-else-if="smsLeader.status == 'PENDING'" class="text-primary"><b>@{{ smsLeader.status }}</b></td>
                                        <td v-else-if="smsLeader.status == 'FAILED'" class="text-danger"><b>@{{ smsLeader.status }}</b></td>
                                        <td v-else class="text-danger">Error</td>
                                        <td>@{{ request_id }}</td>
                                        <td>@{{ smsLeader.leader.firstName }}</td>
                                        <td>@{{ smsLeader.leader.lastName }}</td>
                                        <td>@{{ smsLeader.leader.phone }}</td>
                                        <td>
                                            <a href="" class="btn btn-danger btn-sm">delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row justify-content-center" v-if="loader">
                                <div class="col-sm-4 col-md-3">
                                     <div id="formLoader"  class="spinner-border" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->
    <!-- end main content-->

@endsection

@section("extra_script")
    <x-system.table-script id="allSmsTable">
    </x-system.table-script>

    <script>
        const app = new  Vue({
        el: "#app",
        data() {
            return {
                loader: true,
                smsWithLeaders: [],
                status: {},
                sms: {!! $sms->id !!},
                request_id: {!! $sms->request_id !!}
            }
        },
        mounted() {
            this.loadSmsOfGroup();
            setTimeout(() => {
                this.loadSmsOfGroup();
            }, 2000);
        },
        methods: {
                loadSmsOfGroup() {
                const obj = this;
                axios.get(`/api/super/sms/group/orodha/${this.sms}`)
                    .then((response) => {
                        let responseData = Array;
                        if (response.data) {
                            responseData = response.data;
                            this.smsWithLeaders = responseData;
                            this.loader = false;
                        }
                    })
                    .catch(function (error) {
                        alert(error);
                        this.loader = false;
                    });
            },
        }
    });
    </script>
@endsection
