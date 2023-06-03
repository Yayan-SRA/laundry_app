@extends('layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4 mt-5">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <main class="form-signin w-100 m-auto mt-5">
                {{-- <h1 class="mb-5 fw-normal text-center">Welcome To <br> {{ $title }}</h1> --}}
                <h3 class="h3 mb-3 fw-normal text-center">Please login</h3>
                <form method="post" action="/login">
                    @csrf
                    <div class="form-floating">
                        <input type="text" name="name"
                            class="form-control 
                            @error('name')
                                is-invalid
                            @enderror"
                            value="{{ old('name') }}" id="name" required placeholder="name@example.com" autofocus>
                        <label for="name">Name</label>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password"
                            class="form-control @error('password')
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
                    <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Login</button>
                </form>
                {{-- <small class="d-block text-center mt-3">Not registered? <a href="/register">Register Now!</a></small> --}}
            </main>
        </div>
    </div>
@endsection
