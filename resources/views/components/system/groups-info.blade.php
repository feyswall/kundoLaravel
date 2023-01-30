 @props(['group', 'table'])
 <div class="row">
     @php
        $ranks = array(
            'mkoa' => 10,
            'wilaya' => 9,
            'halmashauri' => 8,
            'tarafa' => 7,
            'kata' => 6,
            'tawi' => 5
         );
     @endphp
    <div class="col-sm-12 col-md-8">
        <div class="d-flex justify-start gap-4 flex-wrap">
            @foreach( $group->posts as $post)

                @php
                    $bool_contains = false;
                    $all_leaders = [];
                @endphp

                @if ( $post->area === $group->basedOn )
                    @php
                        $bool_contains = $table;
                         $leaders_id = $bool_contains->leaders->pluck('id');
                        $all_leaders[] = \App\Http\Controllers\Super\LeadersController::filterLeaders($leaders_id, $post);
                    @endphp
                @else
{{--                    <h1>{{ ($ranks[$post->area] < $ranks[$group->basedOn]) ? "kamanda" : "hapana" }}</h1>--}}
                    @if ( $post->area == 'mkoa')
                        @php
                            if ( $table->regions() ){
                                $bool_contains = $table->regions()->with('leaders')->get();
                                 foreach( $bool_contains as $obj ){
                                        $leaders_id = $obj->leaders->pluck('id');
                                        $all_leaders[] = \App\Http\Controllers\Super\LeadersController::filterLeaders($leaders_id, $post);
                                    }
                            }else{
                                $bool_contains = $table->region()->with('leaders')->get();
                                 $leaders_id = $bool_contains->leaders->pluck('id');
                                 $all_leaders[] = \App\Http\Controllers\Super\LeadersController::filterLeaders($leaders_id, $post);
                            }
                        @endphp
                    @endif

                    @if ( $post->area == 'wilaya')
                        @php
                            if ( $table->districts() ){
                                   $bool_contains = $table->districts()->get();
                                   foreach( $bool_contains as $obj ){
                                            $leaders_id = $obj->leaders->pluck('id');
                                            $all_leaders[] = \App\Http\Controllers\Super\LeadersController::filterLeaders($leaders_id, $post);
                                        }
                               }else{
                                   $bool_contains = $table->district()->get();
                                   $leaders_id = $bool_contains->leaders->pluck('id');
                                   $all_leaders[] = \App\Http\Controllers\Super\LeadersController::filterLeaders($leaders_id, $post);
                              }
                        @endphp
                    @endif


                    @if ( $post->area == 'halmashauri')
                        @php
                            if ( $table->councils() ){
                                      $bool_contains = $table->councils()->with('leaders')->get();
                                       foreach( $bool_contains as $obj ){
                                            $leaders_id = $obj->leaders->pluck('id');
                                            $all_leaders[] = \App\Http\Controllers\Super\LeadersController::filterLeaders($leaders_id, $post);
                                        }
                                  }else{
                                      $bool_contains = $table->council()->with('leaders')->get();
                                       $leaders_id = $bool_contains->leaders->pluck('id');
                                       $all_leaders[] = \App\Http\Controllers\Super\LeadersController::filterLeaders($leaders_id, $post);
                                }
                        @endphp
                    @endif

                    @if ( $post->area == 'tarafa')
                        @php
                            if ( $table->divisions() ){
                                          $bool_contains = $table->divisions()->with('leaders')->get();
                                          foreach( $bool_contains as $obj ){
                                            $leaders_id = $obj->leaders->pluck('id');
                                            $all_leaders[] = \App\Http\Controllers\Super\LeadersController::filterLeaders($leaders_id, $post);
                                            }
                                      }else{
                                          $bool_contains = $table->division()->with('leaders')->get();
                                           $leaders_id = $bool_contains->leaders->pluck('id');
                                           $all_leaders[] = \App\Http\Controllers\Super\LeadersController::filterLeaders($leaders_id, $post);
                                    }

                        @endphp
                    @endif

                    @if ( $post->area == 'kata')
                        @php
                            if ( $table->wards() ){
                                   $bool_contains = $table->wards()->with('leaders')->get();
                                           foreach( $bool_contains as $obj ){
                                                $leaders_id = $obj->leaders->pluck('id');
                                                $all_leaders[] = \App\Http\Controllers\Super\LeadersController::filterLeaders($leaders_id, $post);
                                            }
                                     }else{
                                         $bool_contains = $table->ward()->with('leaders')->get();
                                             $leaders_id = $bool_contains->leaders->pluck('id');
                                            $all_leaders[] = \App\Http\Controllers\Super\LeadersController::filterLeaders($leaders_id, $post);
                                           }
                        @endphp
                    @endif

                    @if ( $post->area == 'matawi')
                        @php
                            if ( $table->branches() ){
                                          $bool_contains = $table->branches()->with('leaders')->get();
                                           foreach( $bool_contains as $obj ){
                                                $leaders_id = $obj->leaders->pluck('id');
                                                $all_leaders[] = \App\Http\Controllers\Super\LeadersController::filterLeaders($leaders_id, $post);
                                            }
                                       }else{
                                           $bool_contains = $table->branch()->with('leaders')->get();
                                           $leaders_id = $bool_contains->leaders->pluck('id');
                                           $all_leaders[] = \App\Http\Controllers\Super\LeadersController::filterLeaders($leaders_id, $post);
                                     }
                        @endphp

                    @endif

                @endif

                @if ( $bool_contains )
                  @foreach( $all_leaders as $leaders )
                      @foreach($leaders as $leader)
                            <div class="text-center">
                                <h4 class="fs-5 text-capitalize mb-1">{{ $leader->firstName }} {{ $leader->lastName }}</h4>
                                <span class="d-block mb-2">{{ $leader->phone }}</span>
                                <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2" >{{ $post->name }}</small>
                            </div>
                          @endforeach
                  @endforeach
                @endif

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