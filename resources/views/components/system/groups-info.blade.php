 @props(['group', 'table'])
 <div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="d-flex justify-start gap-4 flex-wrap">
                           
        @foreach( $group->posts as $post )
            @php
                $post_leaders = $post->leaders()->get();
                $bool_contains = false;
            @endphp
            @foreach ($post_leaders as $post_leader)
                    @if ( $post->area == 'wilaya')
                        @php $bool_contains = $post_leader->districts->contains( $table->id ); @endphp
                    @endif

                    @if ( $post->area == 'mkoa')
                        @php $bool_contains = $post_leader->regions->contains( $table->id ); @endphp
                    @endif

                    @if ( $post->area == 'halmashauri')
                        @php $bool_contains = $post_leader->councils->contains( $table->id ); @endphp
                    @endif

                    @if ( $post->area == 'tarafa')
                        @php $bool_contains = $post_leader->divisions->contains( $table->id ); @endphp
                    @endif

                    @if ( $post->area == 'kata')
                        @php $bool_contains = $post_leader->wards->contains( $table->id ); @endphp
                    @endif

                    @if ( $post->area == 'matawi')
                        @php $bool_contains = $post_leader->branches->contains( $table->id ); @endphp
                    @endif

                    @if ( $bool_contains )
                       
                        <div class="text-center">
                                    <h4 class="fs-5 text-capitalize mb-1">{{ $post_leader->firstName }} {{ $post_leader->lastName }}</h4>
                                    <span class="d-block mb-2">{{ $post_leader->phone }}</span>
                                    <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2" >{{ $post->name }}</small>
                            </div>
                    @endif
            @endforeach
        @endforeach
        </div>

    </div>
    <div class="col-sm-12 col-md-4">
        <ul>
        @foreach( $group->posts as $post )
            <li>
                {{ $post->name }}
            </li>
        @endforeach
        </ul>
    </div>
</div>