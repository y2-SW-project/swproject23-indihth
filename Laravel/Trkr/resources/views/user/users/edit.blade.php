@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="h2">Edit User</div>
                <div class="card py-3 px-4">

                    <x:form::form :bind="$user" class="row" method="put" enctype="multipart/form-data"
                        :action="route('user.users.update', $user)">


                        {{-- Personal Details --}}
                        <div class="col-6">
                            <div class="col">
                                {{-- Name --}}
                                <x:form::input name="name" label="Name" :value="@old('name', $user->name)" />
                                {{-- About Me --}}
                                <x:form::textarea name="about_me" label="About Me" :value="@old('about_me', $user->about_me)"
                                    rows="5" />

                                {{-- Country --}}
                                <div>
                                    <label for="country_id" class="form-label">Country</label>
                                    <select class="form-select" id="country_id" name="country_id" label="Select Country">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" @selected(old('country_id', $user->country->id) == $country->id)>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Language --}}
                                <label for="language" class="form-label">Language</label>
                                <select class="form-select" id="language" name="language" label="Select Language">
                                    @foreach ($user->goals as $goal)
                                        @foreach ($languages as $language)
                                            <option value="{{ $language }}" @selected(old('language', $goal->language) == $language)>
                                                {{ $language }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>



                            {{-- Buttons --}}
                            <div class="col-12 mt-2">
                                {{-- Redirects back to the user show with id --}}
                                <x:form::button.link href="{{ route('user.users.show', $user->id) }}"
                                    class="btn-secondary me-3">
                                    {{ __('Cancel') }}</x:form::button.link>
                                <x:form::button.submit>Save </x:form::button.submit>
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- Interests NEED TO FIX--}}
                            {{-- <label for="interests" class="col col-form-label text-md-end">{{ __('Interests') }}</label>
                            
                            @foreach ($interests as $interest)
                                <div class="form-check">
                                    <input type="hidden" name="interest[]" >
                                    <input class="form-check-input" type="checkbox" value="{{ $interest->id }}" name="interest[]" id="flexCheckDefault" @checked($user->interest || old('interest', 0) === 1)>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $interest->name }}
                                    </label>
                                </div>
                            @endforeach
                            <br/> --}}

                            {{-- Profile Image Upload, how to display preview? --}}
                            <label for="image"
                                class="col col-form-label text-md-end">{{ __('Upload Image (optional)') }}</label>

                            <div class="col">
                                <input id="image" type="file" class="form-control" name="image" field="image"
                                    required>
                            </div>
                        </div>
                        </x:form:form>
                </div>
            </div>
        </div>
    @endsection
