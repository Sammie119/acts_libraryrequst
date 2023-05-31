{{ loadDiagnosisAll() }}
<datalist id="booksSel">

</datalist>
<div class="card-body">
    <form method="POST" action="{{ isset($request->id) ? route('edit_request', ['id' => $request->id]) : route('store_request') }}">

        @csrf

        @isset($request->id)
            <input type="hidden" value="{{ $request->id }}" name="id">
        @endisset

        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" list="booksSel" name="name" value="{{ isset($user->id) ? $user->name : old('name') }}" required autocomplete="name" autofocus>

            </div>
        </div>

        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Author') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ isset($user->id) ? $user->name : old('name') }}" required autocomplete="name" autofocus>

            </div>
        </div>

        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Barcode') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ isset($user->id) ? $user->name : old('name') }}" required autocomplete="name" autofocus>

            </div>
        </div>

        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('ISBN') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ isset($user->id) ? $user->name : old('name') }}" required autocomplete="name" autofocus>
            </div>
        </div>

        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Date') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ isset($user->id) ? $user->name : old('name') }}" required autocomplete="name" autofocus>
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
            </div>
        </div>
    </form>
</div>
