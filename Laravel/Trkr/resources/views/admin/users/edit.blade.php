@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="h2">Edit User</div>
                <div class="card py-3 px-4">

                    {{-- You won't need to define a @method() directive, declare your PUT, PATCH or DELETE action directly in the action attribute --}}
                    <x:form::form :bind="$user" class="row" method="put" enctype="multipart/form-data"
                        :action="route('admin.users.update', $user)">

                        {{-- Personal Details --}}
                        <div class="col-6">
                            <div class="col">
                                <x:form::input name="name" label="Name" :value="@old('name', $user->name)" />
                                <x:form::textarea name="about_me" label="About Me" :value="@old('about_me', $user->about_me)"
                                    rows="5" />

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

                            {{-- Profile Image Upload, how to display preview? --}}
                            <div class="col-md-6">
                                <label for="image"
                                    class="col col-form-label text-md-end">{{ __('Upload Image (optional)') }}</label>

                                <div class="col">
                                    <input id="image" type="file" class="form-control" name="image"
                                        field="image" required>
                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                {{-- Redirects back to the user show with id --}}
                                <x:form::button.link href="{{ route('admin.users.show', $user->id) }}"
                                    class="btn-secondary me-3">
                                    {{ __('Cancel') }}</x:form::button.link>
                                <x:form::button.submit>Save </x:form::button.submit>
                            </div>
                        </div>


                        </x:form:form>
                </div>
            </div>
        </div>
        {{-- Include for SweetAlert js package --}}
        @include('sweetalert::alert')
    @endsection
