@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($users as $user)
                <div class="col-4">
                    <div class="card my-3 mx-3 pb-3 ">
                    {{-- <div class="card my-3 mx-auto pb-3" style="width: 18rem;"> --}}
                        <div class="card-body">
                            <a href="{{ route('user.users.show', $user->id) }}" class="link-dark">
                                <div class="d-flex justify-content-between">

                                    <div>
                                        <img src="{{ asset('storage/images/' . $user->user_image) }}" width="80"
                                            class="rounded-circle mb-3" alt="user profile image">
                                        <h3 class="h1 mb-0">
                                            {{ $user->name }}
                                        </h3>
                                        {{-- Must loop through goals as the relationship is 1:M, even though only 1 goal per user exists --}}
                                        @foreach ($user->goals as $goal)
                                            <p class="">{{ $goal->language }} | {{ $user->level }}</p>
                                        @endforeach
                                    </div>

                                    <div>
                                        <img class="rounded rounded-4" width="50"
                                            src="{{ asset('storage/images/flags/' . $user->country->image) }}"
                                            alt="user profile image">

                                        <div>

                                        </div>
                                    </div>
                                </div>

                                @foreach ($user->goals as $goal)
                                    <p class="card-text">{{ Str::limit($goal->description, 100) }}</p>
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
