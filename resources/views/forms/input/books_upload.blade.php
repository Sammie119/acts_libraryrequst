<div class="card-body">
    <form method="POST" action="{{ route('store_book') }}" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">

            <div class="col-12">
                <input id="file" type="file" class="form-control" name="file" required>
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    {{ __('Upload') }}
                </button>
            </div>
        </div>
    </form>
</div>
