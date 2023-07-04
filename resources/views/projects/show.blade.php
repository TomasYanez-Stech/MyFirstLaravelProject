@extends('layout')

@section('title')
    @lang($project->title)
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-8 mx-auto">
                @if ($project->image)
                    <img src="/storage/{{ $project->image }}" class="w-100" alt="">
                @endif
                <div class="bg-white p-5 shadow rounded">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="display-3">@lang($project->title)</h1>
                        <a href="{{ route("projects.index") }}">@lang("Go Back")</a>
                    </div>
                    <p class="text-secondary">{{ $project->description }}</p>
        
                    @include('partials._session-status')
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group btn-group-sms">
                            @auth
                                <a class="btn btn-primary" href="{{ route("projects.edit", $project->slug) }}">{{ __("Edit") }}</a>
                                <button class="btn btn-danger rounded-right" onclick="$('[data-delete-project]').submit()">@lang("Delete")</button>
                                <form
                                    class="d-none"
                                    data-delete-project
                                    action="{{ route("projects.destroy", $project) }}"
                                    method="POST"
                                >
                                    @csrf @method("DELETE")
                                </form>
                            @endauth
                        </div>
                        <div class="">
                            <span class="text-black-50">{{ $project->created_at->diffForHumans() }} | @lang("Creation")</span>
                            <br>
                            <span class="text-black-50">{{ $project->updated_at->diffForHumans() }} | @lang("Last Update")</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection