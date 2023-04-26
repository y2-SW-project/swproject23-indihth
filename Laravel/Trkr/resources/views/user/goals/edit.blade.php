@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="h2">Edit Goal</div>
                <div class="card py-3 px-4">

                    {{-- You won't need to define a @method() directive, declare your PUT, PATCH or DELETE action directly in the action attribute --}}
                    <x:form::form :bind="$goal" class="row" method="put"
                        :action="route('user.goals.update', $goal)">
                        <div class="col-md-6">
                            <x:form::input name="title" label="Title" :value="@old('title', $goal->title)" />
                            {{-- <x:form::input type="email" name="email" /> --}}
                            <x:form::textarea name="description" label="Description" :value="@old('description', $goal->description)" />
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
                        </div>
                        <div class="col-12 mt-2 d-flex justify-content-between">
                            {{-- Save and Cancel Buttons --}}
                            <div>
                                <x:form::button.link href="{{ route('user.goals.show', $goal->id) }}"
                                    class="btn-secondary me-3">
                                    {{ __('Cancel') }}</x:form::button.link>
                                <x:form::button.submit>Save </x:form::button.submit>
                            </div>
                        </div>
                        </x:form:form>

                        {{-- Delete Goal Button
                            Should user be able to delete their only goal? breaks other pages--}}
                            
                        {{-- <x:form::form action="{{ route('user.goals.destroy', $goal) }}" method="delete">
                            <x:form::button.submit class="btn btn-danger" onclick="deleteConfirm(event)">Delete Goal
                            </x:form::button.submit>
                        </x:form::form> --}}
                </div>
            </div>
        </div>
    @endsection
