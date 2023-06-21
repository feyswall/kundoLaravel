@props([
    'route' => route('assistants.leader.unpower'),
    'table',
    'column_id',
    'column_value',
    'leader_id',
    'post_id'
    ])

<div>
    <form action="{{ $route }}" method="POST">
        @csrf
        @method('put')

        <input type="hidden" name="table" value="{{ $table }}">
        <input type="hidden" name="column_id" value="{{ $column_id }}">
        <input type="hidden" name="column_value" value="{{ $column_value }}">

        <input name='leader_id' value="{{ $leader_id }}" type="hidden">
        <input name="post_id" value="{{ $post_id }}" type="hidden">
        <button class="btn btn-danger btn-lg" type="submit">NDIO</button>
    </form>

</div>
