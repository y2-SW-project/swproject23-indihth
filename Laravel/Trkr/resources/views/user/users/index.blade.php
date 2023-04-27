@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="ps-3 mb-4">
                <h1 class="h5 mb-0 fw-bolder">Users</h1>
                {{-- Display current date --}}
                <p class="h7">{{ now()->toFormattedDayDateString() }}</p>
            </div>
            @foreach ($users as $user)
                <div class="col-4">
                    <div class="card shadow-sm my-3 me-3 pb-3">
                        {{-- <div class="card my-3 mx-auto pb-3" style="width: 18rem;"> --}}
                        <div class="card-body">
                            <a href="{{ route('user.users.show', $user->id) }}" class="link-dark">
                                <div class="position-relative mb-3">
                                    {{-- <div class="d-flex justify-content-between"> --}}

                                    <div class="d-flex flex-column align-items-center">
                                        {{-- User Image --}}
                                        <img src="{{ asset('storage/images/users/' . $user->user_image) }}" width="80"
                                            class="rounded-circle shadow-4 mb-3" alt="user profile image">
                                        <h3 class="h2 mb-0">
                                            {{ $user->name }}
                                        </h3>
                                        {{-- Must loop through goals as the relationship is 1:M, even though only 1 goal per user exists --}}
                                        @foreach ($user->goals as $goal)
                                            <p class="fs-6 mb-0">{{ $goal->language }} | {{ $user->level }}</p>
                                        @endforeach

                                        {{-- User interests --}}
                                        <div class="d-flex interests">
                                            @foreach ($user->interests as $interest)
                                                <p class="fs-6 bg-light rounded-pill px-3 py-1 mb-0">
                                                    {{ $interest->name }}</p>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="position-absolute top-0 end-0">
                                        {{-- Flag --}}
                                        <img class="rounded rounded-4" width="40"
                                            src="{{ asset('storage/images/flags/' . $user->country->image) }}"
                                            alt="user profile image">

                                        <div>

                                        </div>
                                    </div>
                                </div>

                                @foreach ($user->goals as $goal)
                                    <p class="card-text  text-center">{{ Str::limit($goal->description, 100) }}</p>
                                @endforeach
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach
            {!! $users->links() !!}
        </div>
    </div>
@endsection
