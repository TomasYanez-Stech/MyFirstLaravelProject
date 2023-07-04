@extends('layout')

@section('title')
    @lang("Portfolio")
@endsection

@section('content')
@include('partials._session-status')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h1 class="display-4">@lang("Portfolio")</h1>
            
            @auth
                <a class="btn btn-primary" href="{{ route("projects.create") }}">{{ __(ucwords("create project")) }}</a>
            @endauth
        </div>
        <p class="lead text-secondary">Portafolio de proyectos Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
        <div class="d-flex flex-wrap justify-content-between align-items-start">
            {{-- @if($portfolio)
                @foreach ($portfolio as $project)
                    <li>{{$project["title"]}}</li>
                @endforeach
            @else
                <li>No projects to show yet...</li>
            @endif --}}
            @forelse ($projects as $project)
                <a class="text-decoration-none shadow-sm mx-auto mt-4" href="{{ route('projects.show', $project) }}">
                    <div class="card" style="width: 18rem;">
                        @if ($project->image)
                            <img src="/storage/{{ $project->image }}" class="card-img-top" alt="">
                        @endif
                        <div class="card-body">
                            <h4 class="card-title text-primary" style="font-size: 1.5rem">{{$project->title}}</h4>
                            <p class="card-text">{{ $project->description }}</p>
                        </div>
                        <div class="card-footer">
                            <ul class="list-unstyled">
                                <li>@lang("Creation"): {{ $project->created_at->diffForHumans() }}</li>
                                <li>@lang("Last Update"): {{ $project->updated_at->diffForHumans() }}</li>
                            </ul>
                        </div>
                    </div>
                </a>
            @empty
                <li class="list-group-item mb-3 shadow-sm">
                    No projects to show yet...
                </li>
            @endforelse
        </div>
        {{ $projects->links('pagination::bootstrap-5') }}
    </div>
@endsection