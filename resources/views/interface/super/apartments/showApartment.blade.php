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
                <div class="card">
                    <div class="card-body">
                        <h3>Jina la Nyumba: <b>{{ $apartment->house->houseName }}</b></h3>
                        <h3>Jina la Apartment: <b>{{ $apartment->name }}</b></h3>
                        <h5 class="mt-2">Maelezo Kuhusu Apartment:</h5>
                        <p> {{ $apartment->desc }}</p>
                        <h5>Gharama ya Apartment Hii: <b>{{ number_format( floatval($apartment->cost), 0, '.', ',')}}/= </b>Tsh</h5>
                        <span>Mpanga Wa Apartment: <b>{{ $apartment->tenant->name ?? "Hakuna Mpangaji" }}  </b>
                            @if( $apartment->tenant == null )
                                <a href="#" data-bs-toggle="modal" data-bs-target="#assignTenant">
                                    <i class="fas fa-plus"> </i>Weka Mpangaji</a>
                            @else
                                <form method="post"
                                 action="{{ route('super.tenants.deleteTenant', $apartment->tenant->id ) }}"
                                  class="m-3">
                                    @method('delete')
                                    @csrf
                                    <i class="fas fa-minus-circle text-danger">

                                    </i><input type="submit" class="border-0 bg-white text-danger"
                                    value="remove tenant">
                                </form>
                            @endif
                        </span>
                        <div class="mt-3">
                            @if( $apartment->tenant )
                                <button data-bs-toggle="modal" data-bs-target="#createNewPayment"
                                class="btn btn-info btn-sm mb-4"><i class="fas fa-plus"> </i>Lipa Kodi</button>
                            @endif
                        </div>
                        <h4 class="card-title mt-2">Orodha ya malipo ya Apartment</h4>
                        <table id="apartment-table" class="table table-striped table-bordered dt-responsive nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Mpangaji</th>
                                <th>Kodi @mwezi</th>
                                <th>Kiasi Kilicholipwa</th>
                                <th>Miezi</th>
                                <th>Mwezi wa kuanza:</th>
                                <th>Mwezi wa kuisha:</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $apartment->payments as $key => $payment )
                                <tr>
                                    <td>{{ $apartment->payments->count() - $key }}</td>
                                    <td>{{ $payment->tenant->name }}</td>
                                    <td>Tsh {{ number_format($payment->perMonth_payment, 0, '.', ',') }}/=</td>
                                    <td>Tsh {{ number_format($payment->received_payment, 0, '.', ',')  }}/=</td>
                                    <th>{{ $payment->month_count }}</th>
                                    <td>{{ \Carbon\Carbon::parse($payment->start_month)->format("M-d-Y") }}</td>
                                    <td>{{ \Carbon\Carbon::parse($payment->start_month)->addMonths( $payment->month_count)->format("M-d-Y") }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <x-system.modal id="createNewPayment" aria="apartmentRegistration" size="modal-lg"
        title="Sajiri Apartment Mpya">
            <x-slot:content>
                <form method="POST" action="{{ route('super.payments.storePayment') }}">
                    @csrf
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Kiasi Ulichopokea</label>
                                    <input name="received" class="form-control" type="number">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    @php
                                        $start_date = null;
                                        // selecting the last payments of the apartment
                                        $payment = $apartment->payments()->latest()->first();
                                        if ($payment) {
                                            $last_payment_tenant_id = $payment->tenant_id;
                                            // current apartment tenant
                                            $current_tenant = $apartment->tenant;
                                            if ($current_tenant) {
                                                if($current_tenant->id == $last_payment_tenant_id){
                                                    $start_date = $payment->end_month;
                                                    $formated_start = Carbon\Carbon::parse($start_date)->addDays(1)->format('Y-m-d');
                                                }
                                            }
                                        }
                                    @endphp
                                    <label class="form-label" for="billing-name">Tarehe ya kuanza</label>
                                    <input type="date" name="date"
                                        value="{{ $formated_start  ?? $formated_start }}"
                                        @if ($formated_start) readonly @endif
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <input name="apartment_id" value="{{ $apartment->id }}" type="hidden">
                                    <button class="btn btn-sm btn-success" type="submit">sajiri</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </x-slot:content>
        </x-system.modal>
        <x-system.modal id="assignTenant" aria="apartmentTenantRegistration" size="modal-lg"
        title="Sajiri Mpangaji wa Apartment">
            <x-slot:content>
                <form method="POST" action="{{ route('super.tenants.assignTenant') }}">
                    @csrf
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Chagua Mpangaji</label>
                                    <select name="tenant_id" class="form-control">
                                        @foreach( $tenants as $tenant )
                                            <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tenant')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <p>Hii ni orodha ya wapangaji wasiokuwa na vyumba.</p>
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <input name="apartment_id" value="{{ $apartment->id }}" type="hidden">
                                    <button class="btn btn-sm btn-success" type="submit">tuma</button>
                                </div>
                                <p>Je hukupata Mpangaji? Sajiri mpangaji Mpya.
                                    <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#registerNewTenant" >
                                        <i class="fas fa-plus"> </i>Sajiri Mpangaji</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </x-slot:content>
        </x-system.modal>
        <x-system.modal id="registerNewTenant" aria="apartmentTenantRegistration"
         size="modal-fullscreen" title="Form ya kusajiri mpangaji mpya kwenye mfumo">
            <x-slot:content>
                <form method="POST" action="{{ route('super.tenants.storeTenant') }}">
                    @csrf
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Jina Kamili</label>
                                    <input name="name" class="form-control" type="text">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Jinsia</label><br>
                                    Me: <input type="radio" name="gender" class="form-radio-pink" value="male" checked>
                                    Ke: <input type="radio" name="gender" class="form-radio-pink" value="female">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <label class="form-label" for="billing-name">Namba ya simu</label>
                                    <input name="phone" class="form-control" type="number">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mb-3 mb-4">
                                    <input name="apartment_id" value="{{ $apartment->id }}" type="hidden">
                                    <button class="btn btn-sm btn-success" type="submit">sajiri</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </x-slot:content>
        </x-system.modal>
        <!-- end page title -->
        @endsection

        @section('extra_script')
            <x-system.table-script id="apartment-table" />
@endsection
