@extends('layouts.super_system')

@section('content')
<div id="app">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="">Jina Kamili: {{ $leader->firstName }} {{ $leader->middleName == 'null' ? '' : $leader->middleName }} {{ $leader->lastName }}</h4>
                    <h4 class="mt-3 text-danger"><b>Nyadhifa  / Eneo</b></h4>
                    <ul>
                        @foreach ($posts as $post)
                            <li>{{ $post->name }} - <b>{{ $post->area }}</b></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
