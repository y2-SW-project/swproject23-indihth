@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12 mb-3">


                {{-- Goal Image --}}
                <div class="card">
                    <img src="{{ asset('storage/images/goals/' . $goal->goal_image) }}" class="card-img goalImage">
                    <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                        <div class="text-white p-3">
                            <h1 class="display-4 fw-bold text-uppercase">
                                {{ $goal->title }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-8">
                <h3 class="h5 fw-bold">Goal Description:</h3>
                <div class="card card-body">
                    <p class="">{{ $goal->description }}</p>
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
                {{-- TODO: max 3 tasks per row --}}
                {{-- <div class="col"> --}}

                    <div class="row">
                        <div class="accordion accordion-flush" id="accordionFlushTask">
                            @foreach ($toDo as $task)
                                <div class="col-6">
                                    <div class="accordion-item">
                                        {{-- Header Content --}}
                                        <h2 class="accordion-header" id="heading-{{ $task->id }}">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#task-{{ $task->id }}"
                                                aria-expanded="false" aria-controls="task-{{ $task->id }}">
                                                <div class="d-flex flex-column">
                                                    <h5 class="card-title"> {{ $task->title }}</h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">{{ $task->type }}</h6>
                                                </div>
                                            </button>
                                        </h2>
                                        {{-- Dropdown content --}}
                                        <div id="task-{{ $task->id }}" class="accordion-collapse collapse"
                                            aria-labelledby="heading-{{ $task->id }}"
                                            data-bs-parent="#accordionFlushTask">
                                            <div class="accordion-body">
                                                <p>{{ Str::limit($task->description, 100) }}</p>
                                                <div class="d-flex align-items-center justify-content-end">
                                                    {{-- Task Edit Button --}}
                                                    <a href="{{ route('user.tasks.edit', $task) }}" class="fs-3 me-2"><i
                                                            class="bi bi-pencil"></i>
                                                    </a>
                                                    {{-- Task Delete Button --}}
                                                    <x:form::form action="{{ route('user.tasks.destroy', $task) }}"
                                                        method="delete">
                                                        <button type="submit" class="btn shadow-none"
                                                            onclick="deleteConfirm(event)">
                                                            <i class="fs-3 bi bi-x-circle"></i>
                                                        </button>
                                                    </x:form::form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    {{-- </div> --}}


                    <form action="post">
                        <input type="hidden" name="goal_id" value="{{ $goal->id }}" />
                    </form>
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
                    {{-- Done Tasks --}}
                    <div class="col">
                        <h3 class="h3">Done</h3>
                        <div class="accordion accordion-flush" id="accordionFlushTask">
                            @foreach ($done as $task)
                                <div class="accordion-item">
                                    {{-- Header Content --}}
                                    <h2 class="accordion-header" id="heading-{{ $task->id }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#task-{{ $task->id }}" aria-expanded="false"
                                            aria-controls="task-{{ $task->id }}">
                                            <div class="d-flex flex-column">
                                                <h5 class="card-title"> {{ $task->title }}</h5>
                                                <h6 class="card-subtitle text-muted">{{ $task->type }} |
                                                    {{ $task->updated_at->diffForHumans() }}</h6>
                                                {{-- <p class="mb-0">{{ $task->updated_at->diffForHumans() }}</p> --}}
                                            </div>
                                        </button>
                                    </h2>
                                    {{-- Dropdown content --}}
                                    <div id="task-{{ $task->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading-{{ $task->id }}" data-bs-parent="#accordionFlushTask">
                                        <div class="accordion-body">
                                            <p>{{ Str::limit($task->description, 100) }}</p>
                                            <div class="d-flex align-items-center justify-content-end">
                                                {{-- Task Edit Button --}}
                                                <a href="{{ route('user.tasks.edit', $task) }}" class="fs-3 me-2"><i
                                                        class="bi bi-pencil"></i>
                                                </a>
                                                {{-- Task Delete Button --}}
                                                <x:form::form action="{{ route('user.tasks.destroy', $task) }}"
                                                    method="delete">
                                                    <button type="submit" class="btn shadow-none"
                                                        onclick="deleteConfirm(event)">
                                                        <i class="fs-3 bi bi-x-circle"></i>
                                                    </button>
                                                </x:form::form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
