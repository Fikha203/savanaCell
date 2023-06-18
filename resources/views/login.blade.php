@extends('layouts.main')
@section('container')
    <div class="row justify-content-center">
        <div class="col-md-3">

            <main class="form-signin w-100 m-auto">
                <form action="/login" method="post">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal text-center">Login</h1>

                    <div class="form-floating">
                        <input type="email" name="email"
                            class="form-control rounded-top @error('email') is-invalid
                        @enderror"
                            id="email" placeholder="name@example.com" required autofocus value="{{ old('email') }}">
                        <label for="email">Email address</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password"
                            class="form-control rounded-bottom @error('password') is-invalid
                        @enderror"
                            id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-primary w-100 py-2 mt-4" type="submit">Sign in</button>
                    {{-- <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p> --}}
                </form>
                <small class="d-block text-center mt-2">Don't have an account? <a href="/register">Register Now</a></small>
            </main>
        </div>
    </div>
@endsection
