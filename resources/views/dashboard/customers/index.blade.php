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
                            <a href="" class="badge bg-warning"><span data-feather="edit"></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
