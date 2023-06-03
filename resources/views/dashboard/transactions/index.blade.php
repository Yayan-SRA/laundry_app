@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }} Section</h1>
        @if (request('store'))
            <a href="/dashboard/super/order?store={{ request('store') }}" class="btn btn-dark">Add New Order</a>
        @else
            <a href="/dashboard/transactions/pre" class="btn btn-dark">Add New Order</a>
        @endif
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
                        <th>Code</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Target Complete</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->key }}</td>
                            <td>{{ $transaction->customer->name }}</td>
                            <td>{{ $transaction->product }}</td>
                            <td>{{ $transaction->target_date_complete }}</td>
                            <td>
                                {{-- <a href="" class="badge bg-info"><span data-feather="eye"></span></a> --}}
                                <button class="badge bg-info border-0" data-bs-toggle="modal"
                                    data-bs-target="#detail{{ $transaction->id }}">
                                    <span data-feather="eye"></span>
                                </button>
                                @if ($transaction->is_done)
                                    <div class="badge bg-success"><span data-feather="check-circle"></span></div>
                                @else
                                    <button class="badge bg-warning border-0" data-bs-toggle="modal"
                                        data-bs-target="#isDone{{ $transaction->id }}">
                                        <span data-feather="clock">
                                    </button>
                                    {{-- <a href="" class="badge bg-warning"><span data-feather="clock"></span></a> --}}
                                @endif
                                @if ($transaction->is_paid)
                                    <div class="badge bg-success"><span data-feather="dollar-sign"></span></div>
                                @else
                                    @if (request('store'))
                                        <a href="/dashboard/super/cashiers/create?store={{ request('store') }}&search={{ $transaction->customer->name }}"
                                            class="badge bg-danger"><span data-feather="dollar-sign"></span></a>
                                    @else
                                        <a href="/dashboard/cashiers/create?search={{ $transaction->customer->name }}"
                                            class="badge bg-danger"><span data-feather="dollar-sign"></span></a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('dashboard.transactions.modalDetail')
    @include('dashboard.transactions.modalIsDone')
@endsection
