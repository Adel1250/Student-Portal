<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: linear-gradient(120deg, #2980b9, #8e44ad);
        }

        .center {
            position: absolute;
        }
    </style>
</head>

<body>
    <h1 style="color:white">Videos</h1>
    <div class="center">
        @foreach($result as $item)
        <video width="640" height="480" controls>
            <source src="/videos/{{$item->location}}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <br><br>
        @endforeach
    </div>
</body>

</html>
