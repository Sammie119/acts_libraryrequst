@extends('layouts.app')

<style>
    .tetx-head {
        margin: auto;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .footer-number {
        margin: auto;
        font-size: 1.2rem;
    }
</style>

@section('content')
<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Sammie Sarpong-Duah') }}
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="container-fluid px-4">
    <h1 class="mt-1">Dashboard</h1>
    <ol class="breadcrumb mb-4">

    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body tetx-head">Total Users</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <label class="footer-number">{{ homePageData()['users'] }}</label>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body tetx-head">Total Books</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <label class="footer-number">{{ homePageData()['books'] }}</label>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body tetx-head">Available Books</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <label class="footer-number">{{ __(00000) }}</label>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body tetx-head">Borrowed Books</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <label class="footer-number">{{ __(00000) }}</label>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <label style="font-size: 1.4rem; font-weight: bold">Users List</label>
            <label style="font-size: 1.4rem; font-weight: bold">Users List</label>

             <input class="form-control float-end" type="text" id="search" style="height: 32px; width: 300px">
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>User Type</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody id="employee_table">
                @forelse ($results['users'] as $key => $user)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->user_type }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="40">No data Found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

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

        };
    </script>
@endpush

@endsection
