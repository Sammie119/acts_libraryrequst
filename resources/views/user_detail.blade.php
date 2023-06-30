@extends('layouts.app')

@section('content')

    @if(isset($users->user_id) && Auth::user()->user_type === 'admin')

        <div class="container-fluid px-4">
            <h1 class="mt-1">User Details</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">User Details</li>
            </ol>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="text-danger" role="alert">{{$error}}</div>
                @endforeach
            @endif
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Users
{{--                    <button class="btn btn-sm btn-primary float-end create" value="new_user" data-bs-target="#getModal" data-bs-toggle="modal" title="New User">Add User</button>--}}
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
                            <th>Full Name</th>
                            <th>User Type</th>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Emg. Contact</th>
                            <th>Emg. Contact</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="employee_table">
                        @forelse ($adminUsers as $key => $user)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $user->fullname }}</td>
                                <td>{{ ucfirst($user->user_type) }}</td>
                                <td>{{ $user->id_number }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->emg_person }}</td>
                                <td>{{ $user->emg_phone }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-success btn-sm edit" value="{{ $user->user_details_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Edit Details">Edit</button>
                                        <button class="btn btn-danger btn-sm delete" value="{{ $user->user_details_id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button">Del</button>
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

                    $('#editModal').on('shown.bs.modal', function () {

                    });

                    // $(document).on('click', '.create', function(){
                    //     $('.modal-title').text('Add New User');
                    //
                    //     var createModal=$(this).val();
                    //     $.get('create-modal/'+createModal, function(result) {
                    //
                    //         $(".modal-body").html(result);
                    //
                    //     })
                    // });

                    $(document).on('click', '.edit', function(){
                        $('.modal-title').text('Edit User Details');

                        var editModal=$(this).val();
                        $.get('edit-modal/edit_user_detail/'+editModal, function(result) {

                            $(".modal-body").html(result);

                        })
                    });

                    $(document).on('click', '.delete', function(){
                        $('.modal-title').text('Delete Confirmation');

                        var id=$(this).val();
                        $.get('delete-modal/delete_user_detail/'+id, function(result) {

                            $(".modal-body").html(result);

                        })
                    });

                };

            </script>

        @endpush

    @else

        <div class="container">
            <div class="row justify-content-center">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="text-danger" role="alert">{{$error}}</div>
                    @endforeach
                @endif
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('User Details') }}</div>

                        @include('forms.input.user_detail_form')

                    </div>
                </div>
            </div>
        </div>

    @endif

@endsection
