@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 d-flex">
                <div class="row">
                    <div class="d-flex">
                        {{-- Edit Goal Button --}}
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary me-2">Edit User</a>

                        {{-- Delete Goal Button --}}
                        <x:form::form action="{{ route('admin.users.destroy', $user) }}" method="delete">
                            {{-- @method() and @csrf() not needed as form::form component automatically includes these --}}

                            <x:form::button.submit class="btn-danger" onclick="deleteConfirm(event)">Delete Goal
                            </x:form::button.submit>
                        </x:form::form>
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

                    <div class="col">
                        {{-- Admin can view all Goals and Tasks--}}
                        <div class="col">
                            @foreach ($user->goals as $goal)
                                <div class="card my-3">
                                    <div class="card-header">
                                        <a href="{{ route('admin.goals.show', $goal->id) }}"> {{ $goal->title }} </a>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $goal->language }}</h5>
                                        <p class="card-text">{{ Str::limit($goal->description, 200) }}</p>
                                        @foreach ($goal->tasks as $task)
                                            <p class="card-text">{{ $task->title }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
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
