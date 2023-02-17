@props(['id', 'posts'])

<div>
    <table id="{{ $id }}" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th>#</th>
            <th>Jina la Tawi</th>
            <th>Ngazi ya:</th>
            {{--<th>Kamati Zao</th>--}}
            <th>Idadi</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach( $posts as $key => $post )
            <tr>
                <th>
                    {{ $key + 1 }}
                </th>
                <td>{{ $post->name }}</td>
                <td>{{ $post->area }}</td>
                {{--<th>--}}
                    {{--<ul>--}}
                        {{--@foreach( $post->groups as $group)--}}
                            {{--<li>{{ $group->name }}</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--</th>--}}
                <td>{{ $post->leaders()->count() }}</td>
                <td>
                    <button  data-bs-toggle="modal" data-bs-target="#editWadhifaModal_{{$post->id}}" class="btn btn-info btn-md mb-4"><i class="fas fa-plus"> </i>Badiri wadhifa</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @foreach($posts as $key => $post )
        <x-system.modal id="editWadhifaModal_{{ $post->id }}" aria="ongezaWadhifaLabel" size="modal-lg" title="Fomu ya kubadiri wadhifa" >
            <x-slot:content>
                <form method="POST" action="{{ route('super.posts.updateWadhifa', $post->id ) }}" class="p-3">
                    @csrf
                    @method('put')
                    <div class="row">
                        <label for="">Jina la Awali</label>
                        <input type="text" value="{{ $post->name }}" class="form-control">
                    </div>
                    <div class="row">
                        <label for="">Jina La Sasa</label>
                        <input type="text" value="{{ old('post') }}" name="post" class="form-control">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-md btn-primary">Ongeza</button>
                    </div>
                </form>
            </x-slot:content>
        </x-system.modal>
        @endforeach
</div>