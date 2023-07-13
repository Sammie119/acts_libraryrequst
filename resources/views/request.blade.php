@extends('layouts.app')

<style>
    .sambtn {
        pointer-events: none;
    }
</style>

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-1">Requests</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Requests</li>
        </ol>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="text-danger" role="alert">{{$error}}</div>
            @endforeach
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Requested Books
                <button class="btn btn-sm btn-primary float-end create" value="new_request" data-bs-target="#getModal" data-bs-toggle="modal" title="New Request">New Request</button>
                <form class="d-flex float-end input-group-sm" role="search">
                    <input class="form-control me-2" type="search" id="search" placeholder="Search" aria-label="Search" >
                    <button class="btn btn-sm me-2"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>RQ Date</th>
                        <th>Days</th>
                        <th>RT Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="employee_table">
                    @forelse ($requests as $key => $request)
                        <tr>
                            <td>{{ $key+ $requests->firstItem() }}</td>
                            <td>{{ $request->book->title ? $request->book->title : 'No Title' }}</td>
                            <td>{{ $request->book->author ? $request->book->author : 'No Author' }}</td>
                            <td>{{ $request->req_date ? $request->req_date : 'No Date' }}</td>
                            <td>{{ $request->date_to_return ? getDaysDiff(now(), $request->date_to_return) : _("-") }}</td>
                            <td>{{ $request->date_to_return ? $request->date_to_return : _("-") }}</td>
                            <td><button class="sambtn btn <?php echo match ($request->status) {
                                    0 => 'btn-danger',
                                    1 => 'btn-secondary',
                                    2 => 'btn-success',
                                    3 => 'btn-dark'} 
                                ?> btn-sm">{{ status($request->status) }}</button></td>
                            <td>
                                <div class="btn-group">
                                    @if(Auth()->user()->user_type === 'admin')
                                        @if($request->status === 1)
                                            <button class="btn btn-info btn-sm approve" value="{{ $request->id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Approve">Approve</button> 
                                        @elseif($request->status === 2)
                                            <button class="btn btn-warning btn-sm returned" value="{{ $request->id }}" data-bs-target="#comfirm-delete" data-bs-toggle="modal" title="Approve">Received</button>   
                                        @endif
                                    @endif
                                    <button class="btn btn-success btn-sm edit" value="{{ $request->id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Edit Details">Edit</button>
                                    <button class="btn btn-danger btn-sm delete" value="{{ $request->id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button">Del</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="25">No Data Found</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
            <div class="row">{{ $requests->links() }}</div>
        </div>
    </div>
    @include('modals.medium-modal')
    @include('modals.confirm-modal')

    @push('scripts')
        <script>
            window.onload = function(){
                $('#search').focus();

                // Table filter
                $('#search').keyup(function(){
                    search_table($(this).val());
                });
                function search_table(value){
                    $('#employee_table tr').each(function(){
                        var found = 'false';
                        $(this).each(function(){
                            if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0){
                                found = 'true';
                            }
                        });
                        if(found == 'true'){
                            $(this).show();
                        }
                        else{
                            $(this).hide();
                        }
                    });
                }

                $('#getModal').on('shown.bs.modal', function () {

                    $(document).on('change', '.book', function(){
                        var search = $(this).val();
                        // alert(search);
                        $.ajax({
                            type:"POST",
                            url:"get-books-details",
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                            },
                            data: {
                                search
                            },
                            success:function(data) {
                                if(data.barcode == 'none'){
                                    alert('Book does not Exist!!!');
                                } else {
                                    $("#barcode").val(data.barcode ? data.barcode : 'No Barcode');
                                    $("#isbn").val(data.isbn ? data.isbn : 'No ISBN');
                                    $('#author').val(data.author ? data.author : 'No Author');
                                    $('#title').val(data.title ? data.title : 'No Title');
                                }

                            }
                        });
                    });
                });

                $(document).on('click', '.create', function(){
                    $('.modal-title').text('New Book Request');

                    var createModal=$(this).val();
                    $.get('create-modal/'+createModal, function(result) {

                        $(".modal-body").html(result);

                    })
                });

                $(document).on('click', '.edit', function(){
                    $('.modal-title').text('Edit Book Request');

                    var editModal=$(this).val();
                    $.get('edit-modal/edit_request/'+editModal, function(result) {

                        $(".modal-body").html(result);

                    })
                });

                $(document).on('click', '.approve', function(){
                    $('.modal-title').text('Approve Book Request');

                    var editModal=$(this).val();
                    $.get('edit-modal/approve_request/'+editModal, function(result) {

                        $(".modal-body").html(result);

                    })
                });

                $(document).on('click', '.delete', function(){
                    $('.modal-title').text('Delete Confirmation');

                    var id=$(this).val();
                    $.get('delete-modal/delete_request/'+id, function(result) {

                        $(".modal-body").html(result);

                    })
                });

                $(document).on('click', '.cancel', function(){
                    $('.modal-title').text('Cancel Confirmation');

                    var id=$(this).val();
                    $.get('delete-modal/cancel_request/'+id, function(result) {

                        $(".modal-body").html(result);

                    })
                });

                $(document).on('click', '.returned', function(){
                    $('.modal-title').text('Book Received Confirmation');

                    var id=$(this).val();
                    $.get('delete-modal/returned_request/'+id, function(result) {

                        $(".modal-body").html(result);

                    })
                });
            };

        </script>

    @endpush
@endsection
