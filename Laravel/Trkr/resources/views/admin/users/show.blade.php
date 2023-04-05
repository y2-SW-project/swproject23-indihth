@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 d-flex">
                <div class="row">
                    <div class="col">

                        {{-- Display User Information --}}
                        <div class="card my-3">
                            <div class="card-header">
                                {{ $user->name }}
                            </div>
                            <div class="card-body">
                                @foreach ($user->goals as $goal)
                                    <h5 class="card-title">{{ $goal->title }}</h5>
                                    <h5 class="card-title">{{ $user->email }}</h5>
                                    <p class="card-text">{{ Str::limit($goal->description, 200) }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Display Goal Information --}}
                    <div class="col">
                        <div class="card my-3">
                            <div class="card-header">
                                {{ $user->name }}
                            </div>
                            <div class="card-body">
                                @foreach ($user->goals as $goal)
                                    <h5 class="card-title">{{ $goal->title }}</h5>
                                    <h5 class="card-title">{{ $user->email }}</h5>
                                    <p class="card-text">{{ Str::limit($goal->description, 200) }}</p>
                                @endforeach
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
@endsection
