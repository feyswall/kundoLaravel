@php
  $user = Illuminate\Support\Facades\Auth::user();
@endphp
@if ( $user->hasRole('super') )
  @include('profile.super-profile')
@elseif ( $user->hasRole('mbunge'))
  @include('profile.mbunge-profile')
@elseif ( $user->hasRole('general'))
  @include('profi')
@endif