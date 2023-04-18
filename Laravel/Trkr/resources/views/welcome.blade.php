@extends('layouts.app')
{{-- @include('layouts.nav-items') --}}
@section('content')
    <img src="{{ asset('storage/images/trackerHeaderLogo.png') }}" class="img-fluid" 
        alt="Tracker logo">
    <div class="d-flex">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-dark">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-dark">Register</a>
                    @endif
                @endauth
            </div>
        @endif

    @endsection
