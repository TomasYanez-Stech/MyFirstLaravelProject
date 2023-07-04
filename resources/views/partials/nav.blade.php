<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route("home") }}">{{ config("app.name") }}</a>
    
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
            <ul class="nav nav-left me-auto">

            </ul>
            <ul class="navbar-nav nav-right ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ setActive("home") }}" href="{{ route("home") }}">{{ __(ucwords("home")) }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ setActive("about") }}" href="{{ route("about") }}">{{ __(ucwords("about")) }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ setActive("contact") }}" href="{{ route("contact") }}">{{ __(ucwords("contact")) }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ setActive("projects.index") }}" href="{{ route("projects.index") }}">{{ __(ucwords("portfolio")) }}</a>
                </li>
                {{-- @auth = user authenticated, @guest = user not authenticated --}}
                {{-- Both are conditional structures --}}
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ setActive("login") }}" href="{{ route("login") }}">{{ __(ucwords("login")) }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ setActive("register") }}" href="{{ route("register") }}">{{ __(ucwords("register")) }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <form id="logout-form" method="POST" action="{{ route("logout") }}">
                            @csrf
                            <a class="nav-link dropdown-item {{ setActive("logout") }}" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __(ucwords("logout")) }}
                            </a>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>