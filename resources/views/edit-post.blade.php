<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="/edit-post/{{$post->id}}" method="post">
        @csrf
        @method('PUT')
        Title: <input type="text" value="{{$post->title}}" name="title"><br>
        Content:<textarea name="body">{{$post->body }}</textarea><br>
        <button>Update Post</button>
    </form>
</body>
</html>