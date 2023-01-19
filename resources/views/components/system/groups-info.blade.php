 @props(['group'])
 <div class="row">
    <div class="col-sm-12 col-md-6">
        @foreach( $group->posts as $post )
            @php
                $post_leaders = $post->leaders()->get();
            @endphp
            @foreach ($post_leaders as $post_leader)
                    @if ( $post->area == 'wilaya')
                        {!! $bool_contains = $post_leader->districts->contains( $district->id ) !!}
                    @endif

                    @if ( $post->area == 'mkoa')
                        {!! $bool_contains = $post_leader->regions->contains( $district->id ) !!}
                    @endif

                    @if ( $post->area == 'halmashauri')
                        {!! $bool_contains = $post_leader->councils->contains( $district->id ) !!}
                    @endif

                    @if ( $post->area == 'tarafa')
                        {!! $bool_contains = $post_leader->divisions->contains( $district->id ) !!}
                    @endif

                    @if ( $post->area == 'kata')
                        {!! $bool_contains = $post_leader->wards->contains( $district->id ) !!}
                    @endif

                    @if ( $post->area == 'matawi')
                        {!! $bool_contains = $post_leader->branches->contains( $district->id ) !!}
                    @endif

                    @if ( $bool_contains )
                            <h3>{{ $post->name }}</h3>
                            <span>
                                {{ $post_leader->firstName }} - {{ $post_leader->lastName }} - {{ $post_leader->phone }}
                            </span>
                    @endif
            @endforeach
        @endforeach
    </div>
    <div class="col-sm-12 col-md-6">
        @foreach( $group->posts as $post )
            <ul>{{ $post->name }}</ul>
        @endforeach
    </div>
</div>