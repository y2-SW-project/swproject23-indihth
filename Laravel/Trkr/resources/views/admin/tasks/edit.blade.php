@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="h2">Edit Goal</div>
                <div class="card py-3 px-4">

                    {{-- You won't need to define a @method() directive, declare your PUT, PATCH or DELETE action directly in the action attribute --}}
                    <x:form::form :bind="$task" class="row" method="put" :action="route('admin.tasks.update', $task)">
                        <div class="col-md-6">
                            <x:form::input name="title" label="Title" :value="@old('title', $task->title)" />
                            {{-- <x:form::input type="email" name="email" /> --}}
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
                                {{-- <input name="status" class="form-check-input" type="checkbox" value="1" @checked($task->status || old('status', 0) === 1) id="flexCheckDefault"> --}}
                                    <input name="status" class="form-check-input" type="checkbox" value="1" @checked(old('status', $task->status ))>
                                    {{-- <input name="status" class="form-check-input" type="checkbox" value="1" @checked($task->status || old('status', 0) === 1) id="flexCheckDefault"> --}}

                                <label class="form-check-label" for="flexCheckDefault">
                                    Task Done
                                </label>
                            </div>
                            {{-- <x:form::radio name="gender" :group="[1 => 'Male', 2 => 'Female', 3 => 'Other']" inline /> --}}

                        </div>

                        <div class="col-12 mt-2">
                            <x:form::button.link href="{{ url()->previous() }}" class="btn-secondary me-3">
                                {{ __('Cancel') }}</x:form::button.link>
                            <x:form::button.submit>Save </x:form::button.submit>
                        </div>
                        </x:form:form>
                </div>
            </div>
        </div>
    @endsection
