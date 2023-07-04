<!DOCTYPE html>
<html>
    <head>
        <title>Mensaje Recibido!</title>
    </head>
    <main>
        Has recibido un mensaje de {{ $msg["name"] }}! &lt;{{ $msg["email"] }}&gt;

        Asunto: <strong>{{ $msg["subject"] }}</strong>

        {{ $msg["content"] }}
    </main>
</html>