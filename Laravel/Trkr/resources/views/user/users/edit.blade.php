@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="d-flex ms-n5">
                <a href="{{ URL::previous() }}" class="me-3 pe-n3">
                    <i class="bi bi-arrow-left text-dark fs-4"></i>
                </a>
                <div class="mb-4">
                    <h1 class="h5 mb-0 fw-bolder">Edit Profile</h1>
                    {{-- Display current date --}}
                    <p class="h7">{{ now()->toFormattedDayDateString() }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-11 card card-body">
                    <h2 class="h5">Person Info</h2>
                    <x:form::form :bind="$user" class="row" method="put" enctype="multipart/form-data"
                        :action="route('user.users.update', $user)">

                        <div class="d-flex mb-4 ">
                            <div>
                                {{-- User Image --}}
                                <img src="{{ asset('storage/images/users/' . $user->user_image) }}" width="120"
                                    alt="user profile image" class="rounded-circle shadow-4">
                            </div>
                            {{-- Profile Image Upload, how to display preview? --}}
                            <div class="my-auto ms-3">
                                {{-- Image Upload Button --}}
                                <div class="">
                                    <label for="user_image" class="btn btn-primary">Upload Image</label>
                                    <input id="user_image" type="file" class="" name="user_image"
                                        field="user_image" required hidden>
                                </div>
                                <p class="fs-6 text-muted">Image to be displayed on your profile</p>
                            </div>
                        </div>
                        <hr />
                        {{-- Personal Details --}}
                        <div class="col">
                            {{-- About Me --}}
                            <x:form::textarea name="about_me" label="About Me" :value="@old('about_me', $user->about_me)" rows="4"
                                class="mb-4" />
                            <div class="d-flex mb-4">
                                {{-- Country --}}
                                <div class="col me-3">
                                    <label for="country_id" class="form-label">Country</label>
                                    <select class="form-select" id="country_id" name="country_id" label="Select Country">
                                        @if (isset($country))
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" @selected(old('country_id', $user->country->id) == $country->id)>
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        @else
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            {{-- Interests --}}
                            <div class="row ps-3">
                                {{-- <p>{{ $user->interests }}</p> --}}
                                @foreach ($interests as $interest)
                                    <div class="col-6 form-check">
                                        <input type="checkbox" class="form-check-input" name="interest_id[]"
                                            id="exampleCheck1" value="{{ $interest->id }}"
                                            {{ $user->interests->where('id', $interest->id)->isNotEmpty() ? 'checked' : '' }}>
                                        <span>{{ $interest->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                            {{-- Buttons --}}
                            <div class="col-12 mt-2 d-grid">
                                <x:form::button.submit>Save </x:form::button.submit>
                            </div>
                        </div>
                        </x:form:form>
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="col-11 card card-body">
                    <h2 class="h5">Goal Info</h2>
                   <x:form::form :bind="$goal" class="row" method="put"
                        :action="route('user.goals.update', $goal)">
                        <div class="col mt-3">
                            <x:form::input name="title" label="Title" :value="@old('title', $goal->title)" class="" />
                            <x:form::textarea name="description" label="Description" rows=5 :value="@old('description', $goal->description)" />
                        </div>
                        <div class="col-md-10">
                            <label for="languages" class="form-label">Language</label>
                            <select class="form-select" id="languages" name="language" label="Select Language">
                                @foreach ($languages as $language)
                                    <option value="{{ $language }}" @selected(old('language', $goal->language) == $language)>
                                        {{ $language }}
                                    </option>
                                @endforeach
                            </select>
                            <br />
                        </div>
                        
                        <div class="col-12 mt-2 d-grid">
                            <x:form::button.submit>Save </x:form::button.submit>
                        </div>
                    </x:form:form>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
