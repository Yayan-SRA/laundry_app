{{-- @dd($store) --}}
@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">{{ $title }}</h1>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">Add New
            {{ $title }}</button>
    </div>

    <div class="container mt-5">
        @if (session()->has('success'))
            <div class="alert alert-success col-md-6 m-auto mb-3" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="col-md-6 m-auto">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No.</th>
                        @if (request('attr') === 'Durations')
                            <th class="text-center">{{ request('attr') }}</th>
                            <th>Unit</th>
                        @elseif (request('attr') === 'Prices')
                            <th>Type</th>
                            <th>Product</th>
                            <th>Service</th>
                            <th>Duration</th>
                            <th>Price</th>
                        @else
                            <th>{{ request('attr') }}</th>
                        @endif
                        @if (request('attr') === 'Types' || request('attr') === 'Prices' || request('attr') === 'Units')
                        @else
                            <th>Type</th>
                        @endif
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $item)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            @if (request('attr') === 'Durations')
                                <td class="text-center">{{ $item->time_period }}</td>
                                <td>{{ $item->unit->name }}</td>
                            @elseif (request('attr') === 'Prices')
                                <td>{{ $item->type->name }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->service->name }}</td>
                                <td>{{ $item->duration->time_period }} {{ $item->duration->unit->name }}</td>
                                <td>{{ $item->price }}</td>
                            @else
                                <td>{{ $item->name }}</td>
                            @endif
                            @if (request('attr') === 'Types' || request('attr') === 'Prices' || request('attr') === 'Units')
                            @else
                                <td>{{ $item->type->name }}</td>
                            @endif
                            <td class="text-center">
                                <button type="button" data-bs-toggle="modal" id="edit{{ $loop->index }}"
                                    value="{{ $loop->index }}" data-bs-target="#modal{{ $item->id }}"
                                    class="btn btn-warning border-0 text-white"><span data-feather="edit"
                                        class="mb-1"></button>
                                {{-- <a href="/dashboard/posts/edit" class="btn btn-warning text-white"><span data-feather="edit"
                                            class="mb-1"></span>
                                            Edit</a> --}}
                                <form
                                    action="/dashboard/super/master/attributes?attr={{ request('attr') }}&id={{ $item->id }}"
                                    method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    @if (request('attr') !== 'Types')
                                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span
                                                data-feather="trash-2" class="mb-1"></span></button>
                                    @endif
                                </form>
                                {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#modal"
                                            class="badge bg-danger border-0"><span data-feather="trash-2"></button> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {{-- <button type="button" data-bs-toggle="modal" id="edit{{ $loop->index }}"
                            value="{{ $loop->index }}" data-bs-target="#modal"
                            class="btn btn-warning border-0 text-white"><span data-feather="edit"
                                class="mb-1"></button> --}}

    @include('dashboard.superAdmin.master.modalEdit')

    @include('dashboard.superAdmin.master.modalAdd')
    {{-- <script>
        const amount = {{ $results->count() }}
        for (let i = 0; i < amount; i++) {
            // const element = array[i];
            const edit = document.querySelector(`#edit${i}`);
            edit.addEventListener('click', function() {
                console.log('iki', i)
                // const data = await fetch("/dashboard/super/master/attributes")
                console.log(edit.value)
            })

        }

        function click() {
            var data = "ini data";
            document.getElementById("data").value = data;
            document.getElementById("form").submit();
        }
        var klik = document.getElementById("btn");
        klik.addEventListener("click", click);
    </script> --}}
@endsection
