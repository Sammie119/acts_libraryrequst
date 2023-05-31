<div class="card-body">
    <form method="POST" action="{{ route('store_user_details') }}">
        @csrf
        <input type="hidden" name="user_id" value="{{ isset($users->id) ? $users->user_id : Auth::user()->id }}">

        @isset($users->user_id)
            <input type="hidden" name="id" value="{{ $users->id }}">
        @endisset
        <div class="row mb-3">
            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('Firstname') }}</label>

            <div class="col-md-6">
                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ isset($users->user_id) ? $users->first_name : old('first_name') }}" required autocomplete="first_name" autofocus>

                @error('first_name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

            <div class="col-md-6">
                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ isset($users->user_id) ? $users->last_name : old('last_name') }}" required autocomplete="last_name" autofocus>

                @error('last_name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="id_number" class="col-md-4 col-form-label text-md-end">{{ __('Student/Staff ID') }}</label>

            <div class="col-md-6">
                <input id="id_number" type="text" class="form-control @error('id_number') is-invalid @enderror" name="id_number" value="{{ isset($users->user_id) ? $users->id_number : old('id_number') }}" required autocomplete="id_number">

                @error('id_number')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

            <div class="col-md-6">
                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ isset($users->user_id) ? $users->phone : old('phone') }}" required autocomplete="phone">

                @error('phone')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

            <div class="col-md-6">
                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ isset($users->user_id) ? $users->address : old('address') }}" required autocomplete="address">

                @error('address')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="emg_person" class="col-md-4 col-form-label text-md-end">{{ __('Emergency Contact Person') }}</label>

            <div class="col-md-6">
                <input id="emg_person" type="text" class="form-control @error('emg_person') is-invalid @enderror" value="{{ isset($users->user_id) ? $users->emg_person : old('emg_person') }}" name="emg_person" required autocomplete="emg_person">

                @error('emg_person')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="emg_phone" class="col-md-4 col-form-label text-md-end">{{ __('Emergency Contact') }}</label>

            <div class="col-md-6">
                <input id="emg_phone" type="text" class="form-control @error('emg_phone') is-invalid @enderror" value="{{ isset($users->user_id) ? $users->emg_phone : old('emg_phone') }}" name="emg_phone" required autocomplete="emg_phone">

                @error('emg_phone')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
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
