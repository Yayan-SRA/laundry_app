{{-- @dd($store) --}}
@extends('dashboard.layouts.main')

@section('content')
    <?php
    $total = $items->count();
    ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">{{ request('attr') }}</h1>
    </div>

    <div class="container" onload="myfunc()">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            @if (request('attr') !== 'Types')
                                <th>Type</th>
                            @endif
                            <th>{{ request('attr') }}</th>
                            @if (request('attr') === 'Durations')
                                <th>Unit</th>
                            @endif
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            {{-- @foreach ($existingProducts as $item) --}}
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @if (request('attr') !== 'Types')
                                    <td>{{ $item->type->name }}</td>
                                @endif
                                @if (request('attr') === 'Durations')
                                    <td>{{ $item->time_period }}</td>
                                    <td>{{ $item->unit->name }}</td>
                                @else
                                    <td>{{ $item->name }}</td>
                                @endif
                                <td>
                                    <form action="/dashboard/super/attributes" method="post">
                                        @csrf
                                        <input type="hidden" id="store_id" name="store_id" value="{{ $selected->id }}">
                                        <input type="hidden" id="{{ request('attr') }}_id"
                                            name="{{ strtolower(request('attr')) }}_id" value="{{ $item->id }}">
                                        <input type="hidden" id="inhid" name="checkbox" value="inactive">
                                        <label class="switch">
                                            <input type="hidden" id="attr" name="attr"
                                                value="{{ request('attr') }}">

                                            <input type="hidden"
                                                id="{{ strtolower(request('attr')) }}{{ $loop->iteration }}"
                                                name="{{ strtolower(request('attr')) }}_id" value="{{ $item->id }}">

                                            <input type="checkbox" name="checkbox" value="{{ $item->name }}"
                                                id="checkbox{{ $loop->iteration }}" onclick="clickFn(event)">
                                            {{-- @endif --}}
                                            <span class="slider round"></span>
                                        </label>
                                    </form>
                                </td>
                            </tr>
                            {{-- @endforeach --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const check = document.querySelector('#checkbox');
        const amount = {{ $total }}
        const store = {{ $selected->id }}
        const attr = document.querySelector(`#attr`).value

        // console.log(toLowerCase(attr))

        for (let i = 1; i <= amount; i++) {
            console.log(document.querySelector(`#{{ strtolower(request('attr')) }}${i}`).value)
            const id = document.querySelector(`#{{ strtolower(request('attr')) }}${i}`).value
            tryy(id, i)
            // const name = document.querySelector(`#checkbox${num}`).value;
            // console.log(name)
            // console.log(document.querySelector(`#checkbox${i}`))
        }

        async function tryy(num, loop) {
            // const tes = await fetch("/compare/find?service_id=" +
            //     num + '&' + 'store_id=' + store)
            const tes = await fetch(`/compare/find?attr_id=${num}&store_id=${store}&attr=${attr}`)
            const coba = await tes.json()
            console.log(coba)
            if (coba.length === 0) {
                console.log("yeay");
                // pro.checked = false
                document.querySelector(`#checkbox${loop}`).checked = false
            } else {
                console.log("wei");
                // console.log(loop);
                document.querySelector(`#checkbox${loop}`).checked = true
            }
        }

        function clickFn(event) {
            const checkbox = event.currentTarget;
            if (checkbox.checked) {
                document.getElementById('inhid').disabled = true;
                checkbox.value = 'active'
                event.currentTarget.closest('form').submit()
            } else {
                event.currentTarget.closest('form').submit()
            }
        }
    </script>
@endsection
