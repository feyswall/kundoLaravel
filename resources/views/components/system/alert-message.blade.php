<div>
    @if(session()->has('status'))
        @if ( session()->get("status") == "success" )
            <div class="alert alert-success">{{ session()->get("status") }}</div>            
        @endif
        @if ( session()->get("status") == "error" )
            <div class="alert alert-danger">{{ session()->get("status") }}</div>
        @endif
    @endif

    @if ( $errors->any() )
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
</div>
