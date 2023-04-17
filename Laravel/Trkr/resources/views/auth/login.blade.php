@extends('layouts.app')

@section('content')
    <div class="row justify-content-center vh-100">
        <div class="col-6 bg-primary">
            <h2>welcome</h2>
        </div>
        <div class="col-6 bg-white d-flex flex-column align-items-center">
            <div class="row h-100">
                <div class="col my-auto pb-5">
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{ asset('storage/images/trackerSingleLogo.png') }}" alt="Tracker logo" class="welcomeImage mb-3">
                        <h1 class="h1">Welcome Again!</h1>
                        <p class="mb-5 text-center">Login and keep track of all of your  <br> current goals and tasks</p>

                        {{-- Start of form --}}
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control  @error('email') is-invalid @enderror"
                                        id="floatingInput" placeholder="name@example.com" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <div class="form-floating">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="floatingPassword" placeholder="Password" name="password" required
                                        autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check btn ms-3">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label fs-6" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link fs-6 text-dark" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                                {{-- </div>
                                        </div> --}}
                                {{-- <div class="row mb-0">
                                            <div class="col-md-8 offset-md-4"> --}}
                                <div class="d-grid pt-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                {{-- </div>
                                        </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="d-flex">
                        <p class="me-2">Don't have an account yet?</p>
                        @if (Route::has('register'))
                            <a class="nav-link fw-bolder" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
