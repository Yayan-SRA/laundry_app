@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success m-auto mb-3" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div class="col-md-8 m-auto">
            <table class="table table-striped table-hover mt-5">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Type</th>
                        <th>Nominal</th>
                        <th>Final Finance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($finances as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->type }}</td>
                            <td>@rupiah($data->nominal)</td>
                            <td> @rupiah($data->final_finance) </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- @include('dashboard.transactions.modalDetail')
    @include('dashboard.transactions.modalIsDone') --}}
@endsection
