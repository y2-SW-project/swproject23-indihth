@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="d-flex ms-n5">
                <div class="mb-4">
                    <h1 class="h5 mb-0 fw-bolder">Create Profile</h1>
                    {{-- Display current date --}}
                    <p class="h7">{{ now()->toFormattedDayDateString() }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-11 card card-body">
                    <h2 class="h5">Person Info</h2>
                    <x:form::form :bind="$user" class="row" method="put" enctype="multipart/form-data"
                        :action="route('user.users.store', $user)">

                        <hr />
                        {{-- Personal Details --}}
                        <div class="col">
                            {{-- Name --}}
                            <x:form::input name="name" label="Name" :value="@old('name')" class="mb-4" hidden />
                            {{-- About Me --}}
                            <x:form::textarea name="about_me" label="About Me" :value="@old('about_me')" rows="4"
                                class="mb-4" />
                            <div class="d-flex mb-4">
                                {{-- Country --}}
                                <div class="col me-3">
                                    <label for="country_id" class="form-label">Country</label>
                                    <select class="form-select" id="country_id" name="country_id" label="Select Country">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- Interests --}}
                            <label for="interest_id[]" class="form-label">Interests</label>
                            <div class="row ps-3">
                                @foreach ($interests as $interest)
                                    <div class="col-6 form-check">
                                        <input type="checkbox" class="form-check-input" name="interest_id[]"
                                            id="exampleCheck1" value="{{ $interest->id }}">
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
                            <x:form::input name="title" label="Title" :value="@old('title')" class="" />
                            <x:form::textarea name="description" label="Description" rows=5 :value="@old('description')" />
                        </div>
                        <div class="col-md-10">
                            <label for="languages" class="form-label">Language</label>
                            <select class="form-select" id="languages" name="language" label="Select Language">
                                @foreach ($languages as $language)
                                    <option value="{{ $language }}" @selected(old('language') == $language)>
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
    @endsection
