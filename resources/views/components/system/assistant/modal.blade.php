<!-- Modal -->
    <div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $aria  }}" aria-hidden="true">
        <div class="modal-dialog {{ $size }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ $content }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">funga</button>
                </div>
            </div>
        </div>
    </div>


