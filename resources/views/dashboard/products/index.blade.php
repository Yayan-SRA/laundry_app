@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        {{-- <button class="btn btn-primary">Add New Product</button> --}}
    </div>

    <div class="container">
        <div class="row justify-center">
            @foreach ($products as $product)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <img src="https://source.unsplash.com/1200x400?{{ $product->name }}" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <a href="/dashboard/products/{{ $product->name }}">
                                <h5 class="card-title">{{ $product->name }}</h5>
                            </a>
                            {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
