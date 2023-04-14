@extends('layouts.app')
@section('content')
    <main class="d-flex">
        <div class="row">
            {{-- Left Column --}}
            <aside class="col-md-8">
                {{-- User Greeting --}}
                <div class="row">
                    <div class="col">
                        <div class="ps-3 mb-4">
                            <h1 class="h5 mb-0"><strong>Dashboard</strong></h1>
                            {{-- Display current date --}}
                            <p class="h7">{{ now()->toFormattedDayDateString() }}</p>
                        </div>
                        <div class="bg-primary welcomeCard px-5 py-3 rounded-4 mb-5">
                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <div>
                                    <h2 class="fs-3 mt-3">
                                        Hi, <span class="fw-bold">{{ $user->name }}</span>
                                    </h2>
                                    <p class="w-75">Plan your days to be more productive, you have 3 daily tasks to
                                        complete today</p>
                                </div>
                                <img src="{{ asset('storage/images/bubbles.png') }}" alt="User tracking chart"
                                    class="img welcomeImage pe-4">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Placeholder Chart Image --}}
                <article class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Tracking History</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Hours for past 3 months</h6>
                                <div class="col">
                                    <img src="{{ asset('storage/images/chart.png') }}" alt="User tracking chart"
                                        class="img-fluid border border-4 border-white rounded rounded-5">
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                {{-- Compelted Task Feed --}}
                <article class="row">
                    <div class="col">
                        <div class="my-3">
                            <h3 class="h3">Partner Activity Feed</h3>
                            @foreach ($partnerDone as $task)
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
                </article>
                {{-- END Task Feed --}}
            </aside>

            {{-- Right Column --}}
            <section class="col-md-4">
                {{-- Display User Information --}}
                <article class="row">
                    <div class="col d-flex align-items-center flex-column">
                        <h1 class="h5 mb-0"><strong>Profile</strong></h1>
                        <div class="my-2">
                            <img src="{{ asset('storage/images/' . $user->user_image) }}" class="userImage rounded-circle"
                                alt="user profile image">
                        </div>
                        <p class="h4 mb-0"> {{ Str::upper($user->name) }} </p>
                        @foreach ($user->goals as $goal)
                            <p class="">{{ $goal->language }} | {{ $user->level }}</p>
                        @endforeach
                    </div>
                </article>

                {{-- Display Tasks Information --}}
                <article class="row">
                    <div class="col mx-3">
                        {{-- @foreach ($user->goals as $goal)
                            <a href="{{ route('user.tasks.create', ['id' => $goal->id]) }}" class="btn btn-primary">+ Add
                                New Task</a>
                            <form action="post">
                                <input type="hidden" name="goal_id" value="{{ $goal->id }}" />
                            </form>
                        @endforeach --}}
                        <h3 class="h3">Tasks:</h3>
                        @foreach ($toDo as $task)
                            <div class="card mb-3">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title"> {{ $task->title }}</h5>
                                        <h6 class="card-subtitle text-muted">{{ $task->type }}
                                        </h6>
                                    </div>
                                    <div class="d-flex">
                                        {{-- Task Edit Button --}}
                                        <a href="{{ route('user.tasks.edit', $task) }}" class="me-2"><i
                                                class="fs-4 text-muted bi bi-pencil-fill"></i></a>

                                        {{-- Task Delete Button --}}
                                        {{-- <x:form::form action="{{ route('user.tasks.destroy', $task) }}" method="delete">
                                            <x:form::button.submit class="btn-danger" onclick="deleteConfirm(event)">Delete
                                                Task
                                            </x:form::button.submit>
                                        </x:form::form> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    {{-- END Display Tasks Information --}}
                </article>
            </section>
            {{-- END Display User Information --}}
        </div>
    </main>
    {{-- Include for SweetAlert js package --}}
    @include('sweetalert::alert')
@endsection
