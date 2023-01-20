 @props(['group', 'table'])
 <div class="row">
    <div class="col-sm-12 col-md-6">
        @foreach( $group->posts as $post )
            @php
                $post_leaders = $post->leaders()->get();
            @endphp
            @foreach ($post_leaders as $post_leader)
                    @if ( $post->area == 'wilaya')
                        @php $bool_contains = $post_leader->districts->contains( $table->id ) @endphp
                    @endif

                    @if ( $post->area == 'mkoa')
                        @php $bool_contains = $post_leader->regions->contains( $table->id ) @endphp
                    @endif

                    @if ( $post->area == 'halmashauri')
                        @php $bool_contains = $post_leader->councils->contains( $table->id ) @endphp
                    @endif

                    @if ( $post->area == 'tarafa')
                        @php $bool_contains = $post_leader->divisions->contains( $table->id ) @endphp
                    @endif

                    @if ( $post->area == 'kata')
                        @php $bool_contains = $post_leader->wards->contains( $table->id ) @endphp
                    @endif

                    @if ( $post->area == 'matawi')
                        @php $bool_contains = $post_leader->branches->contains( $table->id ) @endphp
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