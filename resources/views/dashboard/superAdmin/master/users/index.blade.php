@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }} Section</h1>
        <a href="/dashboard/super/master/user/register" class="btn btn-dark">Add New User</a>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success m-auto mb-3" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div class="col-md-8 m-auto">
            <table class="table table-striped table-hover mt-5">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Store</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->store->name }}</td>
                            <td>{{ $data->role->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('dashboard.superAdmin.master.stores.modalAddStore')
@endsection
