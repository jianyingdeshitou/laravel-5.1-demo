<html>
<head>
    <title> Post </title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2> 登录 </h2>
        <hr>
        <form class="form-horizontal" method="POST" action="/auth/login">
            {!! csrf_field() !!}

            <div class="form-group">
                <label class="col-sm-1">用户名</label>
                <div class="col-sm-3 form-controls">
                    <input class="form-control" type="name" name="name" value="{{ old('name') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-1">密码</label>
                <div class="col-sm-3 form-controls">
                <input class="form-control" type="password" name="password" id="password">
                </div>
            </div>

            <div class="form-group">
            <div class="col-sm-offset-1 col-sm-1">
                <label>
                <input type="checkbox" name="remember" value="ddd"> 记住我
                </label>
            </div>

            <button class="col-sm-1 btn btn-primary" type="submit">登录</button>
            </div>
        </form>

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
    </div>
</body>
<html>

