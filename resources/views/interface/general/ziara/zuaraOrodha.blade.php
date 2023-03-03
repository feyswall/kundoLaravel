<?php
/**
  * Created by feyswal on 2/28/2023.
  * Time 4:04 PM.
  * EastCoders & G3NET.
  * contacts: +255 628 960 877
 */
?>

@extends('layouts.general_system')

@section("content")
@php
    $user = Illuminate\Support\Facades\Auth::user();
@endphp
    <!-- Start right Content here -->
    <div class="card">
        <div class="card-body"></div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="">Taarifa Kuhusiana Na Barua Ulizotumiwa</h2>
                    <label class="form-label  font-size-24" id="machagulio-mkoa"></label>
                    <label class="form-label font-size-24" id="machagulio-wilaya"></label>
                    <table id="generalSailSendToTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <td>#</td>
                        <th>Kichwa</th>
                        <th>Maelezo</th>
                        <th>Tarehe</th>
                        <th></th>
                        </thead>
                        <tbody>
                            @foreach( $sendTo as $key => $sial )
                                <tr>
                                    <td>{{ $sendTo->count() - $key }}</td>
                                    <td>{{ $sial->title }}</td>
                                    <td>{{ $sial->note }}</td>
                                    <td>{{  Carbon\Carbon::parse($sial->created_at)->format('M d Y') }} </td>
                                    <td>
                                        <a href="{{ route("general.sial.show", $sial->id) }}" class="btn btn-success btn-sm">fungua</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h2 class="">Pokea Nakala</h2>
                     <table id="generalSailCopyToTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <td>#</td>
                        <th>Kichwa</th>
                        <th>Maelezo</th>
                        <th></th>
                        <th>Tarehe</th>
                        </thead>
                        <tbody>
                            @foreach( $copyTo as $key => $sial )
                                <tr>
                                    <td>{{ $copyTo->count() - $key }}</td>
                                    <td>{{ $sial->title }}</td>
                                    <td>
                                        <p class="
                                         @if($sial->inToMany($user) )
                                            @if( !($sial->inToMany($user)->pivot->seen) )
                                                text-danger
                                            @endif
                                        @endif
                                        ">
                                            {{ $sial->note }}
                                        </p>
                                    </td>
                                    <td>{{  Carbon\Carbon::parse($sial->created_at)->format('M d Y') }} </td>
                                    <td>
                                        <a href="{{ route("general.sial.show", $sial->id) }}" class="btn btn-success btn-sm">fungua</a>
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
    <x-system.table-script id="generalSailSendToTable" />
     <x-system.table-script id="generalSailCopyToTable" />
@endsection
