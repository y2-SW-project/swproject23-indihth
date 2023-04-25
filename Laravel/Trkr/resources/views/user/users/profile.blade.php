@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 d-flex">
                <div class="row">
                    <div class="d-flex">
                        {{-- Edit Goal Button --}}
                        <a href="{{ route('user.users.edit', $user) }}" class="btn btn-primary me-2">Edit User</a>
                    </div>
                    <div class="col">

                        {{-- Display User Information --}}
                        <div class="card my-3">
                            <div class="card-header">
                                {{ $user->name }}
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <img src="{{ asset('storage/images/users/' . $user->user_image) }}" width="150"
                                        alt="user profile image">

                                    <div>
                                        <p class="card-text mb-1">
                                            {{ $user->country->name }}
                                        </p>
                                        <img class="" width="50"
                                            src="{{ asset('storage/images/flags/' . $user->country->image) }}"
                                            width="150" alt="user profile image">
                                    </div>
                                </div>
                                {{-- Must loop through goals as the relationship is 1:M, even though only 1 goal per user exists --}}
                                @foreach ($user->goals as $goal)
                                    <p class="card-text">{{ $goal->language }} | {{ $user->level }}</p>
                                @endforeach

                                <h5 class="card-title">Interests</h5>
                                @foreach ($user->interests as $interest)
                                    <p class="card-text">{{ $interest->name }}</p>
                                @endforeach
                                <h5 class="card-title">About Me</h5>
                                <p class="card-text">{{ Str::limit($user->about_me, 200) }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Display Goal Information --}}
                    <div class="col">
                        <div class="card my-3">
                            <div class="card-header">
                                {{ $user->name }}
                            </div>
                            <div class="card-body">
                                @foreach ($user->goals as $goal)
                                    <h5 class="card-title">{{ $goal->title }}</h5>
                                    <h5 class="card-title">{{ $user->email }}</h5>
                                    <p class="card-text">{{ Str::limit($goal->description, 200) }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Display Tasks Information --}}
        <div class="row justify-content-center">

        </div>
    </div>
    {{-- Include for SweetAlert js package --}}
    @include('sweetalert::alert')
@endsection
