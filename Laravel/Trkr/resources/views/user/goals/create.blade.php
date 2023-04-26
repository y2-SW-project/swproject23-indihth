@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="col-11 card card-body">
                    <h2 class="h5">Person Info</h2>
                    <x:form::form class="row" method="post" enctype="multipart/form-data"
                        :action="route('user.goals.store')">

                        <hr />
                        {{-- Personal Details --}}
                        <div class="col">
                            {{-- About Me --}}
                            <x:form::textarea name="about_me" label="About Me" :value="@old('about_me')" rows="4"
                                class="mb-4" />
                            <div class="d-flex mb-4">
                                {{-- Country --}}
                                <div class="col me-3">
                                    <label for="country_id" class="form-label">Country</label>
                                    <select class="form-select" id="country_id" name="country_id" label="Select Country">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" @selected(old('country_id'))>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- Interests --}}
                            <div class="row ps-3">
                                {{-- <p>{{ $user->interests }}</p> --}}
                                @foreach ($interests as $interest)
                                    <div class="col-6 form-check">
                                        <input type="checkbox" class="form-check-input" name="interest_id[]"
                                            id="exampleCheck1" value="{{ $interest->id }}">
                                        <span>{{ $interest->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                            {{-- Buttons --}}
                            {{-- <div class="col-12 mt-2 d-grid">
                                <x:form::button.submit>Save </x:form::button.submit>
                            </div> --}}
                        </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-11 card card-body">
                    <h2 class="h5">Goal Info</h2>
                    <hr />
                    <div class="col">
                        <x:form::input name="title" label="Title" :value="@old('title')" class="" />
                        <x:form::textarea name="description" label="Description" rows=5 :value="@old('description')" />
                    </div>
                    <div class="col-md-10">
                        {{-- 'multiple' displays options as non-dropdown list --}}
                        <label for="languages" class="form-label">Language</label>
                        <select class="form-select" id="languages" name="language" label="Select Language">
                            @foreach ($languages as $language)
                                <option value="{{ $language }}" @selected(old('language'))>
                                    {{ $language }}
                                </option>
                            @endforeach
                        </select>
                        <br />
                    </div>
                </div>
            </div>
        </div>

        {{-- Partners --}}
        <div class="row form-check form-check-inline">
            <h2 class="h5">Choose a Partner</h2>
            @foreach ($partners as $user)
            <input class="btn-check" type="radio" name="partner" id="radio-{{ $user->id }}" value="{{ $user->id }}">
            <label class="btn btn-primary" for="radio-{{ $user->id }}">
                <div class="col-md-3">
                    <div class="card shadow-sm my-3 me-3">
                        <div class="card-body">
                            {{-- <a href="{{ route('user.users.show', $user->id) }}" class="link-dark"> --}}
                                <div class="position-relative">
                                    <div class="d-flex flex-column align-items-center">
                                        {{-- User Image --}}
                                        <img src="{{ asset('storage/images/users/' . $user->user_image) }}" width="80"
                                            class="rounded-circle shadow-4 mb-3" alt="user profile image">
                                        <h3 class="h3 mb-0">
                                            {{ $user->name }}
                                        </h3>
                                        {{-- Must loop through goals as the relationship is 1:M, even though only 1 goal per user exists --}}
                                        @foreach ($user->goals as $goal)
                                            <p class="fs-6 mb-0">{{ $goal->language }} | {{ $user->level }}
                                            </p>
                                        @endforeach
                                        {{-- User interests --}}
                                        <div class="d-flex interests">
                                            @foreach ($user->interests as $interest)
                                                <p class="fs-6 bg-light rounded-pill px-3 py-1 mb-0">
                                                    {{ $interest->name }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="position-absolute top-0 end-0">
                                        {{-- Flag --}}
                                        <img class="rounded rounded-4" width="30"
                                            src="{{ asset('storage/images/flags/' . $user->country->image) }}"
                                            alt="user profile image">
                                    </div>
                                </div>
                            {{-- </a> --}}
                        </div>
                    </div>
                </div>
            </label>
            @endforeach
        </div>
    </div>

    {{-- Buttons --}}
    <div class="row">
        <div class="col-12 mt-2 d-grid">
            <x:form::button.submit>Save </x:form::button.submit>
        </div>
        </x:form:form>
    </div>

    {{-- OLD FORM --}}
    <div class="col-md-8">
        <div class="card py-3 px-4">
            <h1 class="h3">Personal Details</h1>

            {{-- possible to use :bind="goals" to auto popular labels, error --}}
            <x:form::form class="row" method="post" :action="route('user.goals.store')">

                {{-- Personal Information --}}
                <div class="col">
                    <div class="row mb-3">
                        <label for="country" class="col-md-3 col-form-label text-md-end">{{ __('Country') }}</label>
                        <div class="col-md-7">
                            <input id="country" type="text" class="form-control" name="country" field="country"
                                required>
                            </input>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="about_me" class="col-md-3 col-form-label text-md-end">{{ __('About Me') }}</label>
                        <div class="col-md-7">
                            <textarea id="about_me" type="textarea" class="form-control" name="about_me" field="about_me" required>
                                </textarea>
                        </div>
                    </div>
                </div>

                <h1 class="h3">Create a Goal</h1>
                <div class="col-md-6">
                    <x:form::input name="title" label="Title" />
                    {{-- <x:form::input type="email" name="email" /> --}}
                    <x:form::textarea rows="5" name="description" label="Description" />
                </div>
                <div class="col-md-6">
                    {{-- 'multiple' displays options as non-dropdown list --}}
                    <label for="activity" class="form-label">Language</label>
                    <select type="select" field="languages" class="form-select" id="languages" name="language"
                        label="Select Language" multiple>
                        @foreach ($languages as $language)
                            <option value="{{ $language }}">
                                {{ $language }}
                            </option>
                        @endforeach
                    </select>
                </div>



                <div class="col-12 mt-2">
                    <x:form::button.link href="{{ route('user.goals.index') }}" class="btn-secondary me-3">
                        {{ __('Cancel') }}</x:form::button.link>
                    <x:form::button.submit>Save </x:form::button.submit>
                </div>
                </x:form:form>
        </div>
    </div>
    </div>
@endsection
