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
                        <table id="datatable-viongoziWilayaTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Jina</th>
                                <th>Cheo</th>
                                <th>Eneo</th>
                                <th>miaka</th>
                                <th>Start date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>Ashura Imma</td>
                                <td>Mbunge</td>
                                <td>Kigoma Mjini</td>
                                <td>48</td>
                                <td>2010/03/11</td>
                                <td id="4">
                                    <button class="btn btn-warning" onclick="togglerButton(event)"><i onclick="" class="fas fa-user"></i></button>
                                </td>

                            </tr>
                            <tr>
                                <td>Anna Immam</td>
                                <td>Mbunge</td>
                                <td>Singida Vijijini</td>
                                <td>20</td>
                                <td>2011/08/14</td>
                                <td id="1">
                                    <button class="btn btn-warning" onclick="togglerButton(event)"><i onclick="" class="fas fa-user"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Hisba Nimu</td>
                                <td>Mkurugenzi</td>
                                <td>Singida Vijijini</td>
                                <td>20</td>
                                <td>2011/08/14</td>
                                <td id="2">
                                    <button class="btn btn-warning" onclick="togglerButton(event)"><i onclick="" class="fas fa-user"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Futi ILaym</td>
                                <td>Mkurugenzi</td>
                                <td>Singida Vijijini</td>
                                <td>20</td>
                                <td>2011/08/14</td>
                                <td id="3">
                                    <button class="btn btn-warning" onclick="togglerButton(event)"><i onclick="" class="fas fa-user"></i></button>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
@endsection