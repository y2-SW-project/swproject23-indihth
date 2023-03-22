@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="h2">Edit Goal</div>
                <div class="card py-3 px-4">

                    {{-- You won't need to define a @method() directive, declare your PUT, PATCH or DELETE action directly in the action attribute --}}
                    <x:form::form class="row" method="put" :action="route('goals.update', $goal)">
                        <div class="col-md-6">
                            <x:form::input name="title" label="Title" :value="@old('title', $goal->title)"/>
                            {{-- <x:form::input type="email" name="email" /> --}}
                            <x:form::textarea name="description" label="Description" :value="@old('description', $goal->description)"/>
                        </div>
                        <div class="col-md-6">
                            {{-- 'multiple' displays options as non-dropdown list --}}
                            <x:form::select name="languages" :options="$languages" label="Select Language" :value="@old('languages', $goal->language)" multiple />
                            <x:form::checkbox name="technologies"
                                :group="[1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire']" inline />
                            <x:form::radio name="gender" :group="[1 => 'Male', 2 => 'Female', 3 => 'Other']" inline />
                            <x:form::toggle-switch name="active" />
                        </div>
                        <div class="col-12 mt-2">
                            <x:form::button.link class="btn-secondary me-3">{{ __('Cancel') }}</x:form::button.link>
                            <x:form::button.submit>Save </x:form::button.submit>
                        </div>
                        </x:form:form>
                </div>
            </div>
        </div>
    @endsection
