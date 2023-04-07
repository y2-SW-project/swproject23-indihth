@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($users as $user)
                <div class="col d-flex">
                    <div class="card my-3" style="width: 18rem;">
                        <div class="card-body">
                            <a href="{{ route('admin.users.show', $user->id) }}">
                                <h5 class="card-title d-flex justify-content-between">
                                    <div>{{ $user->name }}</div>
                                    <p class="card-text">{{ $user->country }}</p>
                                </h5>
                            </a>
                            <img src="{{ asset('storage/images/' . $user->user_image) }}" width="150" alt="user profile image">
                            {{-- Must loop through goals as the relationship is 1:M, even though only 1 goal per user exists --}}
                            @foreach ($user->goals as $goal)
                                <p class="card-text">{{ $goal->language }} | {{ $user->level }}</p>
                                <h5 class="card-title">Goal Description:</h5>
                                <p class="card-text">{{ Str::limit($goal->description, 80) }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
            {!! $users->links() !!}
        </div>
    </div>
@endsection
