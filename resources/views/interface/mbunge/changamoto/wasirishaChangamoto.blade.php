<?php
/**
  * Created by feyswal on 2/10/2023.
  * Time 6:17 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>


@extends("layouts.mbunge_system")

@section("content")
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Ukurasa wa Mbunge</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Changamoto</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row justify-content-between">
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="custom-accordion">
                            <div class="card">

                                <a href="#checkout-billinginfo-collapse" class="text-dark" data-bs-toggle="collapse">
                                    <div class="p-4">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i> </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="font-size-16 mb-1">Changamoto za Chama</h5>
                                                <!--                                                <p class="text-muted text-truncate mb-0">Sed ut perspiciatis unde omnis iste</p>-->
                                            </div>
                                            <div class="flex-shrink-0"> <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                        </div>
                                    </div>
                                </a>
                                <div id="checkout-billinginfo-collapse" class="collapse show">
                                    <div class="p-4 border-top">
                                        <form>
                                            <div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-12">
                                                        <div class="mb-4 mb-lg-0">
                                                            <label class="form-label">Mkoa</label>
                                                            <select class="form-control form-select" v-model="mkoa" title="Country" onchange="mkoaInputChange(event)">
                                                                <option value="">Chagua Mkoa</option>
                                                                <option value="AF">Dar Es Salaam</option>
                                                                <option value="AL">Arusha</option>
                                                                <option value="DZ">Morogoro</option>
                                                                <option value="AS">Dodoma</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-12" style="display: none;" id="wilayaInputDiv">
                                                        <div class="mb-4 mb-lg-0">
                                                            <label class="form-label">Wilaya</label>
                                                            <select class="form-control form-select" v-model="wilaya" title="Country" onChange="wilayaInputChange(event)">
                                                                <option value="">Chagua Wilaya</option>
                                                                <option value="AF">wilaya 1</option>
                                                                <option value="AL">Wilaya 2</option>
                                                                <option value="DZ">Wilaya 3</option>
                                                                <option value="AS">Wilaya 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-12" style="display: none;" id="halmashauriInputDiv">
                                                        <div class="mb-4 mb-lg-0">
                                                            <label class="form-label">Halmashauri</label>
                                                            <select class="form-control form-select" v-model="halmashauri" title="Country" onchange="halmashauriInputChange(event)">
                                                                <option value="">Chagua Halmashauri</option>
                                                                <option value="AF">Halmashari 1</option>
                                                                <option value="AL">Halmashauri 2</option>
                                                                <option value="DZ">Halmashauri 3</option>
                                                                <option value="AS">Halmashauri 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-12" style="display: none;" id="kitongojiInputDiv">
                                                        <div class="mb-4 mb-lg-0">
                                                            <label class="form-label">Jimbo</label>
                                                            <select class="form-control form-select" v-model="jimbo" title="Country" onChange="kitongojiInputChange(event)">
                                                                <option value="">Chagua Jimbo</option>
                                                                <option value="AF">Jimbo 1</option>
                                                                <option value="AL">Jimbo 2</option>
                                                                <option value="DZ">Jimbo 3</option>
                                                                <option value="AS">Jimbo 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-12" style="display: none;" id="kataInputDiv">
                                                        <div class="mb-4 mb-lg-0">
                                                            <label class="form-label">kata</label>
                                                            <select class="form-control form-select" v-model="kata" title="Country" onChange="kataInputChange(event)">
                                                                <option value="">Chagua Kata</option>
                                                                <option value="AF">Kata 1</option>
                                                                <option value="AL">Kata 2</option>
                                                                <option value="DZ">Kata 3</option>
                                                                <option value="AS">Kata 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-12" style="display: none;" id="mtaaInputDiv">
                                                        <div class="mb-4 mb-lg-0">
                                                            <label class="form-label">Mtaa</label>
                                                            <select class="form-control form-select" title="Country" v-model="mtaa" onchange="mtaaInputChange(event)">
                                                                <option value="">Chagua Mtaa</option>
                                                                <option value="AF">Mtaa 1</option>
                                                                <option value="AL">Mtaa 2</option>
                                                                <option value="DZ">Mtaa 3</option>
                                                                <option value="AS">Mtaa 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-md-5">
                                                    <span class="lead">Taarifa za mbunge</span>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="" class="form-label">Jina la Mbunge</label>
                                                        <input type="text" class="form-control" v-model="jinaLaMbunge" readonly>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="" class="form-label">Namba ya simu ya mbunge</label>
                                                        <input type="number" class="form-control" placeholder="eg: 0628 678 878" v-model="nambaYaSimuMbunge">
                                                    </div>
                                                </div>

                                                <div class="row mt-md-5">
                                                    <span class="lead">Taarifa za Mkuu Wa Wilaya</span>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="" class="form-label">Jina la Mkuu wa wilaya</label>
                                                        <input type="text" class="form-control" v-model="jinaLaMKuuWilaya">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="" class="form-label">Namba ya simu ya Mkuu wa Wilaya</label>
                                                        <input type="number" class="form-control" placeholder="eg: 0628 678 878" v-model="nambaYaSimuMkuuWilaya">
                                                    </div>
                                                </div>
                                                <div class="row mt-md-5">
                                                    <span class="lead">Taarifa za Mkurugenzi</span>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="" class="form-label">Jina la Mkurugenzi</label>
                                                        <input type="text" class="form-control" v-model="jinaLaMkurugenzi">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="" class="form-label">Namba ya simu ya Mkurugenzi</label>
                                                        <input type="number" class="form-control" placeholder="eg: 0628 678 878" v-model="nambaYaSimuMkurugenzi">
                                                    </div>
                                                </div>
                                                <div class="row mt-md-5">
                                                    <span class="lead">Taarifa za diwani</span>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="" class="form-label">Jina la Diwani</label>
                                                        <input type="text" class="form-control" v-model="jinaLaDiwani">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="" class="form-label">Namba ya simu ya Diwani</label>
                                                        <input type="number" class="form-control" placeholder="eg: 0628 678 878" v-model="nambaYaSimuDiwani">
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="mb-4">
                                                        <label class="form-label" for="billing-address">Jaza Changamoto zilizopo katika eneo Hilo</label>
                                                        <textarea @keyup="changamotoChange()" class="form-control" id="billing-address" rows="3" placeholder="Andika Hapa.." v-model="changamoto"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="row my-4">

                        </div>
                        <!-- end row-->
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="row justify-content-center">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card shadow-none">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row justify-content-center">
                                                            <div class="col-md-2">
                                                                <img src="/assets/images/bunge.png" alt="" class="w-100 mx-auto">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="row mt-3">
                                                            <div class="col-md-5 mt-4">
                                                                <address class="mini-text">
                                                                    Eng. Kundo Andrea Mathew ,<br>
                                                                    Naibu Waziri,<br>
                                                                    Wizara Habari, Mawasiliano na Teknolojia ya Habari ,<br>
                                                                    Dodoma- Magufuli City<br>
                                                                </address>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="row justify-content-center">
                                                            <div class="col-sm-12 col-md-8 text-center">
                                                                <h5><b>Changamoto Za Chama</b></h5>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="row justify-content-start">
                                                            <div class="col-sm-12 col-md-12">
                                                                <p style="line-height: 2;">
                                                                    {{ changamoto }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="row justify-content-center">
                                                            <div class="col-sm-8 col-md-8 text-center">
                                                                Wako mtiifu katika ujenzi wa mawasiliano Bora katika Taifa
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="row justify-content-center">
                                                            <div class="col-sm-8 col-md-4 text-center">
                                                                <i>___________________</i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="row justify-content-center">
                                                            <div class="col-sm-6 col-md-4 text-center">
                                                                <i>Leonard Singoma</i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 d-none" >
                                                        <div class="row justify-content-center" style="margin-top: 400px;">
                                                            <div class="col-sm-6 col-md-4 text-center">
                                                                <i>Leonard Singoma</i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <a @click.stop.prevent="printInvoice('printable-proforma')" v-bind:class="{ btn: niButton, 'btn-dark': niButton, 'd-none': fichaPrint }"><i class="la la-print"></i> Print Fomu</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <A HREF="formKwenyeQueue.php" class="btn btn-primary btn-block">endelea >>></A>
                    </div>
                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <footer class="footer">
            <?php
            include_once '../_partials/_super_footer.php';
            ?>
        </footer>
    </div>

@endsection

