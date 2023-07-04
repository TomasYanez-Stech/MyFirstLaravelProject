@extends('layout')

@section('title')
    @lang("Home")
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <h1 class="display-3 text-primary">Tomás Yañez</h1>
                <p class="lead text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium beatae vel soluta!</p>

                <a href="{{ route("contact") }}" class="btn btn-lg w-100 btn-primary mb-2">@lang("Contact Me")</a>
                <a href="{{ route("projects.index") }}" class="btn btn-lg w-100 btn-outline-primary">@lang("Portfolio")</a>
            </div>
            <div class="col-12 col-lg-6">
                <img class="img-fluid mt-4" src="{{ asset("/img/undraw_programming.svg") }}" alt="">
            </div>
        </div>
    </div>
@endsection