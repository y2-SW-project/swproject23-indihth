@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form action="{{ route('goals.store') }}" method="post" enctype="multipart/form-data">
                    {{-- @csrf is used to generate a hidden field with a csrf token to validate the request is being made 
                    by an authorised user. Prevent outside attacks --}}
                    @csrf

                    {{-- if field doesn't pass validation an error message will show.
                    'field' value is used to display error from the component file --}}
                    {{-- <x-input type="text" name="title" field="title" :value="@old('title')" placeholder="Title" class="w-full"
                        autocomplete="off"></x-input> --}}

                    <x-input type="text" name="title" field="title" :value="@old('title')" placeholder="Title" class="w-full"
                        autocomplete="off"></x-input>


                    {{-- 'value' is used to retain user input after error message from other fields
                    :colon needed to pass in a Blade value --}}
                    <x-textarea name="description" rows="10" field="description" :value="@old('description')"
                        placeholder="Start typing here..." class="w-full mt-6"></x-textarea>
                    {{-- 
                <x-input type="text" name="director" field="director" :value="@old('director')"
                    placeholder="Director" class="" autocomplete="off"></x-input>
                <x-input type="date" name="release_date" field="release_date" :value="@old('release_date')"
                    placeholder="Release Date" class="w-full" autocomplete="off"></x-input>
                <x-input type="number" name="rating" field="rating" :value="@old('rating')" placeholder="Rating"
                    class="" autocomplete="off"></x-input>
                <x-input type="number" name="difficulty" field="difficulty" :value="@old('difficulty')"
                    placeholder="Difficulty" class="" autocomplete="off"></x-input>

                <x-input type="file" name="image" field="image" :value="@old('image')"
                    placeholder="image" class=""></x-input> --}}

                    {{-- <x-input type="file " name="image"aria-placeholder="TV Show image" class="" field="image">
                </x-input> --}}

                    <x-primary-button class="mt-6">Save</x-primary-button>
                </form>

                {{-- possible to use :bind="goals" to auto popular labels, error --}}
                <x:form::form class="row" method="post" :action="route('goals.store')">
                    <div class="col-md-6">
                        <x:form::input name="title" label="Title" />
                        {{-- <x:form::input type="email" name="email" /> --}}
                        <x:form::textarea name="description" label="Description"  />
                    </div>
                    <div class="col-md-6">
                        {{-- 'multiple' displays options as non-dropdown list --}}
                        <x:form::select name="languages"
                            :options="$languages" label="Select Language" multiple />
                        <x:form::checkbox name="technologies"
                            :group="[1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire']" inline />
                        <x:form::radio name="gender" :group="[1 => 'Male', 2 => 'Female', 3 => 'Other']" inline />
                        <x:form::toggle-switch name="active" />
                    </div>
                    <div class="col-12 mt-2">
                        <x:form::button.link class="btn-secondary me-3">{{ __('Cancel') }}</x:form::button.link>
                        <x:form::button.submit />
                    </div>
                    </x:form:form>

            </div>
        </div>
    @endsection
