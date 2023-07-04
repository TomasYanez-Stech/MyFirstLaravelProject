@extends('layout')

@section('title', __("Edit Project"))

@section('content')
@include('partials._session-status')

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-6">
                @include('partials.error-list')
                <form
                    class="bg-white shadow py-3 px-4 rounded"
                    method="POST"
                    action="{{ route("projects.update", $project->slug) }}"
                    enctype="multipart/form-data"
                >
                    <h1 class="display-3">@lang("Edit Project")</h1>
                    <hr>
                    @method("PATCH")
                    {{-- <input type="hidden" name="_method" value="PATCH"> --}}
                    @include("partials._form")
                    <a href="{{ route("projects.show", $project->slug) }}" class="btn btn-lg btn-link w-100 mt-2">@lang('Cancel')</a>
                </form>
            </div>
        </div>
    </div>

@endsection