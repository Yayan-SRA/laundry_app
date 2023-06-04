@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        {{-- <button class="btn btn-primary">Add New Product</button> --}}
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 p-5 pt-4">
                <h4 class="mb-5">Transaction Data</h4>
                {{-- <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Customer's Name"
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
                    </div> --}}
                @if (request('store'))
                    <form action="/dashboard/super/cashiers/create">
                        <input type="hidden" name="store" value="{{ request('store') }}">
                    @else
                        <form action="/dashboard/cashiers/create">
                @endif
                {{-- @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @elseif(request('author'))
                            <input type="hidden" name="author" value="{{ request('author') }}">
                        @endif --}}
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Customer's Name" name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-dark" type="submit">Search</button>
                </div>
                </form>


                @if (request('search') && $transaction)
                    {{-- <h1>{{ $result->name }}</h1> --}}

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" readonly
                            value="{{ $transaction->customer->name }}" name="name">
                        <label for="name">Customer's Name</label>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="product" readonly
                                    value="{{ $transaction->product }}" name="product">
                                <label for="product">Product</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="service" readonly
                                    value="{{ $transaction->service }}" name="service">
                                <label for="service">Service</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="duration" readonly
                                    value="{{ $transaction->duration }}" name="duration">
                                <label for="duration">Duration</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="price" readonly
                                    value="{{ $transaction->price }}" name="price">
                                <label for="price">Price</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="quantity" readonly
                                    value="{{ $transaction->quantity }}" name="quantity">
                                <label for="quantity">Quantity</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="unit" readonly
                                    value="{{ $transaction->unit }}" name="unit">
                                <label for="unit">Unit</label>
                            </div>
                        </div>
                        <div class="col-md12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control text-center" id="total_price" readonly
                                    value="{{ $transaction->total_price }}" name="total_price">
                                <label for="total_price">Total Price <small>(Rp.)</small></label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="data_entry" readonly
                                    value="{{ $transaction->created_at }}" name="data_entry">
                                <label for="data_entry">Date Entry</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="date_complete" readonly
                                    value="{{ $transaction->date_complete }}" name="date_complete">
                                <label for="date_complete">Date Complete</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                @if ($transaction->is_done)
                                    <input type="text" id="is_done" class="form-control" value="Done" readonly>
                                @else
                                    <input type="text" id="is_done" class="form-control" value="Process" readonly>
                                    <p class="text-danger" style="margin-left: 1em">The process must be done to continue
                                        the payment
                                    </p>
                                @endif
                                <label>Status</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                @if ($transaction->cod)
                                    <input type="text" class="form-control" id="cod" readonly value="Yes"
                                        name="cod">
                                @else
                                    <input type="text" class="form-control" id="cod" readonly value="No"
                                        name="cod">
                                @endif
                                <label for="cod">Cod</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="note" readonly
                                    value="{{ $transaction->note }}" name="note">
                                <label for="note">note</label>
                            </div>
                        </div>
                    </div>
                @elseif (request('search') && !$transaction)
                    <h3>Transaction not found</h3>
                @else
                @endif
            </div>
            <div class="col-lg-5 p-5 pt-4">
                @if (request('search') && $transaction)
                    <h4 class="mb-5">Cashier Data</h4>
                    @if (request('store'))
                        <form method="post" action="/dashboard/super/cashiers?store={{ request('store') }}">
                            @csrf
                            <input type="hidden" name="store" value="{{ request('store') }}">
                        @else
                            <form method="post" action="/dashboard/cashiers">
                                @csrf
                    @endif
                    {{-- <input type="hidden" name="key" value="{{ $transaction->key }}"> --}}
                    <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text"
                                    class="form-control @error('customer_money')
                                        is-invalid
                                    @enderror"
                                    id="customer_money" required value="{{ old('customer_money') }}"
                                    name="customer_money" onchange="getChange()">
                                <label for="customer_money">Customer's Money <small>(Rp.)</small></label>
                                @error('customer_money')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number"
                                    class="form-control @error('income')
                                        is-invalid
                                    @enderror"
                                    id="income" required value="{{ old('income', $transaction->total_price) }}"
                                    name="income" readonly>
                                <label for="income">Price <small>(Rp.)</small></label>
                                @error('income')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text"
                            class="form-control @error('change')
                            is-invalid
                            @enderror"
                            id="change" required value="{{ old('change') }}" name="change" readonly>
                        <p id="err" class="text-danger" style="margin-left: 1em">Forbidden action</p>
                        <label for="change">Change</label>
                        @error('change')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <button type="submit" id="save_btn" class="btn btn-dark"><span data-feather="save"
                                class="mb-1"></span>
                            Input</button>
                    </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <script>
        const customerMoney = document.querySelector('#customer_money');
        const change = document.querySelector('#change');
        const income = document.querySelector('#income');
        const err1 = document.querySelector('#err');
        err1.hidden = true
        const is_done = document.querySelector('#is_done')
        const save_btn = document.querySelector('#save_btn')
        console.log("coba")

        if (is_done.value === 'Process') {
            // console.log(save_btn)
            save_btn.disabled = true
        }

        async function getChange() {
            const result = customerMoney.value - income.value
            change.value = result;
            if (change.value < 0) {
                save_btn.disabled = true
                err1.hidden = false
            } else {
                save_btn.disabled = false
                err1.hidden = true
            }
        }
    </script>
@endsection
