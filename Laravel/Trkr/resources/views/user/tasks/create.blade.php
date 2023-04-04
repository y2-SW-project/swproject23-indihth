@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="h2">Add a New Task</div>
                <div class="card py-3 px-4">
                    <div>
                        Goal id: {{ $goal_id}}
                        {{-- Goal id: {{ $task}} --}}
                    </div>
                    {{-- possible to use :bind="goals" to auto popular labels, error --}}
                    <x:form::form class="row" method="post" :action="route('user.tasks.store')">
                        <div class="col-md-6">
                            <x:form::input name="title" label="Title" />
                            {{-- <x:form::input type="email" name="email" /> --}}
                            <x:form::textarea rows="5" name="description" label="Description" />
                        </div>
                        <div class="col-md-6">
                           
                            <label for="activity" class="form-label">Activity</label>
                            <select type="select" field="activity" class="form-select" id="activity" name="activity" label="Select Activity" multiple >
                                @foreach ($type as $activity)
                                    <option  value="{{ $activity }}">
                                        {{ $activity }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- <select type="select" field="languages" class="form-select" id="languages" name="language" label="Select Language" multiple>
                                @foreach ($languages as $language)
                                    <option  value="{{ $language }}">
                                        {{ $language }}
                                    </option>
                                @endforeach
                            </select> --}}
                        </div>
                        <input type="hidden" name="goal_id" value="{{ $goal_id }}"/>
                        <div class="col-12 mt-2">
                            <x:form::button.link href="{{ back() }}" class="btn-secondary me-3">{{ __('Cancel') }}</x:form::button.link >
                            <x:form::button.submit>Save </x:form::button.submit>
                        </div>
                        {{-- Hidden field to submit goal id to database --}}
                        </x:form:form>
                </div>
            </div>
        </div>
    @endsection
