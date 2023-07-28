@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <strong style='color:red;'>
                <small>{{ __($error) }}</small>
            </strong>
            <br>
        @endforeach
    </div>

@endif