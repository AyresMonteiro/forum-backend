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
    <strong>{{$subtopic->title}}</strong> <br> {{$subtopic->summary}}
    <div style="align-self: flex-start; margin: 6px;">
    <strong>Posts:</strong>
        <div style="margin: 12px;">
            @foreach ($posts as $post)
                <div>
                    <a href="{{'/posts/'.$post->id}}" style="text-decoration: none">{{$post->title}}</a>
                </div>
            @endforeach
        </div>

        <div style="padding: 16px;"><a href="{{'/'.$subtopic->id.'/posts/create'}}" class="new-post" type="submit">criar</a></div>
    </div>
</body>

</html>
