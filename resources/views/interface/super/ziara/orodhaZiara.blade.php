<?php
/**
  * Created by feyswal on 1/17/2023.
  * Time 3:16 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>



@extends("layouts.super_system")

@section('extra_style')

@endsection

@section("content")
    <!-- Start right Content here -->
    <div class="card">
        <div class="card-body">
            <a  href="{{ route('super.sial.create') }}" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"></i> Tuma Barua</a>
        </div>
    </div>

        <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="">Taarifa Kuhusiana Na Barua Ulizotuma</h2>
                    <label class="form-label  font-size-24" id="machagulio-mkoa"></label>
                    <label class="form-label font-size-24" id="machagulio-wilaya"></label>
                    <table id="superSailTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <td>#</td>
                        <th>Kichwa</th>
                        <th>Maelezo</th>
                        <th>Tarehe</th>
                        <th></th>
                        </thead>
                        <tbody>
                        @foreach( $sials as $key => $sial )
                            <tr>
                                <td>{{ $sials->count() - $key }}</td>
                                <td>{{ $sial->title }}</td>
                                <td>{{ $sial->note }}</td>
                               <td>{{  Carbon\Carbon::parse($sial->created_at)->format('M d Y') }} </td>
                               <td>
                                <a href="" class="btn btn-success btn-sm">fungua</a>
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
    <x-system.table-script id="superSailTable" />
@endsection
