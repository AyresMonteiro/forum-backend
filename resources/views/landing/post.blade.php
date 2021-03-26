<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CEFET Forum</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
</head>

<body>
    <div class="main">
        <h1><strong>CEFET</strong> Forum</h1>
    </div>

    <div>
        {{ $post->title }}
    </div>
    <br><br>
    <div>
        {{ $post->body }}
    </div>

    <br><br>
    <br><br>

    <strong>Comentários:</strong>
    
    <br><br>
    <div>
        <div>
            @foreach ($comments as $comment)
                <div>
                    {{ $comment->body }}
                </div>
            @endforeach
        </div>
    </div>
    
    <br><br>

    <form action="{{'/api/posts/'.$post->id.'/comments'}}" method="post" style="display: flex; align-items: center; flex-direction: column">
        <textarea name="body" style="width: 350px" rows="10" columns="50" ></textarea>
        <br>
        <button type="submit">adicionar novo comentário</button>
    </form>

</body>

</html>
