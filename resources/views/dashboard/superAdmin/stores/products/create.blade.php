@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome back, {{ auth()->user()->name }} in command area</h1>
    </div>

    <div class="container">
        <form action="/dashboard/super" method="post">
            @csrf
            <div class="row">
                @for ($i = 0; $i < $l; $i++)
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select
                                class="form-select @error('store_id')
                                    is-invalid
                                @enderror"
                                id="store_id" required name="store_id[ ]">
                                <option>Select Store</option>
                                @foreach ($stores as $store)
                                    @if (old('store_id') == $store->id)
                                        <option value="{{ $store->id }}" selected>{{ $store->name }}</option>
                                    @else
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="store_id">stores</label>
                            @error('store_id')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select
                                class="form-select @error('product_id')
                                    is-invalid
                                @enderror"
                                id="product_id" required name="product_id[]">
                                <option>Select Product</option>
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
                @endfor

            </div>
            <button class="btn btn-primary" type="submit">Save</button>
        </form>
    </div>
@endsection
