{{ loadTitleAll() }}
<datalist id="booksSel">

</datalist>

{{ loadAuthorAll() }}
<datalist id="booksAuthorSel">

</datalist>
<div class="card-body">
    <form method="POST" action="{{ isset($request->id) ? route('edit_request', ['id' => $request->id]) : route('store_request') }}">

        @csrf

        @isset($request->id)
            <input type="hidden" value="{{ $request->id }}" name="id">
            @php
                $book = getBook($request->book_barcode);    
            @endphp
        @endisset
    
        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

            <div class="col-md-6">
                <input id="title" type="text" class="form-control book" list="booksSel" name="title" value="{{ isset($request->id) ? $book->title : old('title') }}" required autofocus>

            </div>
        </div>

        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Author') }}</label>

            <div class="col-md-6">
                <input id="author" type="text" class="form-control book" name="author" list="booksAuthorSel" value="{{ isset($request->id) ? $book->author : old('author') }}" required>

            </div>
        </div>

        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Barcode') }}</label>

            <div class="col-md-6">
                <input id="barcode" type="text" class="form-control" name="barcode" value="{{ isset($request->id) ? $book->barcode : old('barcode') }}" readonly>

            </div>
        </div>

        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('ISBN') }}</label>

            <div class="col-md-6">
                <input id="isbn" type="text" class="form-control" name="isbn" value="{{ isset($request->id) ? explode(" ", $book->isbn)[0] : old('name') }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Date') }}</label>

            <div class="col-md-6">
                <input id="date_t" type="date" class="form-control" name="date_t" value="<?php echo isset($request->id) ? $request->req_date : date('Y-m-d'); ?>" required>
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
