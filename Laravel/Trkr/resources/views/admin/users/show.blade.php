@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col justify-content-center">
                {{-- Display User Information --}}
                <div class="col">
                    <div class="card my-3 px-3">
                        <div class="card-body">
                            <div class="position-relative mb-3">
                                <div class="position-absolute top-0 start-0">
                                    {{-- Edit Goal Button --}}
                                    <a href="{{ route('admin.users.edit', $user) }}" class="fs-3 me-2">
                                        <i class="bi bi-pencil text-dark"></i>
                                    </a>
                                </div>
                                <div class="d-flex flex-column align-items-center">
                                    {{-- User Image --}}
                                    <img src="{{ asset('storage/images/users/' . $user->user_image) }}" width="130"
                                        class="rounded-circle shadow-4 mb-3" alt="user profile image">
                                    <h3 class="h2">
                                        {{ $user->name }}
                                    </h3>
                                    {{-- Must loop through goals as the relationship is 1:M, even though only 1 goal per user exists --}}
                                    @foreach ($user->goals as $goal)
                                        <p class="fs-6">{{ $goal->language }} | {{ $user->level }}</p>
                                    @endforeach
                                    {{-- User interests --}}
                                    <div class="d-flex interests">
                                        @foreach ($user->interests as $interest)
                                            <p class="fs-6 bg-light rounded-pill px-3 py-1">
                                                {{ $interest->name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- Flag --}}
                                <div class="position-absolute top-0 end-0">
                                    <img class="rounded rounded-4" width="40"
                                        src="{{ asset('storage/images/flags/' . $user->country->image) }}"
                                        alt="user profile image">
                                </div>
                            </div>
                            <div class="mt-3">
                                <h3 class="h4">About Me</h3>
                                <p>{{ $user->about_me }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Partner Information --}}
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            @if (isset($partner))
                            <h3 class="h4">Partner</h3>
                            <div class="d-flex">
                                {{-- Image, language, interests --}}
                                <div class="col-6">
                                    <div class="d-flex flex-column align-items-center mt-3">
                                        {{-- User Image --}}
                                        <img src="{{ asset('storage/images/users/' . $partner->user_image) }}"
                                            width="100" class="rounded-circle shadow-4 mb-3" alt="user profile image">
                                        <h3 class="h4">
                                            {{ $partner->name }}
                                        </h3>
                                        {{-- Must loop through goals as the relationship is 1:M, even though only 1 goal per user exists --}}
                                        @foreach ($partner->goals as $goal)
                                            <p class="fs-6">{{ $goal->language }} | {{ $partner->level }}</p>
                                        @endforeach
                                        {{-- partner interests --}}
                                        <div class="d-flex interests">
                                            {{-- Only display 2 interest, avoid css needed to display all in cols --}}
                                            @foreach ($partner->interests->take(2) as $interest)
                                                <p class="fs-6 bg-light rounded-pill px-3 py-1 mb-0">
                                                    {{ $interest->name }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                {{-- Partner About Me --}}
                                <div class="col-6 d-flex flex-column justify-content-between">
                                    <div>
                                        <h3 class="h5">About Me</h3>
                                        <p>{{ $partner->about_me }}</p>
                                    </div>

                                    {{-- View Profile Button --}}
                                    <a href="{{ route('user.users.show', $partner->id) }}"  class="btn btn-primary">
                                        View Profile
                                    </a>
                                </div>
                            </div>
                            @else
                            <h3 class="h4">No Partner</h3>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            {{-- Display Goal Information - RIGHT COL --}}
            <div class="col">
                <div class="col">
                    @if ($user->goals->first())
                    @foreach ($user->goals as $goal)
                    <div class="card my-3">
                            {{-- Goal Image --}}
                            <div class="card-img">
                                <img src="{{ asset('storage/images/goals/' . $goal->goal_image) }}"
                                    class="card-img-top welcomeCard goalImage">
                            </div>
                            <div class="card-body">
                                <div class="position-relative mb-3">
                                    <div class="position-absolute top-0 start-0">
                                        {{-- Edit Goal Button --}}
                                        <a href="{{ route('admin.goals.edit', $goal) }}" class="fs-3 me-2">
                                            <i class="bi bi-pencil text-dark"></i>
                                        </a>
                                    </div>
                                    <h5 class="h3 text-center">{{ $goal->title }}</h5>
                                    <p class="h5 text-center mb-3">{{ $goal->language }}</p>
                                </div>
                                <div class="mb-3">
                                    <h3 class="h5">Goal Description</h3>
                                    <p class="">{{ $goal->description }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="card my-3 d-flex mb-3 align-items-center">
                        <h3 class="h3 mb-0 pe-2">No Goal</h3>
                    </div>
                    @endif
                </div>

                {{-- Tasks DONE --}}
                <div class="col">
                    @if (isset($done))
                        <div class="d-flex mb-3 align-items-center">
                            <h3 class="h3 mb-0 pe-2">Completed Tasks</h3>
                        </div>
                        @foreach ($done as $task)
                            <div class="col">
                                <div class="card mb-3">
                                    {{-- Header Content --}}
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="card-title"> {{ $task->title }}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">{{ $task->type }}</h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-end mt-n3">
                                                {{-- Task Edit Button --}}
                                                <a href="{{ route('admin.tasks.edit', $task) }}" class="fs-4 me-2"><i
                                                        class="bi bi-pencil text-dark"></i>
                                                </a>
                                                {{-- Task Delete Button --}}
                                                {{-- <x:form::form action="{{ route('user.tasks.destroy', $task) }}" method="delete">
                                    <button type="submit" class="btn shadow-none" onclick="deleteConfirm(event)">
                                        <i class="fs-3 bi bi-x-circle"></i>
                                    </button>
                                </x:form::form> --}}
                                            </div>
                                        </div>
                                        <p>{{ Str::limit($task->description, 100) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="card my-3 d-flex mb-3 align-items-center">
                            <h3 class="h3 mb-0 pe-2">No Tasks</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- Include for SweetAlert js package --}}
    @include('sweetalert::alert')
@endsection
