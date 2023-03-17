<?php
/**
 * Created by feyswal on 2/13/2023.
 * Time 12:49 PM.
 * EastCoders & G3NET.
 * contacts: +255 628 960 877
 */
?>


@extends('layouts.super_system')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="">Taarifa Ya Changamoto pdf Zilizowahi Kuchapishwa</h2>
                    <a href="{{ route('pdf.door.create') }}" class="btn btn-primary btn-md mt-3 mb-4">+ tengeneza pdf</a>
                    <label class="form-label  font-size-24" id="machagulio-mkoa"></label>
                    <label class="form-label font-size-24" id="machagulio-wilaya"></label>
                    <table id="datatable-viongoziWilayaTable" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <td>#</td>
                            <td>Kumb No:-</td>
                            <th>url</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($pdfs as $key => $pdf)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $pdf->name }}</td>
                                    <td>{{ $pdf->url }}</td>
                                    <td>
                                        <form id="downloaderBtn" action="{{ route('downloadPDF') }}" method="post"
                                            target="_blank">
                                            @csrf
                                            <input type="hidden" value="{{ 'pdfs/'.$pdf->url }}" name="pdf">
                                        </form>
                                        <button form="downloaderBtn" class="btn btn-dark float-end mt-lg-3 mt-sm-2"
                                            type="submit">pakua pdf
                                            ya barua
                                        </button>
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

@section('extra_script')
    <x-system.table-script id="datatable-viongoziWilayaTable" />
@endsection
