@extends('layout')

@section('title', __("Create Project"))

@section('content')
@include('partials._session-status')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-6">
                @include('partials.error-list')
                <form
                    class="bg-white shadow py-3 px-4 rounded"
                    method="POST"
                    action="{{ route("projects.store") }}"
                    enctype="multipart/form-data"
                >
                
                    <h1 class="display-3">@lang("Create Project")</h1>
                    <hr>
                    @include("partials._form")
                    <a href="{{ route("projects.index", $project->slug) }}" class="btn btn-lg btn-link w-100 mt-2">@lang('Cancel')</a>
                </form>
            </div>
        </div>
    </div>

@endsection