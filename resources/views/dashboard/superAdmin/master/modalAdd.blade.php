<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabel">Add</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/dashboard/super/master/attributes" method="post">
                @csrf
                <input type="hidden" name="attr" value="{{ request('attr') }}">
                <div class="modal-body">
                    @if (request('attr') === 'Durations')
                        <div class="form-floating mb-3">
                            <input type="number"
                                class="form-control @error('time_period')
                                is-invalid
                            @enderror"
                                id="time_period" required value="{{ old('time_period') }}" name="time_period">
                            <label for="time_period">Time Period</label>
                            @error('time_period')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <select
                                class="form-select @error('unit_id')
                                            is-invalid
                                        @enderror"
                                id="unit_id" required name="unit_id">
                                <option value="">Select Unit</option>
                                @foreach ($units as $data)
                                    @if (old('unit_id') == $data->id)
                                        <option value="{{ $data->id }}" selected>{{ $data->name }}
                                        </option>
                                    @else
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="unit_id">units</label>
                            @error('unit_id')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    @elseif (request('attr') === 'Prices')
                        <div class="form-floating mb-3">
                            <select
                                class="form-select @error('type_id')
                                    is-invalid
                                @enderror"
                                id="type_id" required name="type_id">
                                <option value="">Select Type</option>
                                @foreach ($types as $data)
                                    @if (old('type_id') == $data->id)
                                        <option value="{{ $data->id }}" selected>{{ $data->name }}
                                        </option>
                                    @else
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="type_id">Types</label>
                            @error('type_id')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <select
                                class="form-select @error('product_id')
                                    is-invalid
                                @enderror"
                                id="product_id" required name="product_id">
                                <option value="">Select Product</option>
                                @foreach ($products as $data)
                                    @if (old('product_id') == $data->id)
                                        <option value="{{ $data->id }}" selected>{{ $data->name }}
                                        </option>
                                    @else
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
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
                        <div class="form-floating mb-3">
                            <select
                                class="form-select @error('service_id')
                                    is-invalid
                                @enderror"
                                id="service_id" required name="service_id">
                                <option value="">Select Service</option>
                                @foreach ($services as $data)
                                    @if (old('service_id') == $data->id)
                                        <option value="{{ $data->id }}" selected>{{ $data->name }}
                                        </option>
                                    @else
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
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
                        <div class="form-floating mb-3">
                            <select
                                class="form-select @error('duration_id')
                                    is-invalid
                                @enderror"
                                id="duration_id" required name="duration_id">
                                <option value="">Select Duration</option>
                                @foreach ($durations as $data)
                                    @if (old('duration_id') == $data->id)
                                        <option value="{{ $data->id }}" selected>{{ $data->time_period }}
                                            {{ $data->unit->name }}
                                        </option>
                                    @else
                                        <option value="{{ $data->id }}">{{ $data->time_period }}
                                            {{ $data->unit->name }}</option>
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
                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control @error('price')
                            is-invalid
                        @enderror"
                                id="price" required value="{{ old('price') }}" name="price">
                            <label for="price">Price</label>
                            @error('price')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    @else
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
                    @endif
                    @if (request('attr') === 'Types' || request('attr') === 'Prices' || request('attr') === 'Units')
                    @else
                        <div class="form-floating mb-3">
                            <select
                                class="form-select @error('type_id')
                                        is-invalid
                                    @enderror"
                                id="type_id" required name="type_id">
                                <option value="">Select Type</option>
                                @foreach ($types as $data)
                                    @if (old('type_id') == $data->id)
                                        <option value="{{ $data->id }}" selected>{{ $data->name }}</option>
                                    @else
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="type_id">Types</label>
                            @error('type_id')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
