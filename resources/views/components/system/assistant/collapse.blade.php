@props(['id' => 'default', 'title' => '' , 'text' => '', 'hide' => 'hide' ])

<div class="row">
    <div class="col-12">
        <div class="card" style="border: 1px solid mediumaquamarine;">
            <a href="#{{ $id }}" class="text-dark" data-bs-toggle="collapse">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i> </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="font-size-16 mb-1">{{ $title }}</h5>
                            <p>{{ $text }}</p>
                        </div>
                        <div class="flex-shrink-0"> <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                    </div>
                </div>
            </a>
            <div id="{{ $id }}" class="collapse {{ $hide }}">
                <div class="p-4 border-top">
                    <div class="row">
                        <div class="col-12">
                            {{ $content }}
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div>
            </div>
        </div>
    </div>
</div>