<html>
<head>
    <title> Post </title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2> 注册 </h2>
        <hr>
        <form method="POST" action="/auth/register">
            {!! csrf_field() !!}

            <div class="form-group">
                用户名
                <div class="form-controls">
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                </div>
            </div>

            <div class="form-group">
                Email
                <div class="form-controls">
                <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                </div>
            </div>

            <div class="form-group">
                密码
                <div class="form-controls">
                <input class="form-control" type="password" name="password">
                </div>
            </div>

            <div class="form-group">
                确认密码
                <div class="form-controls">
                <input class="form-control" type="password" name="password_confirmation">
                </div>
            </div>

            <div>
                 <button class="btn btn-primary" type="submit">注册</button>
            </div>
        </form>
    </div>
</body>
</html>

