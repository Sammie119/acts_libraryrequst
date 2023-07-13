<div class="card-body">
    <form method="POST" action="{{ route('approved', ['id' => $request->id]) }}">

        @csrf

        @isset($request->id)
            <input type="hidden" value="{{ $request->id }}" name="id">
            @php
                $book = getBook($request->book_barcode);    
            @endphp
        @endisset
    
        <div class="row mb-3">
            <label for="name" class="col-md-3 col-form-label text-md-end">{{ __('Title') }}</label>

            <div class="col-md-7">
                <input id="title" type="text" class="form-control book" name="title" value="{{ isset($request->id) ? $book->title : old('title') }}" readonly autofocus>

            </div>
        </div>

        <div class="row mb-3">
            <label for="name" class="col-md-3 col-form-label text-md-end">{{ __('Author') }}</label>

            <div class="col-md-7">
                <input id="author" type="text" class="form-control book" name="author" value="{{ isset($request->id) ? $book->author : old('author') }}" readonly>

            </div>
        </div>

        <div class="row mb-3">
            <label for="name" class="col-md-3 col-form-label text-md-end">{{ __('ISBN') }}</label>

            <div class="col-md-7">
                <input id="isbn" type="text" class="form-control" name="isbn" value="{{ isset($request->id) ? explode(" ", $book->isbn)[0] : old('name') }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="name" class="col-md-3 col-form-label text-md-end">{{ __('Barcode') }}</label>

            <div class="col-md-2">
                <input id="barcode" type="text" class="form-control" name="barcode" value="{{ isset($request->id) ? $book->barcode : old('barcode') }}" readonly>

            </div>

            <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('Request Date') }}</label>

            <div class="col-md-3">
                <input id="date_t" type="date" class="form-control" value="<?php echo isset($request->id) ? $request->req_date : date('Y-m-d'); ?>" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="name" class="col-md-3 col-form-label text-md-end">{{ __('Return Days') }}</label>

            <div class="col-md-2">
                <input id="days_t" type="number" name="days_r" step="1" class="form-control" value="3" required>
            </div>

            <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('Return Date') }}</label>

            <div class="col-md-3">
                <input id="date_r" type="date" class="form-control" name="return_date" value="<?php echo isset($request->id) ? $request->req_date : date('Y-m-d'); ?>" required>
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Approve') }}
                </button>

                <button class="btn btn-danger cancel" value="{{ $request->id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" type="button">Cancel</button>
        
            </div>
        </div>
    </form>
</div>
