<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>激活clockOS Developer账号</title>
</head>
<body>
    <h1>欢迎加入到clockOS Developers</h1>
    <p><a href="{{ url("register/confirm/{$token}") }}">点击此链接激活账号</a></p>
    <br/>若无法点击请复制链接到在游览器中打开
    <br/>{{ url('register/confirm/'.$token) }}
</body>
</html>