@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }} Section</h1>
        <a href="/dashboard/transactions/create" class="btn btn-primary">Add New Order</a>
    </div>

    <div class="container">
        <table class="table mt-5">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Customer Name</th>
                    <th>Type</th>
                    <th>Date Entry</th>
                    <th>Date Complete</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->customer->name }}</td>
                        <td>{{ $transaction->product->name }}</td>
                        <td>{{ $transaction->created_at }}</td>
                        <td>{{ $transaction->date_complete }}</td>
                        <td>
                            <a href="" class="badge bg-info"><span data-feather="eye"></span></a>
                            @if ($transaction->is_done)
                                <a href="" class="badge bg-success"><span data-feather="check-circle"></span></a>
                            @else
                                <a href="" class="badge bg-warning"><span data-feather="clock"></span></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
