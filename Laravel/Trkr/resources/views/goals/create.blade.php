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

                    <x-input type="text" name="title" field="title" :value="@old('title')" placeholder="Title"
                        class="w-full" autocomplete="off"></x-input>


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

            </div>
        </div>
    </div>
@endsection
