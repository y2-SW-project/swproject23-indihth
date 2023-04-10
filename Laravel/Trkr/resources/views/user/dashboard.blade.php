@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <main class="col-md-10 d-flex">
                <div class="row">
                    {{-- Left Column --}}
                    <aside class="col-md-8">
                        {{-- User Greeting --}}
                        <div class="row">
                            <div class="col">
                                <h2 class="display-3 my-3">
                                    Hello {{ $user->name }}
                                </h2>
                                <h6 class="h6">Welcome and get learning</h6>
                            </div>
                        </div>

                        {{-- Placeholder Chart Image --}}
                        <div class="row card">
                            <div class="card-body">
                                <h5 class="card-title">Tracking History</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Hours for past 3 months</h6>
                                <div class="col">
                                    <img src="{{ asset('storage/images/chart.png') }}" alt="user profile image"
                                        class="img-fluid border border-4 border-white rounded rounded-5">
                                </div>
                            </div>
                        </div>

                        {{-- Compelted Task Feed --}}
                        <div class="row">
                            <div class="col">
                                <div class="my-3">
                                    <h3 class="h3">Activity Feed</h3>
                                    @foreach ($done as $task)
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title"> {{ $task->title }}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">
                                                    {{ $task->type }}
                                                </h6>
                                                <p>{{ $task->updated_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- END Task Feed --}}
                    </aside>


                    {{-- Right Column --}}
                    <section class="col-md-4">
                        {{-- Display User Information --}}
                        <article class="row">
                            <div class="col d-flex align-items-center flex-column">
                                <h2 class="h2">My Profile</h2>
                                <div class="my-2">
                                    <img src="{{ asset('storage/images/' . $user->user_image) }}" width="150"
                                        alt="user profile image">
                                </div>
                                <p class="h5"> {{ $user->name }} </p>
                            </div>
                        </article>

                        {{-- Display Tasks Information --}}
                        <article class="row">
                            <div class="col">
                                <h3 class="h3">Tasks:</h3>
                                @foreach ($user->goals as $goal)
                                    <a href="{{ route('user.tasks.create', ['id' => $goal->id]) }}"
                                        class="btn btn-primary">+ Add
                                        New Task</a>
                                @endforeach
                                <h3 class="h3">To-do</h3>
                                @foreach ($toDo as $task)
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title"> {{ $task->title }}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">{{ $task->type }}
                                            </h6>
                                            <div class="d-flex">
                                                {{-- Task Edit Button --}}
                                                <a href="{{ route('user.tasks.edit', $task) }}"
                                                    class="btn btn-primary me-2">Edit Task</a>

                                                {{-- Task Delete Button --}}
                                                <x:form::form action="{{ route('user.tasks.destroy', $task) }}"
                                                    method="delete">
                                                    <x:form::button.submit class="btn-danger"
                                                        onclick="deleteConfirm(event)">Delete Task
                                                    </x:form::button.submit>
                                                </x:form::form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <form action="post">
                                    <input type="hidden" name="goal_id" value="{{ $goal->id }}" />
                                </form>
                            </div>
                            {{-- END Display Tasks Information --}}
                        </article>
                    </section>
                    {{-- END Display User Information --}}
                </div>
            </main>
        </div>
    </div>
    {{-- Include for SweetAlert js package --}}
    @include('sweetalert::alert')
@endsection
