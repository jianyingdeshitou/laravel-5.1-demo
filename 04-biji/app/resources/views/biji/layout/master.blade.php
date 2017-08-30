<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    {{--移动或响应式web页面缩放设置--}}
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">

    <title>笔友 | Be yourself</title>

    <link href="https://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/biji.css') }}" rel="stylesheet">

    <script src="{{ URL::asset('/') }}js/loading.js"></script>
    @yield('script')
</head>

<body>
<div class="row">
    <div class="col-md-1">
            @yield('nav')
    </div>
    <div class="col-md-3">
        @yield('list')
    </div>
    <div class="col-md-8">
        @yield('header')
    </div>
    <div class="col-md-8">
        @yield('content')
    </div>
</div>
</body>
</html>
