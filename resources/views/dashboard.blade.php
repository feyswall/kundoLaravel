@hasrole("super")
    @include('interface.super.dashboard')
@endhasrole

@hasrole("mbunge")
    @include('interface.mbunge.dashboard')
@endhasrole

@hasrole("general")
    @include('interface.general.dashboard')
@endhasrole

@hasrole("motorOwner")
    @include('interface.motorOwner.dashboard')
@endhasrole

@hasrole("assistance")
    @include('interface.assistants.dashboard')
@endhasrole
