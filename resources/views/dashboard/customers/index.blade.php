@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }} Section</h1>
        @if (request('store'))
            <a href="/dashboard/super/order?store={{ request('store') }}" class="btn btn-primary">Add New Customer</a>
        @else
            <a href="/dashboard/transactions/pre" class="btn btn-primary">Add New Customer</a>
        @endif
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success m-auto " role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('numberFail'))
        <div class="alert alert-danger m-auto " role="alert">
            {{ session('numberFail') }}
        </div>
    @endif
    <div class="container">
        <table class="table mt-5">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Code</th>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    {{-- <th>Address</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $customer->key }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        {{-- <td>{{ $customer->address }}</td> --}}
                        <td>
                            <button class="badge bg-info border-0" data-bs-toggle="modal"
                                data-bs-target="#detail{{ $customer->id }}">
                                <span data-feather="eye"></span>
                            </button>
                            <button class="badge bg-warning border-0" data-bs-toggle="modal"
                                data-bs-target="#edit{{ $customer->id }}"><span data-feather="edit"></span></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('dashboard.customers.modalDetail')
    @include('dashboard.customers.modalEdit')
@endsection
