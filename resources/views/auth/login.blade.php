<style>
    .container {
    margin-top: 50px;
}

/* Styling voor de login-kaart */
.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

/* Card-header (Login titel) */
.card-header {
    background-color: #007bff;
    color: white;
    font-size: 1.5rem;
    font-weight: bold;
    text-align: center;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

/* Formuliervelden */
.form-control {
    border-radius: 5px;
    border: 1px solid #ced4da;
    transition: 0.3s;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
}

/* "Remember Me" checkbox styling */
.form-check-input {
    accent-color: #007bff;
}

/* Login-knop */
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    border-radius: 5px;
    transition: 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

/* Link voor wachtwoord vergeten */
.btn-link {
    color: #007bff;
    text-decoration: none;
}

.btn-link:hover {
    text-decoration: underline;
}

/* Responsiviteit */
@media (max-width: 768px) {
    .col-md-8 {
        width: 100%;
    }
}
</style>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
