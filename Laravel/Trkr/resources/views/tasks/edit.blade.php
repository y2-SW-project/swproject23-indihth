@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="h2">Edit Goal</div>
                <div class="card py-3 px-4">

                    {{-- You won't need to define a @method() directive, declare your PUT, PATCH or DELETE action directly in the action attribute --}}
                    <x:form::form :bind="$task" class="row" method="put" :action="route('tasks.update', $task)">
                        <div class="col-md-6">
                            <x:form::input name="title" label="Title" :value="@old('title', $task->title)" />
                            {{-- <x:form::input type="email" name="email" /> --}}
                            <x:form::textarea name="description" label="Description" :value="@old('description', $task->description)" />
                        </div>
                        <div class="col-md-6">
                            {{-- 'multiple' displays options as non-dropdown list --}}
                            <label for="languages" class="form-label">Language</label>
                            <select class="form-select" id="languages" name="language" label="Select Language" >
                                @foreach ($type as $activity)
                                    <option  value="{{ $activity }}" @selected(old('activity', $task->activity) == $activity)>
                                        {{ $activity }}
                                    </option>
                                @endforeach
                            </select>

                            <br/>
                            {{-- <x:form::select name="language" :options="$languages" label="Select Language" /> --}}
                            <x:form::checkbox name="technologies"
                                :group="[1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire']" inline />
                            <x:form::radio name="gender" :group="[1 => 'Male', 2 => 'Female', 3 => 'Other']" inline />
                            <x:form::toggle-switch name="active" />
                        </div>
                        {{-- <input type="hidden" name="goal_id" value="{{ $goal_id }}"/> --}}
                        <div class="col-12 mt-2">
                            <x:form::button.link href="{{ route('tasks.index') }}" class="btn-secondary me-3">
                                {{ __('Cancel') }}</x:form::button.link>
                            <x:form::button.submit>Save </x:form::button.submit>
                        </div>
                        </x:form:form>
                </div>
            </div>
        </div>
    @endsection
