@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome back, {{ auth()->user()->name }} </h1>
        {{-- <a href="/dashboard/transactions/create" class="btn btn-primary">Add Order</a> --}}
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success m-auto mb-3" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div class="row justify-center p-4">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <a href="/dashboard/transactions/pre" class="text-decoration-none text-dark text-center">
                        {{-- <a href="/dashboard/transactions/create" class="text-decoration-none text-dark text-center"> --}}
                        <img src="https://source.unsplash.com/1200x400?laundry" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Add Order</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <a href="/dashboard/cashiers/create" class="text-decoration-none text-dark text-center">
                        <img src="https://source.unsplash.com/1200x400?cashier" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Cashier</h5>
                            {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <a href="/dashboard/customers" class="text-decoration-none text-dark text-center">
                        <img src="https://source.unsplash.com/1200x400?customer" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Customer</h5>
                            {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <a href="/dashboard/transactions" class="text-decoration-none text-dark text-center">
                        <img src="https://source.unsplash.com/1200x400?transaction" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Transaction</h5>
                            {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <a href="/dashboard/expenditures/create" class="text-decoration-none text-dark text-center">
                        <img src="https://source.unsplash.com/1200x400?rich" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Expenditure</h5>
                            {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
