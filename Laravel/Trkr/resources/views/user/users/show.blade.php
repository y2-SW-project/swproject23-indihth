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
                                    <img src="{{ asset('storage/images/users/' . $user->user_image) }}" width="150"
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

                                {{-- Remove Partner --}}
                                {{-- <x:form::form action="{{ route('user.users.removePartner', $user) }}" method="post">
                                <input type="hidden" name="profile_id" value="{{  $user }}">
                                <x:form::button.submit>Removed Partner </x:form::button.submit>
                                </x:form::form> --}}

                                {{-- Add Partner --}}
                                {{-- <x:form::form action="{{ route('user.users.addPartner', $user) }}" method="post">
                                <input type="hidden" name="profile_id" value="{{  $user }}">
                                <x:form::button.submit>Add Partner </x:form::button.submit>
                                </x:form::form> --}}

                                {{-- <a href="{{ route('user.users.replacePartner', $user) }}" class="btn btn-primary me-2">
                                    Request as Partner</a> --}}
                   

                                <h5 class="card-title">Interests</h5>
                                @foreach ($user->interests as $interest)
                                    <p class="card-text">{{ $interest->name }}</p>
                                @endforeach
                                <h5 class="card-title">About Me</h5>
                                <p class="card-text">{{ Str::limit($user->about_me, 200) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        {{-- Goals - no access to full goal view with tasks --}}
                        <div class="col">
                            @foreach ($user->goals as $goal)
                                <div class="card my-3">
                                    <div class="card-header">
                                      {{ $goal->title }}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $goal->language }}</h5>
                                        <p class="card-text">{{ Str::limit($goal->description, 200) }}</p>
                                    </div>
                                </div>
                            @endforeach
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
