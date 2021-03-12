<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CEFET Forum</title>

    <link rel="stylesheet" href="css/app.css">
</head>

<body>
    <div class="main">
        <h1><strong>CEFET</strong> Forum</h1>
    </div>
    <div class="content-container">
        <a href="" class="new-post">Criar Post</a>
        <div class="topics-container">
            @foreach ($topics as $topic)
                @include('landing.topic', ['topic' => $topic])
            @endforeach
        </div>
    </div>
</body>

</html>
