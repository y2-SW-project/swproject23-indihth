@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($users as $user)
            <div class="col d-flex">
                    <div class="card my-3" style="width: 18rem;">
                        <div class="card-header">
                            <a href="{{ route('admin.users.show', $user->id) }}"> 
                                <h5 class="card-title">{{ $user->name }} {{ $user->id }}</h5>
                            </a>
                        </div>
                        <div class="card-body">
                            {{-- Must loop through goals as the relationship is 1:M, even though only 1 goal per user exists --}}
                            @foreach ($user->goals as $goal)
                                <p class="card-text">{{ $goal->title }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            {!! $users->links() !!}
        </div>
    </div>
@endsection
