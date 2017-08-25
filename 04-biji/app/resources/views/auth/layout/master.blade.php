<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    {{--移动或响应式web页面缩放设置--}}
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">

    <title>笔友 | Be yourself</title>

    <link href="https://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    @yield('script')
</head>

<body>
<div class="container" style="margin: 60px auto;">
    <div class="container-fluid">
        <div class="row">
            @yield('return')
            <div class="col-md-5 col-md-offset-3">
                @include('auth.layout.panel')
            </div>
        </div>
    </div>
</div>
</body>
</html>
