<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>clockOS Developer account confirmation</title>
</head>
<body>
    <h1>Welcome to clockOS Developers</h1>
    <p><a href="{{ url("register/confirm/{$token}") }}">CONFIRM YOUR ACCOUNT NOW</a></p>
    <br/>If you can’t use the button, just try this link:
    <br/>{{ url('register/confirm/'.$token) }}
</body>
</html>