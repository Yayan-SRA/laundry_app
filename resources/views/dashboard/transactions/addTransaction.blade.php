@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        {{-- <button class="btn btn-primary">Add New Product</button> --}}
    </div>


    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-12 p-5 pt-4">
            <h4 class="mb-5">Customer Data</h4>
            {{-- <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Customer's Name"
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
                    </div> --}}
            @if (session()->has('success'))
                <div class="alert alert-success m-auto mb-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (request('store'))
                <form action="/dashboard/super/order/create">
                    <input type="hidden" name="store" value="{{ request('store') }}">
                @else
                    <form action="/dashboard/transactions/create">
            @endif
            <input type="hidden" name="type" value="{{ request('type') }}">
            {{-- @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @elseif(request('author'))
                            <input type="hidden" name="author" value="{{ request('author') }}">
                        @endif --}}
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Name, code or phone number" name="search"
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
            </form>


            @if (request('search') && $result)
                {{-- <h1>{{ $result->name }}</h1> --}}
                <div class="form-floating mb-3 mt-5">
                    <input type="text" class="form-control" id="name" value="{{ $result->name }}" name="name"
                        readonly>
                    <label for="name">Name</small> </label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="phone_number" value="{{ $result->phone_number }}"
                        name="phone_number" readonly>
                    <label for="phone_number">Phone Number</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="address" value="{{ $result->address }}" name="address"
                        readonly>
                    <label for="address">Address</label>
                </div>
            @else
                @if (request('search') && !$result)
                    {{-- <p class="mb-5">No matching data, add data</p> --}}
                    {{-- <script>
                                
                            </script> --}}
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>No matching data</strong>, Add new customer data
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (request('store'))
                    <form method="post" action="/dashboard/customers" class="mt-5">
                        <input type="hidden" name="store" value="{{ request('store') }}">
                        <input type="hidden" name="type" value="{{ request('type') }}">
                    @else
                        <form method="post" action="/dashboard/customers" class="mt-5">
                @endif
                @csrf
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
                <div class="form-floating mb-3">
                    <input type="number"
                        class="form-control @error('phone_number')
                                is-invalid
                                @enderror"
                        id="phone_number" value="{{ old('phone_number') }}" name="phone_number">
                    <label for="phone_number">Phone Number </label>
                    @error('phone_number')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <textarea type="text"
                        class="form-control @error('address')
                                is-invalid
                                @enderror"
                        id="address" value="{{ old('address') }}" name="address"></textarea>
                    <label for="address">Address </label>
                    @error('address')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary"><span data-feather="save" class="mb-1"></span>
                        Save</button>
                </div>
                </form>
            @endif
        </div>
        <div class="col-lg-8 col-md-12 p-5 pt-4">
            <h4 class="mb-5">Laundry Data</h4>
            <form method="post" action="/dashboard/transactions">
                @csrf
                @if (request('search') && $result)
                    <input type="hidden" name="customer_id" id="customer_id" value="{{ $result->id }}">
                    <input type="hidden" name="store" id="store" value="{{ request('store') }}">
                @endif
                <div class="row">
                    <div class="col-6 col-md-6">
                        <div class="form-floating mb-3">
                            {{-- <select
                                    class="form-select @error('type_id')
                                            is-invalid
                                        @enderror"
                                    id="type_id" required name="type_id" onchange="getPrice()" readonly>
                                    <option value="">Select Type</option>
                                    @foreach ($types as $type)
                                        @if (old('type_id') == $type->id || $pre->id == $type->id)
                                            <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                                        @else
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endif
                                    @endforeach
                                </select> --}}
                            <input type="hidden" id="type_id" name="type_id" value="{{ $type->id }}">
                            <input type="text"
                                class="form-control @error('type_id')
                                        is-invalid
                                    @enderror"
                                id="type" value="{{ $type->name }}" name="type" readonly>
                            <label for="type">Type</label>
                            @error('type_id')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-md-6">
                        <div class="form-floating mb-3">
                            <select
                                class="form-select @error('product_id')
                                            is-invalid
                                        @enderror"
                                id="product_id" required name="product_id" onchange="getPrice()">
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                    @if (old('product_id') == $product->id)
                                        <option value="{{ $product->id }}" selected>{{ $product->name }}</option>
                                    @else
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="product_id">Products</label>
                            @error('product_id')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6 col-md-6">
                        <div class="form-floating mb-3">
                            <select
                                class="form-select @error('service_id')
                                            is-invalid
                                        @enderror"
                                id="service_id" required name="service_id" onchange="getPrice()">
                                <option value="">Select Service</option>
                                @foreach ($services as $service)
                                    @if (old('service_id') == $service->id)
                                        <option value="{{ $service->id }}" selected>{{ $service->name }}</option>
                                    @else
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="service_id">Services</label>
                            @error('service_id')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-md-6">
                        <div class="form-floating mb-3">
                            <select
                                class="form-select @error('duration_id')
                                            is-invalid
                                        @enderror"
                                id="duration_id" required name="duration_id" onchange="getPrice()">
                                <option value="">Select Duration</option>
                                @foreach ($durations as $duration)
                                    @if (old('duration_id') == $duration->id)
                                        <option value="{{ $duration->id }}" selected>{{ $duration->time_period }}
                                            {{ $duration->unit->name }}
                                        </option>
                                    @else
                                        <option value="{{ $duration->id }}">{{ $duration->time_period }}
                                            {{ $duration->unit->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="duration_id">Durations</label>
                            @error('duration_id')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control @error('price')
                                        is-invalid
                                    @enderror"
                                id="price" required value="{{ old('price') }}" name="price" readonly>
                            <label for="price">Price <small>(Rp.)</small></label>
                            @error('price')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control @error('quantity')
                                        is-invalid
                                    @enderror"
                                id="quantity" required value="{{ old('quantity') }}" name="quantity">
                            <label for="quantity">Quantity</label>
                            @error('quantity')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="form-floating mb-3">
                            <select
                                class="form-select @error('unit_id')
                                            is-invalid
                                        @enderror"
                                id="unit_id" required name="unit_id">
                                <option value="">Select Unit</option>
                                @if ($units->count() > 1)
                                    <option value="{{ $units->id }}" selected>{{ $units->name }}</option>
                                @else
                                    @foreach ($units as $unit)
                                        @if (old('unit_id') == $unit->id)
                                            <option value="{{ $unit->id }}" selected>{{ $unit->name }}</option>
                                        @else
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            <label for="unit_id">Units</label>
                            @error('unit_id')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- <input type="text" id="tes"> --}}
                <div class="form-floating mb-3">
                    <input type="number"
                        class="form-control @error('total_price')
                                is-invalid
                            @enderror"
                        id="total_price" required value="{{ old('total_price') }}" name="total_price" readonly>
                    <label for="total_price">Total Price <small>(Rp.)</small></label>
                    @error('total_price')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-6 col-md-6">
                        <div class="form-floating mb-3">
                            <select
                                class="form-select @error('cod')
                                            is-invalid
                                        @enderror"
                                id="cod" required name="cod">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                            <label for="cod">COD</label>
                            @error('cod')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="date"
                                class="form-control @error('target_date_complete')
                                        is-invalid
                                    @enderror"
                                id="target_date_complete" required value="{{ old('target_date_complete') }}"
                                name="target_date_complete">
                            <label for="target_date_complete">Target Date Complete</label>
                            @error('target_date_complete')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <textarea type="text"
                        class="form-control @error('note')
                                is-invalid
                            @enderror"
                        id="note" value="{{ old('note') }}" name="note"></textarea>
                    <label for="note">Note</small></label>
                    @error('note')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                @if (request('search') && $result)
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary"><span data-feather="save" class="mb-1"></span>
                            Save</button>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <script>
        const type = document.querySelector('#type_id');
        // console.log(type)
        const product = document.querySelector('#product_id');
        const service = document.querySelector('#service_id');
        const duration = document.querySelector('#duration_id');
        const price = document.querySelector('#price');
        const quantity = document.querySelector('#quantity');
        const total_price = document.querySelector('#total_price');

        // product.addEventListener('change', function() {
        //     fetch('/price/find?product=' + product.value + '&' + 'service=' + service.value + '&' +
        //             'duration=' + duration.value)
        //         // fetch('/price/find?product=' + product.value)
        //         .then(response => response.json())
        //         .then(data => price.value = data.price)
        //     // console.log("isi tes", tes)
        // });
        quantity.addEventListener('change', function() {
            total_price.value = quantity.value * price.value
        });

        async function getPrice() {
            // console.log('type', type.value)
            const tes = await fetch('/price/find?type=' + type.value + '&' + 'product=' + product.value + '&' +
                'service=' + service.value + '&' + 'duration=' + duration.value)
            // tes.then(response => response.json())
            //     .then(data => price.value = data.price)
            const coba = await tes.json()
            console.log(typeof(coba))
            console.log(typeof(coba.price))

            // console.log("coba", coba)
            // console.log("coba", coba.price)
            if (coba.price == undefined) {
                price.value = coba
            } else {
                price.value = coba.price
            }
        }
    </script>
@endsection
