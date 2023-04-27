@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12 mb-3">
                {{-- Goal Image --}}
                <div class="card">
                    <img src="{{ asset('storage/images/goals/' . $goal->goal_image) }}" class="card-img goalImage">
                    <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                        <div class="text-white p-3">
                            <h1 class="display-4 fw-bold text-uppercase">
                                {{ $goal->title }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-11 ">
                <div class="col-8 py-3 card card-body mx-auto">
                    <h2 class="h5">Goal Info</h2>
                    {{-- You won't need to define a @method() directive, declare your PUT, PATCH or DELETE action directly in the action attribute --}}
                    <x:form::form :bind="$goal" class="row" method="put"
                        :action="route('user.goals.update', $goal)">
                        <div class="col-md-6">
                            <x:form::input name="title" label="Title" :value="@old('title', $goal->title)" class="" />
                            {{-- <x:form::input type="email" name="email" /> --}}
                            <x:form::textarea name="description" label="Description" rows=5 :value="@old('description', $goal->description)" />
                        </div>
                        <div class="col-md-6">
                            {{-- 'multiple' displays options as non-dropdown list --}}
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
                        {{-- Buttons --}}
                        <div class="col-12 mt-2 d-grid">
                            <x:form::button.submit>Save </x:form::button.submit>
                        </div>
                        </x:form:form>
                        {{-- Goal Delete Button --}}
                        <x:form::form action="{{ route('user.goals.destroy', $goal) }}" method="delete" class="col-12 mt-2 d-grid">
                            <x:form::button.submit class="btn-danger" onclick="deleteConfirm(event)">Delete
                                Goal
                            </x:form::button.submit>
                        </x:form::form>
                </div>
            </div>
        </div>
    @endsection
