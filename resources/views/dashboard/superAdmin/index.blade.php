{{-- @dd($store) --}}
@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Welcome, {{ auth()->user()->name }} in command area</h1>
        <form action="/dashboard/super">
            <div class="input-group">
                <select class="form-select " name="store" id="store">
                    <option value="master">Master</option>
                    @foreach ($stores as $store)
                        @if (request('store'))
                            @if ($store->id === $selected->id)
                                <option value="{{ $store->name }}" selected onclick="clickFn(event)">{{ $store->name }}
                                </option>
                            @else
                                <option value="{{ $store->name }}" onclick="clickFn(event)">{{ $store->name }}</option>
                            @endif
                        @else
                            <option value="{{ $store->name }}" onclick="clickFn(event)">{{ $store->name }}</option>
                        @endif
                    @endforeach
                </select>
                <button class="btn btn-dark" type="submit">Change</button>
            </div>
        </form>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success m-auto mb-3" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center p-5">
        <div class="col-6 col-md-6 mb-4">
            <div class="card bg-dark">
                <a href="" class="text-decoration-none text-dark text-center" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <img src="https://source.unsplash.com/1200x400?attributes" class="card-img-top" alt="attributes">
                    <div class="card-body text-center">
                        <h5 class="card-title  text-white">Attributes</h5>
                    </div>
                </a>
            </div>
        </div>
        @if (request('store'))
            <div class="col-6 col-md-6 mb-4">
                <div class="card bg-dark">
                    <a href="/dashboard/super/order?store={{ request('store') }}"
                        class="text-decoration-none text-dark text-center">
                        <img src="https://source.unsplash.com/1200x400?transactions" class="card-img-top"
                            alt="transactions">
                        <div class="card-body">
                            <h5 class="card-title text-white">Add Order</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-6 col-md-6 mb-4">
                <div class="card bg-dark">
                    <a href="/dashboard/super/transactions?store={{ $selected->name }}"
                        class="text-decoration-none text-dark text-center">
                        <img src="https://source.unsplash.com/1200x400?transactions" class="card-img-top"
                            alt="transactions">
                        <div class="card-body text-center">
                            <h5 class="card-title text-white">Transactions</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-6 col-md-6 mb-4">
                <div class="card bg-dark">
                    <a href="/dashboard/super/customers?store={{ $selected->name }}"
                        class="text-decoration-none text-dark text-center">
                        <img src="https://source.unsplash.com/1200x400?customers" class="card-img-top" alt="customers">
                        <div class="card-body text-center">
                            <h5 class="card-title text-white">Customers</h5>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-6 col-md-6 mb-4">
                <div class="card bg-dark">
                    <a href="/dashboard/super/cashiers/create?store={{ request('store') }}"
                        class="text-decoration-none text-dark text-center">
                        <img src="https://source.unsplash.com/1200x400?money" class="card-img-top" alt="payments">
                        <div class="card-body">
                            <h5 class="card-title text-white">Cashier</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-6 col-md-6 mb-4">
                <div class="card bg-dark">
                    <a href="/dashboard/super/expenditure/create?store={{ request('store') }}"
                        class="text-decoration-none text-dark text-center">
                        <img src="https://source.unsplash.com/1200x400?buy" class="card-img-top" alt="buy">
                        <div class="card-body">
                            <h5 class="card-title text-white">Expenditure</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-6 col-md-6 mb-4">
                <div class="card bg-dark">
                    <a href="/dashboard/super/finance?store={{ request('store') }}"
                        class="text-decoration-none text-dark text-center">
                        <img src="https://source.unsplash.com/1200x400?finance" class="card-img-top" alt="finance">
                        <div class="card-body">
                            <h5 class="card-title text-white">Finance</h5>
                        </div>
                    </a>
                </div>
            </div>
        @else
            <div class="col-6 col-md-6 mb-4">
                <div class="card bg-dark">
                    <a href="/dashboard/super/master/user" class="text-decoration-none text-dark text-center">
                        <img src="https://source.unsplash.com/1200x400?user" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-white">User</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-6 col-md-6 mb-4">
                <div class="card bg-dark">
                    <a href="/dashboard/super/master/store" class="text-decoration-none text-dark text-center">
                        <img src="https://source.unsplash.com/1200x400?store" class="card-img-top" alt="store">
                        <div class="card-body">
                            <h5 class="card-title text-white">Store</h5>
                        </div>
                    </a>
                </div>
            </div>
        @endif
    </div>
    @include('dashboard.superAdmin.modal')

    <script>
        function clickFn(event) {
            console.log("masuk sini")
            const choosenStore = event.currentTarget;
            event.currentTarget.closest('form').submit()
        }
    </script>
@endsection
