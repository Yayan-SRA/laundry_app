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

            @if (request('store'))
                <button type="button" class="btn btn-dark mt-4 mb-1" data-bs-toggle="modal" data-bs-target="#export">
                    <span data-feather="download" class="mb-1"></span> Export
                </button>
            @endif
            <!-- Modal -->
            <div class="modal fade" id="export" tabindex="-1" aria-labelledby="exportLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exportLabel">Export Transaction Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/dashboard/transactions/export" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" required id="start"
                                                name="start">
                                            <label for="start">Start</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" required id="end"
                                                name="end">
                                            <label for="end">End</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-dark"><span data-feather="download"
                                            class="mb-1"></span> Export</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Code</th>
                        <th>Customer</th>
                        <th>Product</th>
                        {{-- <th>Target Complete</th> --}}
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
                            {{-- <td>{{ $transaction->target_date_complete }}</td> --}}
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
                                        <a href="/dashboard/super/cashiers/create?store={{ request('store') }}&search={{ $transaction->key }}"
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
