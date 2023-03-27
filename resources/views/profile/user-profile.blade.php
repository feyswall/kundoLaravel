@php
  $user = Illuminate\Support\Facades\Auth::user();
@endphp
@if ( $user->hasRole('super') )
  @include('profile.super-profile')
@elseif ( $user->hasRole('mbunge'))
  @include('profile.mbunge-profile')
@elseif ( $user->hasRole('general'))
  @include('profile.general-profile')
@elseif ( $user->hasRole('motorOwner'))
    @include('profile.motorOwner-profile')
@endif