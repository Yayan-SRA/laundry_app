@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }} Section</h1>
        <a href="" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addStore">Add New Store</a>
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
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stores as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->address }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('dashboard.superAdmin.master.stores.modalAddStore')
@endsection
