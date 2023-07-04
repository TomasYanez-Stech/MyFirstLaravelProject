@extends('layout')

@section('title')
    @lang("About")
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <img class="img-fluid mt-4" src="{{ asset("/img/undraw_coding.svg") }}" alt="{{ __("About") }}">
            </div>
            <div class="col-12 col-lg-6">
                <h1 class="display-3 text-primary">@lang("About")</h1>
                <p class="lead text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil cumque, laboriosam laborum veniam quod nobis doloribus nisi? Laborum enim iure quo vitae, eum impedit molestiae excepturi! Hic deleniti ipsa ad expedita ab voluptates reiciendis ipsam veritatis? Sed, voluptatum repudiandae, odio dolorum ab illo, ut asperiores beatae iusto enim porro incidunt.</p>

                <a href="{{ route("contact") }}" class="btn btn-lg w-100 btn-primary mb-2">@lang("Contact Me")</a>
                <a href="{{ route("projects.index") }}" class="btn btn-lg w-100 btn-outline-primary">@lang("Portfolio")</a>
            </div>
        </div>
    </div>
@endsection