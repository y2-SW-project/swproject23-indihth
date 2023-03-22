@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('goals.create') }}" class="btn btn-primary">+ Add New Goal</a>
            @foreach ($goals as $goal)
            <div class="card m-3">
                <div class="card-header">
                       <a href="{{ route('goals.show', $goal->id) }}"> {{ $goal->title }} </a>
                </div>
                <div class="card-body">
                  <h5 class="card-title">{{ $goal->language }}</h5>
                  <p class="card-text">{{ Str::limit($goal->description, 200) }}</p>
                  <p class="card-text">{{ $goal->user->name }}</p>
                  {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                </div>
              </div>
{{-- 
            <div class="card">
                <div class="card-header">{{ $goal->title }}</div>
                <div class="card-body">
                   {{ $goal->title }}
                   test
                </div>
            </div> --}}
            @endforeach
            {!! $goals->links() !!}
        </div>
    </div>
</div>
@endsection
