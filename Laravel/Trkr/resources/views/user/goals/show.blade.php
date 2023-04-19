@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8">

                {{-- Goal Title --}}
                <h1 class="h1 fw-bold">
                    {{ $goal->title }}
                </h1>
                <p class="mt-0 fst-italic"><span class="card-subtitle">Created on:</span>
                    {{ $goal->created_at->toFormattedDayDateString() }}</p>

                {{-- Goal Image --}}
                <div class="" height="150">
                    <img src="{{ asset('storage/images/' . $goal->goal_image) }}" class="img-fluid rounded rounded-1"
                        alt="user profile image">
                </div>

                {{-- Goal Information --}}
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
            </div>

            {{-- Tasks --}}
            <div class="col-md-4">
                {{-- <h3 class="h3">Tasks:</h3> --}}
                {{-- <a href="{{ route('user.tasks.create', ['id' => $goal->id]) }}" class="btn btn-primary">+ Add New Task</a> --}}
                <div class="d-flex mb-3 align-items-center">
                    <h3 class="h3 mb-0 pe-2">Tasks</h3>
                    <a href="{{ route('user.tasks.create', ['id' => $goal->id]) }}"
                        class="mt-1 me-3 d-flex align-items-center">
                        <i class="fs-4 text-dark bi bi-plus-circle"></i>
                    </a>
                </div>
                <div class="row ">
                    {{-- TODO: max 3 tasks per row --}}
                    <div class="col">
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
                                            <a href="{{ route('user.tasks.edit', $task) }}"
                                                class="btn btn-primary me-2">Edit Task</a>

                                            {{-- Mark as completed --}}
                                            {{-- <x:form::form :action="route('user.tasks.update', $task)" method="put">
                                                    <input name="status" class="form-check-input" type="hidden" value="1">
                                                <x:form::button.submit><i class="bi bi-check-circle"></i></x:form::button.submit>
                                            </x:form::form> --}}

                                            {{-- <x:form::form class="row" method="put"
                                                :action="route('user.tasks.updateStatus', $task)">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input name="status" type="hidden" value="1">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Task Done
                                                        </label>
                                                    </div>
                                                </div>
                                                <div>
                                                    <x:form::button.submit>Save </x:form::button.submit>
                                                </div>
                                                </x:form:form> --}}

                                                <div class="col-12 mt-2 d-flex justify-content-between">
                                                    {{-- Task Delete Button --}}
                                                    <x:form::form action="{{ route('user.tasks.destroy', $task) }}"
                                                        method="delete">
                                                        <x:form::button.submit class="btn-danger"
                                                            onclick="deleteConfirm(event)">
                                                            Delete Task</x:form::button.submit>
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
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $task->type }} {{ $task->status }}
                                        </h6>
                                        <p class="card-text">
                                            {{ Str::limit($task->description, 100) }}
                                        </p>

                                        <div class="d-flex">
                                            {{-- Task Edit Button --}}
                                            <a href="{{ route('user.tasks.edit', $task) }}"
                                                class="btn btn-primary me-2">Edit Task</a>

                                            {{-- Task Delete Button --}}
                                            <x:form::form action="{{ route('user.tasks.destroy', $task) }}"
                                                method="delete">
                                                <x:form::button.submit class="btn-danger" onclick="deleteConfirm(event)">
                                                    Delete Task</x:form::button.submit>
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

        {{-- Display Tasks Information --}}
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h3 class="h3">Tasks:</h3>
                <a href="{{ route('user.tasks.create', ['id' => $goal->id]) }}" class="btn btn-primary">+ Add New Task</a>
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
                                            <a href="{{ route('user.tasks.edit', $task) }}"
                                                class="btn btn-primary me-2">Edit Task</a>

                                            {{-- Task Delete Button --}}
                                            <x:form::form action="{{ route('user.tasks.destroy', $task) }}"
                                                method="delete">
                                                <x:form::button.submit class="btn-danger" onclick="deleteConfirm(event)">
                                                    Delete Task</x:form::button.submit>
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
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $task->type }} {{ $task->status }}
                                        </h6>
                                        <p class="card-text">
                                            {{ Str::limit($task->description, 100) }}
                                        </p>

                                        <div class="d-flex">
                                            {{-- Task Edit Button --}}
                                            <a href="{{ route('user.tasks.edit', $task) }}"
                                                class="btn btn-primary me-2">Edit Task</a>

                                            {{-- Task Delete Button --}}
                                            <x:form::form action="{{ route('user.tasks.destroy', $task) }}"
                                                method="delete">
                                                <x:form::button.submit class="btn-danger" onclick="deleteConfirm(event)">
                                                    Delete Task</x:form::button.submit>
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
@endsection
