 @props(['group', 'table'])
 <div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="d-flex justify-start gap-4 flex-wrap">
            @php
                $mjumbe = 0;
                $leaders_for_sms = [];
            @endphp
            @foreach( $group->posts as $post)
                @php
                    $bool_contains = false;
                    $all_leaders = [];
                @endphp
                @if ( $post->area === $group->basedOn )
                    @php
                        $bool_contains = $table;
                         $leaders_id = $bool_contains->leaders->pluck('id');
                        $all_leaders[] = \App\Http\Controllers\Assistants\LeadersController::filterLeaders($leaders_id, $post);
                    @endphp
                @elseif( $group->deep == "Wajumbe_wa_Mkutano_Mkuu_wa_CCM_Wilaya_Wapiga_Kura_gp")
                    @if( $mjumbe < 1 )
                        <form action="{{ route("assistants.group.showGroup", $group) }}" method="post">
                            @csrf
                            @method("put")
                            <input type="hidden" name="district" value="{{ $table->id }}">
                            <button type="submit" class="btn btn-primary btn-sm">fungua</button>
                        </form>
                        @php $mjumbe++; @endphp
                        @endif
                @else
                    @if ( $post->area == 'mkoa')
                        @php
                            if ( method_exists($table, "regions") ){
                                $bool_contains = $table->regions()->with('leaders', function ($query){
                                            $query->where('isActive', true);
                                          })->get();
                                 foreach( $bool_contains as $obj ){
                                        $leaders_id = $obj->leaders->pluck('id');
                                        $all_leaders[] = \App\Http\Controllers\Assistants\LeadersController::filterLeaders($leaders_id, $post);
                                    }
                            }else{
                                $bool_contains = $table->region;
                                 $leaders_id = $bool_contains->leaders->pluck('id');
                                 $all_leaders[] = \App\Http\Controllers\assistants\LeadersController::filterLeaders($leaders_id, $post);
                            }
                        @endphp
                    @endif

                    @if ( $post->area == 'wilaya')
                        @php
                            if ( method_exists($table, "districts") ){
                                   $bool_contains = $table->districts()->with('leaders', function ($query){
                                            $query->where('isActive', true);
                                          })->get();
                                   foreach( $bool_contains as $obj ){
                                            $leaders_id = $obj->leaders->pluck('id');
                                            $all_leaders[] = \App\Http\Controllers\Assistants\LeadersController::filterLeaders($leaders_id, $post);
                                        }
                               }else{
                                   $bool_contains = $table->district;
                                   $leaders_id = $bool_contains->leaders->pluck('id');
                                   $all_leaders[] = \App\Http\Controllers\Assistants\LeadersController::filterLeaders($leaders_id, $post);
                              }
                        @endphp
                    @endif

                    @if ( $post->area == 'halmashauri')
                        @php
                            if ( method_exists($table, "councils") ){
                                      $bool_contains = $table->councils()->with('leaders', function ($query){
                                            $query->where('isActive', true);
                                          })->get();
                                       foreach( $bool_contains as $obj ){
                                            $leaders_id = $obj->leaders->pluck('id');
                                            $all_leaders[] = \App\Http\Controllers\Assistants\LeadersController::filterLeaders($leaders_id, $post);
                                        }
                                  }else{
                                      $bool_contains = $table->council;
                                       $leaders_id = $bool_contains->leaders->pluck('id');
                                       $all_leaders[] = \App\Http\Controllers\Assistants\LeadersController::filterLeaders($leaders_id, $post);
                                }
                        @endphp
                    @endif

                    @if ( $post->area == 'tarafa')
                        @php
                            if ( method_exists($table, "divisions") ){
                                          $bool_contains = $table->divisions()->with('leaders', function ($query){
                                            $query->where('isActive', true);
                                          })->get();
                                          foreach( $bool_contains as $obj ){
                                            $leaders_id = $obj->leaders->pluck('id');
                                            $all_leaders[] = \App\Http\Controllers\Assistants\LeadersController::filterLeaders($leaders_id, $post);
                                            }
                                      }else{
                                          $bool_contains = $table->division;
                                           $leaders_id = $bool_contains->leaders->pluck('id');
                                           $all_leaders[] = \App\Http\Controllers\Assistants\LeadersController::filterLeaders($leaders_id, $post);
                                    }
                        @endphp
                    @endif

                    @if ( $post->area == 'kata')
                        @php
                            if ( method_exists($table, "wards") ){
                                   $bool_contains = $table->wards()->with('leaders', function ($query){
                                            $query->where('isActive', true);
                                          })->get();
                                foreach( $bool_contains as $obj ){
                                    $leaders_id = $obj->leaders->pluck('id');
                                    $all_leaders[] = \App\Http\Controllers\Assistants\LeadersController::filterLeaders(
                                        $leaders_id, $post);
                                }
                            }else{
                                    $bool_contains = $table->ward;
                                        $leaders_id = $bool_contains->leaders->pluck('id');
                                    $all_leaders[] = \App\Http\Controllers\Assistants\LeadersController::filterLeaders(
                                        $leaders_id, $post);
                            }
                        @endphp
                    @endif

                    @if ( $post->area == 'tawi')
                        @php
                            if ( method_exists($table, "branches") ){
                                $bool_contains = $table->branches()
                                ->with('leaders', function ($query){
                                $query->where('isActive', true);
                                })->get();
                                foreach( $bool_contains as $obj ){
                                    $leaders_id = $obj->leaders->pluck('id');
                                    $all_leaders[] = \App\Http\Controllers\Assistants\LeadersController::filterLeaders(
                                        $leaders_id, $post);
                                }
                            }else{
                                $bool_contains = $table->branch;
                                $leaders_id = $bool_contains->leaders->pluck('id');
                                $all_leaders[] = \App\Http\Controllers\Assistants\LeadersController::filterLeaders(
                                $leaders_id, $post);
                            }
                        @endphp
                    @endif

                    @if ( $post->area == 'shina')
                        @php
                            if ( method_exists($table, "trunks") ){
                                $bool_contains = $table->trunks()->with('leaders', function ($query){
                                $query->where('isActive', true);
                                })->get();
                                foreach( $bool_contains as $obj ){
                                    $leaders_id = $obj->leaders->pluck('id');
                                    $all_leaders[] = \App\Http\Controllers\Assistants\LeadersController::filterLeaders($leaders_id, $post);
                                }
                            }
                            else{
                                $bool_contains = $table->trunk;
                                $leaders_id = $bool_contains->leaders->pluck('id');
                                $all_leaders[] = \App\Http\Controllers\Assistants\LeadersController::filterLeaders($leaders_id, $post);
                            }
                        @endphp
                    @endif

                @endif

                @if ( $bool_contains )
                    @php
                        $tracker = '';
                        $mainCounter = 0;
                        $counter = 0;
                    @endphp

                    @foreach( $all_leaders as $leadersCollection )
                        @foreach($leadersCollection as $key => $leaders)
                            @foreach($leaders as  $bey => $leader)
                                @php $leaders_for_sms[] = $leader; @endphp
                            @endforeach
                        @endforeach
                    @endforeach

                    <div class="container">
                        <div class="row">
                            @foreach( $all_leaders as $leadersCollection )
                                @foreach($leadersCollection as $key => $leaders)
                                        @foreach($leaders as  $bey => $leader)
                                            @if( $tracker == $post->name && is_object($leader) )
                                                @php
                                                    $counter++ ;
                                                @endphp
                                                        <div class="col-md-3 col-sm-12 col-12 p-3">
                                                            <div class="text-center">
                                                                <h4 class="fs-5 text-capitalize mb-1">{{ $leader->firstName }} {{ $leader->lastName }}</h4>
                                                                <span class="d-block mb-2">{{ $leader->phone }}</span>
                                                                <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2" >{{ $counter }}</small>
                                                                <span class="d-block mb-2">
                                                                    @php
                                                                    $area = $post->area;
                                                                    if ($area == 'tawi'){
                                                                        echo "Tawi/".$leader->branches()->where('isActive', true)->first()->name;
                                                                    }elseif ($area == 'kata'){
                                                                        echo "Kata/".$leader->wards()->where('isActive', true)->first()->name;
                                                                    }elseif ($area == 'tarafa'){
                                                                        echo "Tarafa/".$leader->divisions()->where('isActive', true)->first()->name;
                                                                    }elseif ($area == 'halmashauri'){
                                                                        echo "Halmashauri/".$leader->councils()->where('isActive', true)->first()->name;
                                                                    }elseif ($area == 'wilaya'){
                                                                        echo "Wilaya/".$leader->districts()->where('isActive', true)->first()->name;
                                                                    }elseif ($area == 'mkoa'){
                                                                        echo "Mkoa/".$leader->regions()->where('isActive', true)->first()->name;
                                                                    }
                                                                    @endphp
                                                                </span>
                                                            </div>
                                                        </div>
                                                @else
                                                    @if( is_object( $leader))
                                                        <!-- Force next columns to break to new line -->
                                                            <div class="w-100"></div>
                                                            <hr>
                                                            <h5><b>{{ $post->name }}</b></h5>
                                                            @php
                                                                $tracker = $post->name;
                                                                $counter = 1;
                                                            @endphp
                                                            <div class="col-md-3 col-sm-12 col-12 p-3">
                                                                <div class="text-center">
                                                                    <h5 class="fs-5 text-capitalize mb-1">
                                                                        {{ $leader->firstName }} {{ $leader->lastName }}
                                                                    </h5>
                                                                    <span class="d-block mb-2">{{ $leader->phone }}</span>
                                                                    {{-- <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2" >{{ $post->name }}</small> --}}
                                                                    <small style="background: #f5f6f8;" class="rounded text-black text-capitalize fw-bold px-2 py-2" >{{ $counter }}</small>
                                                                    <span class="d-block mb-2">
                                                                    @php
                                                                        $area = $post->area;
                                                                        if ( $area == 'tawi'){
                                                                            echo "Tawi/".$leader->branches()->where('isActive', true)->first()->name;
                                                                        }elseif ( $area == 'kata'){
                                                                            echo "Kata/".$leader->wards()->where('isActive', true)->first()->name;
                                                                        }elseif ( $area == 'tarafa'){
                                                                            echo "Tarafa/".$leader->divisions()->where('isActive', true)->first()->name;
                                                                        }elseif ( $area == 'halmashauri'){
                                                                            echo "Halmashauri/".$leader->councils()->where('isActive', true)->first()->name;
                                                                        }elseif ( $area == 'wilaya'){
                                                                            echo "Wilaya/".$leader->districts()->where('isActive', true)->first()->name;
                                                                        }elseif ( $area == 'mkoa'){
                                                                            echo "Mkoa/".$leader->regions()->where('isActive', true)->first()->name;
                                                                        }
                                                                    @endphp
                                                                </span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                @endif
                                        @endforeach
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
            @php
                $leaders_ids_for_smses = collect($leaders_for_sms)->pluck('id');
                $leaders_ids_for_smses_json = json_encode( $leaders_ids_for_smses );
            @endphp
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
    <div>
        @php
        $str = $group->deep;
            $deepWithNoSpace = preg_replace('/\s+/', '', $str );
        @endphp
        <x-system.collapse id="form_{{ $deepWithNoSpace }}" title="TUMA SMS HAPA">
            <x-slot:content>
                <form action="#" method="POST">
                    <div>
                        <input type="hidden" name='leaders_ids'
                        value="{{ $leaders_ids_for_smses_json }}">
                    </div>
                    <div>
                        <label for="message">Andika Message</label>
                        <textarea  class="form-control" name="message"
                        id="message" cols="10" rows="7"></textarea>
                    </div>
                    <div  class="mt-2">
                        <button type="submit" class="btn btn-sm btn-danger">
                            Tuma sms
                        </button>
                    </div>
                </form>
            </x-slot:content>
        </x-system.collapse>
    </div>
</div>
