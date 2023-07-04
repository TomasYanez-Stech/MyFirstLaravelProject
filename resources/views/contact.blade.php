@extends('layout')

@section('title')
    {{ __("Contact") }}
@endsection

@section('content')
    @include('partials._session-status')

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-6">
                {{-- {{ dump($errors) }} --}}
                {{-- @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                @endif --}}
            
                <form class="bg-white shadow py-3 px-4 rounded" method="POST" action="{{ route('contact.store') }}">
                    <h1 class="display-5 mb-4">@lang('Contact')</h1>
                    @csrf
                    <div class="form-group">
                        <label for="name">@lang(ucfirst("name"))</label>
                        <input
                            class="form-control shadow-sm @error("name")is-invalid @else border-0 @enderror"
                            type="text"
                            name="name"
                            placeholder="Name..."
                            value="{{ old("name") }}"
                        >
                        @error("name")
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    <small>{{ $message }}</small>
                                </strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __(ucfirst("email")) }}</label>
                        <input
                            class="form-control shadow-sm @error("email")is-invalid @else border-0 @enderror"
                            type="email"
                            name="email"
                            placeholder="Email..."
                            value="{{ old("email") }}"
                        >
                        @error("email")
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    <small>{{ $message }}</small>
                                </strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="subject">{{ __(ucfirst("subject")) }}</label>
                        <input
                            class="form-control shadow-sm @error("subject")is-invalid @else border-0 @enderror"
                            type="text"
                            name="subject"
                            placeholder="Subject..."
                            value="{{ old("subject") }}"
                        >
                        @error("subject")
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    <small>{{ $message }}</small>
                                </strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">{{ __(ucfirst("content")) }}</label>
                        <textarea
                            class="form-control shadow-sm @error("content")is-invalid @else border-0 @enderror"
                            name="content"
                            id="textContent"
                            placeholder="Message..."
                        >{{ old("content") }}</textarea>
                        @error("content")
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    <small>{{ $message }}</small>
                                </strong>
                            </span>
                        @enderror
                    </div>
                    {{-- {!! $errors->first("content", "<br><strong style='color:red;'><small>:message</small></strong>") !!} --}}
                    <button class="btn btn-primary btn-large w-100">
                        @lang("Submit")
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection