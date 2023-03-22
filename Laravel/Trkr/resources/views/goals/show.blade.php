@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="d-flex">
                    {{-- Edit Goal Button --}}
                    <a href="{{ route('goals.edit', $goal) }}" class="btn btn-primary me-2">Edit Goal</a>

                    {{-- Delete Goal Button --}}
                    <x:form::form action="{{ route('goals.destroy', $goal) }}" method="delete">
                        {{-- @method() and @csrf() not needed as form::form component automatically includes these --}}

                        <x:form::button.submit class="btn-danger">Delete Goal</x:form::button.submit>
                    </x:form::form>
                </div>
                {{-- Display Goal Information --}}
                <div class="card my-3">
                    <div class="card-header">
                        {{ $goal->title }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $goal->language }}</h5>
                        <p class="card-text">{{ Str::limit($goal->description, 200) }}</p>
                        <p class="card-text">{{ $goal->user->name }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Display Tasks Information --}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="h3">Tasks:</h3>
                <div class="row ">
                    {{-- TODO: max 3 tasks per row --}}
                    @foreach ($goal->tasks as $task)
                        <div class="col-4">
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

                                    {{-- <div class="card-body">
                                    <h5 class="card-title">{{ $task->type }}</h5>
                                    <p class="card-text">{{ Str::limit($task->description, 200) }}</p>
                                </div> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection
