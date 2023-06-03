@extends('dashboard.layouts.main')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-5">Choose the order type :</h1>
        <div class="row justify-content-center">
            @foreach ($types as $type)
                <div class="col-6 col-md-4">
                    <div class="card">
                        @if (request('store'))
                            <a href="/dashboard/super/order/create?store={{ request('store') }}&type={{ $type->name }}">
                            @else
                                <a href="/dashboard/transactions/create?type={{ $type->name }}">
                        @endif
                        <img src="https://source.unsplash.com/300x300?clothes" class="card-img" alt="{{ $type->name }}">
                        <div class="card-img-overlay d-flex align-items-center p-0">
                            <h5 class="card-title text-white text-decoration-none flex-fill text-center p-4 fs-3"
                                style="background-color: rgba(0, 0, 0, 0.7)">
                                {{ $type->name }}
                            </h5>
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
