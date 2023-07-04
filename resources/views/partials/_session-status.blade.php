@if (session('status'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
