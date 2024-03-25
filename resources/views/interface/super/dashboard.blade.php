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
    <div class="container-fluid" id="app">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Nyumbani</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                            <li class="breadcrumb-item active">jikoni</li>
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
                            <h4 class="mb-1 mt-1"><span>
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
                <a href="{{ route('super.challenge.orodha') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end mt-2">
                            <div id="orders-chart"> </div>
                        </div>
                        <div>
                            @php $challengeCount = \App\Models\Challenge::where('status', 'new')->count(); @endphp
                            <h4 class="mb-1 mt-1 @if( $challengeCount > 0)  text-danger @endif">
                                 {{ $challengeCount  }}</h4>
                            <p class="text-muted mb-0">Changamoto</p>
                        </div>
                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1">{{ \App\Models\Challenge::count()  }}</span> Idadi ya Zilizohifadhiwa</p>
                    </div>
                </div>
                </a>
            </div>
            <!-- end col-->
            @php
                $allApartments = \App\Models\Apartment::all();
                $apartment = new \App\Http\Controllers\Super\Apartment\ApartmentsController();
                $unpaidApartments = $apartment->queryUnpaid();
            @endphp
            <div class="col-md-6 col-xl-3">
               <a href="{{ route('super.apartment.unpaid') }}">
                <div class="card">
                        <div class="card-body">
                            <div class="float-end mt-2">
                                <div id="customers-chart"></div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1"><span >
                                        {{ count($unpaidApartments) }}
                                    </span></h4>
                                <p class="text-muted mb-0">Apartments zenye madeni</p>
                            </div>
                            <p class="text-muted mt-3 mb-0"><span class="text-success me-1">
                                {{ count($allApartments) }}</span>
                                Jumla ya Apartment Zote
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- end col-->
            <!-- end col-->
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="m-5">
                        </div>
                        <h4 class="card-title">Orodha ya Viongozi Wote</h4>
                        <table
                               :class="{'table': true, 'table-sm': true, 'table-striped': true,
                                    'table-bordered': true, 'dt-responsive': true, 'nowrap': true,
                                    'd-none': leadersTrueData.length < 1}"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th><input type="checkbox" name="select_all" value="1" id="viongoziWilayaTable-select-all"></th>
                                <th>Majina Kamili</th>
                                <th>Simu</th>
                                {{-- <th>Wadhifa</th> --}}
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(leader,index) in leadersTrueData" :key="index">
                                    <td>
                                        <input type="checkbox" class="checker" name="leader_id" :value="leader.id">
                                    </td>
                                    <td>@{{ leader.firstName }} @{{ leader.middleName }} @{{ leader.lastName }}</td>
                                    <td>@{{ leader.phone }}</td>
                                    <td>
                                        <a class="float-left fas fa-folder-open" :href="'/super/leader/ona/kiongozi/' + leader.id"> </a>
                                        {{--<a class="float-left"  data-bs-toggle="modal" data-bs-target="#badiriTaarifaKiongoziModal_{{ $leader->id }}" data-bs-placement="top" title="Badilisha" href="#"> <iconify-icon icon="bi:vector-pen"></iconify-icon></a>--}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <div>
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item" v-for="lin in leaders.links">
                                            <a :class="{'page-link': true, 'text-primary': lin.active , 'd-none': !lin.url }"
                                               @click="loadSmsOfGroup(lin.url)"><b>@{{ lin.label }}</b></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
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
    const app = new  Vue({
        el: "#app",
        data() {
            return {
                loader: true,
                leaders: [],
                leadersTrueData: [],
                status: {},
                currentPageUrl: "/api/leaders/search/in/dashboard"
            }
        },
        mounted() {
            this.loadSmsOfGroup(this.currentPageUrl);
//            setInterval(() => {
//                this.loadSmsOfGroupLoop(this.currentPageUrl);
//            }, 10000)
        },
        methods: {
            loadSmsOfGroup(url) {
                const obj = this;
                axios.post(url)
                    .then((response) => {
                    this.leaders = response.data.collect;
                    this.leadersTrueData = response.data.collect.data;
                    console.log(this.leaders);
                    this.currentPageUrl = `/api/leaders/search/in/dashboard?page=${this.leaders.current_page}`;
            })
            .catch(function (error) {
                    alert(error);
                    this.loader = false;
                });
                console.log("the ecmascript compiles just fine");
            },
        }
    });
</script>


@endsection
