@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 d-flex">
                <div class="row">
                    <div class="col">

                        {{-- Display User Information --}}
                        <div class="card my-3">
                            <div class="card-header">
                                {{ $user->name }}
                            </div>
                            <div class="card-body">
                                <img src="{{ asset('storage/images/' . $user->user_image) }}" width="150" alt="user profile image">
                                <p class="card-text">{{ $user->level }}</p>
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
@endsection
