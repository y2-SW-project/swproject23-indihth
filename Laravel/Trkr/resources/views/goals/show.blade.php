@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card m-3">
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
</div>
@endsection
