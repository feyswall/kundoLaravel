<?php
/**
  * Created by feyswal on 2/10/2023.
  * Time 5:07 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>




@extends("layouts.mbunge_system")

@section("content")
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="">Taarifa Ya Changamoto Ulizowahi Kuwakilisha</h2>
                    <label class="form-label  font-size-24" id="machagulio-mkoa"></label>
                    <label class="form-label font-size-24" id="machagulio-wilaya"></label>
                    <table id="datatable-viongoziWilayaTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <th>Jina la Mbunge</th>
                        <th>Mkoa</th>
                        <th>Jimbo</th>
                        <th>Changamoto</th>
                        <th>Tarehe</th>
                        <th>Status</th>
                        <th></th>
                        </thead>
                        <tbody>
                            @foreach( $challenges as $challenge )
                                <tr>
                                    <td>Hamna Ngasa</td>
                                    <td>Dar es salaam</td>
                                    <td>Ubungo</td>
                                    <td>Changamoto</td>
                                    <td>2022/march/12</td>
                                    <td><span class="text-danger">Mpya ...</span></td>
                                    <td>
                                        <a href="{{ route('mbunge.challenges.moja', $challenge->id) }}" class="btn btn-success btn-sm">Fungua</a href="">
                                        <a href="" class="btn btn-danger btn-sm">futa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section("extra_script")
    <x-system.table-script id="datatable-viongoziWilayaTable" />
@endsection

