@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="col-11 card card-body">
                    <x:form::form class="row" method="post" enctype="multipart/form-data"
                        :action="route('user.goals.store')">
                    <h2 class="h5">Goal Info</h2>
                    <hr />
                    <div class="col">
                        <x:form::input name="title" label="Title" :value="@old('title')" class="" />
                        <x:form::textarea name="description" label="Description" rows=5 :value="@old('description')" />
                    </div>
                    <div class="col-md-11">
                        <label for="languages" class="form-label">Language</label>
                        <select class="form-select" id="languages" name="language" label="Select Language">
                            @foreach ($languages as $language)
                                <option value="{{ $language }}" @selected(old('language'))>
                                    {{ $language }}
                                </option>
                            @endforeach
                        </select>
                        <br />
                    </div>
                    <div class="my-auto">
                        {{-- Image Upload Button --}}
                        <div class="">
                            <label for="goal_image" class="btn btn-primary">Upload Image</label>
                            <input id="goal_image" type="file" class="" name="goal_image"
                                field="goal_image" required hidden>
                        </div>
                        <p class="fs-6 text-muted">Image to be displayed on your profile</p>
                    </div>
                    {{-- Button --}}
                    <div class="col-12 mt-2 d-grid">
                        <x:form::button.submit>Save </x:form::button.submit>
                    </div>
                    </x:form:form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
    </div>

    </div>
@endsection
