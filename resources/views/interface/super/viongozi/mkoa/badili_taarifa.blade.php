@extends('layouts.super_system')
@section('content')
<div class="row justify-content-start">
    <form action=" {{ route('super.leader.mkoa.sasisha', $leader->id) }} " method="POST">
        @method('put')
        @csrf
        <input type="hidden" name="id" value="{{ $leader->id }}">
        <div class="col-xl-12">
            <div class="custom-accordion">
                <div class="card">
                    <a href="#checkout-billinginfo-collapse" class="text-dark" data-bs-toggle="collapse">
                        <div class="p-4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i> </div>
                                <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1">Badilisha taarifa za: <span style="color: rgba(201, 186, 52, 0.777)">{{$leader->firstName." ".$leader->lastName}}</span> </h5>
                                </div>
                                <div class="flex-shrink-0"> <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                            </div>
                        </div>
                    </a>
                    <div id="checkout-billinginfo-collapse" class="collapse show">
                        <div class="p-4 border-top">
                                <div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div id="jinalawilaya" class="mb-3 mb-4 ">
                                                <label class="form-label" for="billing-name">Jina La Kwanza</label>
                                                <input name="firstName" value="{{$leader->firstName}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div id="jinalawilaya" class="mb-3 mb-4 ">
                                                <label class="form-label" for="billing-name">Jina La Kati</label>
                                                <input name="middleName" value="{{$leader->middleName}}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div id="jinalawilaya" class="mb-3 mb-4 ">
                                                <label class="form-label" for="billing-name">Jina La Mwisho</label>
                                                <input name="lastName" value="{{$leader->lastName}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div id="jinalawilaya" class="mb-3 mb-4 ">
                                                <label class="form-label" for="billing-name">Namba ya simu</label>
                                                <input name="phone" value="{{$leader->phone}}" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                 <button class="btn btn-primary" type="submit">Hifadhi</button>
                        </div>
                    </div>
                </div>
            <div class="row my-4">

                <!-- end col -->
                <div class="col">
                    <div class="text-end mt-2 mt-sm-0">
                        <a style="display: none;" id="vifaaFormButton" href="orodha_moja_ya_kifaa.php" class="btn btn-success"> <i class="uil uil-shopping-cart-alt me-1"></i> tuma </a>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row-->
        </div>
    </form>
</div>
@endsection