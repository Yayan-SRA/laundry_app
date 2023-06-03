@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        {{-- <button class="btn btn-primary">Add New Product</button> --}}
    </div>

    <div class="container">
        <div class="col-lg-5 p-5 pt-4">
            <h4 class="mb-5">Input Expenditure</h4>
            @if (request('store'))
                <form method="post" action="/dashboard/super/expenditure?store={{ request('store') }}">
                    @csrf
                    <input type="hidden" name="store" value="{{ request('store') }}">
                @else
                    <form method="post" action="/dashboard/expenditures">
                        @csrf
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input type="text"
                            class="form-control @error('name')
                                        is-invalid
                                    @enderror"
                            id="name" required value="{{ old('name') }}" name="name">
                        <label for="name">Name</label>
                        @error('name')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="number"
                            class="form-control @error('price')
                                        is-invalid
                                    @enderror"
                            id="price" required value="{{ old('price') }}" name="price" onchange="getPrice()">
                        <label for="price">Price <small>(Rp.)</small></label>
                        @error('price')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text"
                            class="form-control @error('quantity')
                                    is-invalid
                                @enderror"
                            id="quantity" required value="{{ old('quantity') }}" name="quantity" onchange="getPrice()">
                        <label for="quantity">Quantity</label>
                        @error('quantity')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <select
                            class="form-select @error('unit_id')
                                    is-invalid
                                @enderror"
                            id="unit_id" required name="unit_id" onchange="getPrice()">
                            <option value=""></option>
                            @foreach ($units as $data)
                                @if (old('unit_id') == $data->id)
                                    <option value="{{ $data->id }}" selected>{{ $data->name }}
                                    </option>
                                @else
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="unit_id">Units</label>
                        @error('unit_id')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input type="number"
                            class="form-control @error('total')
                                        is-invalid
                                    @enderror"
                            id="total" required value="{{ old('total') }}" name="total" readonly>
                        <label for="total">Total <small>(Rp.)</small></label>
                        @error('total')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" id="save_btn" class="btn btn-secondary"><span data-feather="save"
                            class="mb-1"></span>
                        Input</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script>
        const total = document.querySelector('#total');
        const price = document.querySelector('#price');
        const quantity = document.querySelector('#quantity');
        async function getPrice() {
            const result = price.value * quantity.value
            total.value = result;
        }
    </script>
@endsection
