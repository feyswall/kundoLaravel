

@extends("layouts.motorOwner_system")

@section("content")
   <!-- end row -->
   <div id="app">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="">Orodha ya vyombo vya moto</h2>
                    <a href="{{ route('motorOwner.service.type.orodha') }}" class="btn btn-primary btn-sm mb-4">Aina za Services</a>
                    <label class="form-label  font-size-24" id="machagulio-mkoa"></label>
                    <label class="form-label font-size-24" id="machagulio-wilaya"></label>
                    <table id="datatable-motorsTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <th>#</th>
                        <th>Jina Kutambulisha Chombo</th>
                        <th>Mwaka wa Chombo</th>
                        <th>Kundi</th>
                        <th>Aina</th>
                        <th>Model</th>
                        <th>Mmiliki</th>
                        <th></th>
                        </thead>
                        <tbody>
                        @php
                            $user = Illuminate\Support\Facades\Auth::user();
                            $owner = $user->owner;
                            $motors = App\Models\Motor::where('owner_id', $owner->id)
                            ->get();
                        @endphp
                        @foreach( $motors as $key => $motor )
                            <tr>
                                <td>{{ $motors->count() - $key }}</td>
                                <td>{{ $motor->identity_name }}</td>
                                <td>{{ Carbon\Carbon::parse($motor->year)->format('M-d Y') }}</td>
                                <td>{{ $motor->motor_category->name }}</td>
                                <td>{{ $motor->motor_type->name }}</td>
                                <td>{{ $motor->motor_model->name }}</td>
                                <td>{{ $motor->owner->name }}</td>
                                <td>
                                    <a href="{{ route('motorOwner.motor.create', $motor->id) }}"
                                       class="btn btn-sm btn-success">go service
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
@endsection

@section("extra_script")
    <x-system.table-script id="datatable-viongoziWilayaTable" />
@endsection
