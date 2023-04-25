@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="h2">Edit Task</div>
                <div class="card py-3 px-4">
                    {{-- You won't need to define a @method() directive, declare your PUT, PATCH or DELETE action directly in the action attribute --}}
                    <x:form::form :bind="$task" class="row" method="put"
                        :action="route('user.tasks.update', $task)">
                        <div class="col-md-6">
                            <x:form::input name="title" label="Title" :value="@old('title', $task->title)" />
                            <x:form::textarea name="description" label="Description" :value="@old('description', $task->description)" />
                        </div>
                        <div class="col-md-6">
                            {{-- 'multiple' displays options as non-dropdown list --}}
                            <label for="languages" class="form-label">Language</label>
                            <select class="form-select" id="languages" name="language" label="Select Language">
                                @foreach ($type as $activity)
                                    <option value="{{ $activity }}" @selected(old('activity', $task->activity) == $activity)>
                                        {{ $activity }}
                                    </option>
                                @endforeach
                            </select>

                            <br />
                            <div class="form-check">
                                <input name="status" class="form-check-input" type="checkbox" value="1"
                                    @checked(old('status', $task->status))>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Task Done
                                </label>
                            </div>

                        </div>

                        {{-- Save, Cancel and Delete buttons --}}
                        <div class="col-12 mt-2 d-flex justify-content-between">
                            
                            {{-- Task Delete Button --}}
                            <x:form::form action="{{ route('user.tasks.destroy', $task) }}" method="delete" class="mt-auto">
                                <x:form::button.submit class="btn-danger" onclick="deleteConfirm(event)">Delete
                                    Task
                                </x:form::button.submit>
                            </x:form::form>
                            <div>
                                <x:form::button.link href="{{  url()->previous()}}"
                                    class="btn-secondary me-3">
                                    {{ __('Cancel') }}</x:form::button.link>
                                <x:form::button.submit>Save </x:form::button.submit>
                            </div>
                            </x:form:form>
                        </div>
                </div>
            </div>
        </div>
    @endsection
