@extends('layout')

@section('title')
    @lang("Portfolio")
@endsection

@section('content')
    @include('partials._session-status')

    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-3">
            @isset($category)
                <div class="">
                    <h1 class="display-4">@lang($category->name)</h1>
                    <a href="{{ route('projects.index') }}">Go Back to Portfolio</a>
                </div>
            @else
                <h1 class="display-4">@lang("Portfolio")</h1>
            @endisset
            
            @can('create', $newProject)
                <a class="btn btn-primary" href="{{ route("projects.create") }}">{{ __(ucwords("create project")) }}</a>
            @endcan
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
                <div
                    class="card shadow-sm mx-auto mt-4"
                    style="width: 18rem; cursor: pointer;"
                    onclick="
                        history.pushState({}, document.title + ' | Portfolio', '{{ route('projects.show', $project) }}')
                        location.href = '{{ route('projects.show', $project) }}';
                    "
                >
                    @if ($project->image)
                        <img src="/storage/{{ $project->image }}" class="card-img-top object-fit-cover" style="height: 150px" alt="">
                    @endif
                    <div class="card-header">
                        <h4 class="card-title text-primary" style="font-size: 1.5rem">{{$project->title}}</h4>
                        @if ($project->category_id)
                            <a
                                href="javascript:void"
                                class="border-0 badge bg-secondary"
                                onclick="
                                    event.preventDefault();
                                    event.stopPropagation();
                                    history.pushState({}, document.title + ' | Portfolio', '{{ route('categories.show', $project->category) }}')
                                    location.href = '{{ route('categories.show', $project->category) }}';
                                "
                            >
                                    {{ $project->category->name }}
                            </a>
                        @endif
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $project->description }}</p>
                    </div>
                    <div class="card-footer">
                        <ul class="list-unstyled">
                            <li>@lang("Creation"): {{ $project->created_at->diffForHumans() }}</li>
                            <li>@lang("Last Update"): {{ $project->updated_at->diffForHumans() }}</li>
                        </ul>
                    </div>
                </div>
            @empty
                <li class="list-group-item mb-3 shadow-sm">
                    No projects to show yet...
                </li>
            @endforelse
        </div>
        @can("view-deleted-projects")
            <ul>
                @foreach ($deletedProjects as $project)
                    <li>
                        {{ $project->title }} 
                        @can('update', $project)
                            <form
                                class="d-inline"
                                action="{{ route('projects.restore', $project) }}"
                                method="POST"
                            >
                                @csrf
                                @method("PATCH")
                                <button class="btn btn-sm btn-info">Restaurar</button>
                            </form>
                        @endcan
                        @can('force-delete', $project)
                            <form
                                class="d-inline"
                                action="{{ route('projects.force-delete', $project) }}"
                                method="POST"
                            >
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        @endcan
                    </li>
                @endforeach
            </ul>
        @endcan
        {{ $projects->links('pagination::bootstrap-5') }}
    </div>
@endsection