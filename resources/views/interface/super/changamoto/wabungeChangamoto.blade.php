<?php
/**
  * Created by feyswal on 2/13/2023.
  * Time 12:49 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>


@extends("layouts.super_system")

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
                        <td>#</td>
                        <th>Changamoto</th>
                        <th>Tarehe</th>
                        <th>Status</th>
                        <th></th>
                        </thead>
                        <tbody>
                        @foreach( $challenges as $key => $challenge )
                            <tr>
                                <td>{{ $challenge->count() - $key }}</td>
                                <td>{{ substr( $challenge->challenge, 0, 30); }} @if ( strlen($challenge->challenge) > 30 )  ... @endif</td>
                                <td>{{ $challenge->created_at }}</td>
                                <td>
                                <span class="text-danger">
                                    @if ( $challenge->status == 'new')
                                        <span class="text-danger">Imewasirishwa</span>
                                    @elseif ( $challenge->status == 'onProgress')
                                        <span class="text-warning">kwenye Mchakato</span>
                                    @elseif ( $challenge->status == 'complete')
                                        <span class="text-success">kamilika</span>
                                    @endif    
                                </span></td>
                                <td style="display: flex;">
                                    <a href="{{ route('super.challenge.fungua', $challenge->id) }}" class="btn btn-success btn-sm">Fungua</a>
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

