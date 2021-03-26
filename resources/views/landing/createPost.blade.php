<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CEFET Forum</title>

    <style>
        form * {
            margin: 12px;
        }
    </style>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
</head>

<body>
    <div class="main">
        <h1><strong>CEFET</strong> Forum</h1>
    </div>
    <form action="/api/posts" method="post" style="display: flex; flex-direction: column">
        <input type="text" name="title" placeholder="Insira o titulo do seu post">
        <textarea type="text" name="body" rows="4" cols="50" placeholder="Insira o corpo do seu post"></textarea>
        <input value={{$id}} name="owner_subtopic" hidden>
        <button type="submit">Criar</button>
    </form>
    </div>
</body>

</html>
