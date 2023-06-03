@extends('layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <main class="form-registration w-100 m-auto">
                <h1 class="mb-5 mt-2 fw-normal text-center">Registration Form</h1>
                <form method="post" action="/dashboard/super/master/user/register">
                    @csrf
                    <div class="form-floating">
                        <input type="text" name="name"
                            class="form-control rounded-top @error('name')
                            is-invalid
                        @enderror"
                            id="name" required value="{{ old('name') }}" placeholder="Full name">
                        <label for="name">Full name</label>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password"
                            class="form-control rounded-bottom @error('password')
                        is-invalid
                        @enderror"
                            id="password" required placeholder="Password">
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <select
                            class="form-select @error('store_id')
                                    is-invalid
                                @enderror"
                            id="store_id" required name="store_id">
                            <option>Select Store</option>
                            @foreach ($stores as $store)
                                @if (old('store_id') == $store->id)
                                    <option value="{{ $store->id }}" selected>{{ $store->name }}</option>
                                @else
                                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="store_id">Stores</label>
                        @error('store_id')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                        <div class="form-floating">
                            <select
                                class="form-select @error('role_id')
                                    is-invalid
                                @enderror"
                                id="role_id" required name="role_id">
                                <option>Select Role</option>
                                @foreach ($roles as $role)
                                    @if (old('role_id') == $role->id)
                                        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                    @else
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="role_id">Roles</label>
                            @error('role_id')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
                </form>
            </main>
        </div>
    </div>
@endsection
