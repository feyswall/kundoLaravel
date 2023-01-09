<!-- logout buutton at the header section -->

 <form method="POST" action="{{ route('logout') }}">
                            @csrf
            <a class="dropdown-item" href="route('logout')"
                onclick="event.preventDefault();
                this.closest('form').submit();"
            ><i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Sign out</span>
        </a>
</form>