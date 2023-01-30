@props(['id' => 'default', 'title' => '' , 'text' => '', 'hide' => 'hide', 'gId'])

<div class="row">
    <div class="col-12">
        <div class="card">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i> </div>
                        <div class="d-flex justify-content-start align-items-center flex-grow-1 overflow-hidden">
                            <input type="checkbox" name="checker" class="m-4 checkbox-input" value="{{ $gId }}">
                            <h5 class="font-size-16 mb-1">{{ $title }}</h5>
                            <p>{{ $text }}</p>
                        </div>
                        <div class="flex-shrink-0"> </div>
                    </div>
                </div>
        </div>
    </div>
</div>