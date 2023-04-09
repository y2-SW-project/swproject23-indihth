@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 d-flex">
                <div class="row">
                    <div class="col">

                        {{-- Display User Information --}}
                        <div class="card my-3">
                            <div class="card-header">
                                {{ $user->name }}
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <img src="{{ asset('storage/images/' . $user->user_image) }}" width="150"
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

                    {{-- Goal Information --}}
                    <div class="col-md-8">
                        <div class="d-flex">
                            {{-- Edit Goal Button --}}
                            <a href="{{ route('user.goals.edit', $goal) }}" class="btn btn-primary me-2">Edit Goal</a>

                            {{-- Delete Goal Button --}}
                            <x:form::form action="{{ route('user.goals.destroy', $goal) }}" method="delete">
                                {{-- @method() and @csrf() not needed as form::form component automatically includes these --}}

                                <x:form::button.submit class="btn-danger" onclick="deleteConfirm(event)">Delete Goal
                                </x:form::button.submit>
                            </x:form::form>
                        </div>
                        {{-- Display Goal Information --}}
                        <div class="card my-3">
                            <div class="card-header">
                                {{ $goal->title }} Id:{{ $goal->id }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $goal->language }}</h5>
                                <p class="card-text">{{ Str::limit($goal->description, 200) }}</p>
                                <p class="card-text">{{ $goal->user->name }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Display Tasks Information --}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="h3">Tasks:</h3>
                {{-- {{ route('name.route', ['id' => $val->id]) }} --}}
                <a href="{{ route('user.tasks.create',  ['id' => $goal->id]) }}" class="btn btn-primary">+ Add New Task</a>
                <div class="row ">
                    {{-- TODO: max 3 tasks per row --}}
                    <div class="col">
                        <h3 class="h3">To-do</h3>
                    @foreach ($toDo as $task)
                    {{-- @foreach ($goal->tasks as $task) --}}
                        <div class="col">
                            <div class="card mb-3">
                                <div class="card-body">
                                    {{-- <div class="card-header">
                                    {{ $task->title }}
                                </div> --}}
                                    <h5 class="card-title"> {{ $task->title }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $task->type }}</h6>
                                    <p class="card-text">
                                        {{ Str::limit($task->description, 100) }}
                                    </p>

                                    <div class="d-flex">
                                    {{-- Task Edit Button --}}
                                    <a href="{{ route('user.tasks.edit', $task) }}" class="btn btn-primary me-2">Edit Task</a>

                                    {{-- Task Delete Button --}}
                                    <x:form::form action="{{ route('user.tasks.destroy', $task) }}" method="delete">
                                        <x:form::button.submit class="btn-danger" onclick="deleteConfirm(event)">Delete Task</x:form::button.submit>
                                    </x:form::form>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                    <div class="col">
                        <h3 class="h3">Done</h3>
                    @foreach ($done as $task)
                    {{-- @foreach ($goal->tasks as $task) --}}
                        <div class="col">
                            <div class="card mb-3">
                                <div class="card-body">
                                    {{-- <div class="card-header">
                                    {{ $task->title }}
                                </div> --}}
                                    <h5 class="card-title"> {{ $task->title }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $task->type }} {{ $task->status }}</h6>
                                    <p class="card-text">
                                        {{ Str::limit($task->description, 100) }}
                                    </p>

                                    <div class="d-flex">
                                    {{-- Task Edit Button --}}
                                    <a href="{{ route('user.tasks.edit', $task) }}" class="btn btn-primary me-2">Edit Task</a>

                                    {{-- Task Delete Button --}}
                                    <x:form::form action="{{ route('user.tasks.destroy', $task) }}" method="delete">
                                        <x:form::button.submit class="btn-danger" onclick="deleteConfirm(event)">Delete Task</x:form::button.submit>
                                    </x:form::form>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                    <form action="post">
                        <input type="hidden" name="goal_id" value="{{ $goal->id }}" />
                    </form>
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
