<form action="{{ route('returned_book', ['id' => $id]) }}" method="get">

    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Received Date') }}</label>

        <div class="col-md-6">
            <input id="date_t" type="date" class="form-control" name="returned_date" value="<?php echo date('Y-m-d'); ?>" required>
        </div>
    </div>

    <hr width="106.5%" style="margin-left: -15px; background: #bbb">

    <div class="float-end">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
        <button type="submit" class="btn btn-danger">Yes, Delete</button>
    </div>
</form>
