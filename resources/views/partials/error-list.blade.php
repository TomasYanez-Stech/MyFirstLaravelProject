@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <strong style='color:red;'>
                <small>{{ $error }}</small>
            </strong>
            <br>
        @endforeach
    </div>

@endif