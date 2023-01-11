<form method="post" action="{{ route('super.areas.wilaya.ongeza') }}">
    @csrf
    <div>
        <div class="row">
            <div class="col-lg-4">
                <div class="mb-3 mb-4">
                    <label class="form-label" for="billing-name">Jina La Mkoa</label>
                    <input type="text" readonly class="form-control" value="Bariadi"> </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3 mb-4">
                    <label class="form-label" for="billing-name">Jina La Wilaya</label>
                    <input type="text" class="form-control" name="wilaya" required placeholder="Jina  La Wilaya"> </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" name="submit" class="btn btn-primary btn-md">Ongeza</button>
            </div>
        </div>
</form>

