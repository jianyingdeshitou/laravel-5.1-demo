<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('blog.title') }} Admin</title>

    <link href={{ asset('css/bootstrap.min.css') }} rel="stylesheet">
    <link href={{ asset('css/admin.css') }} rel="stylesheet">
    <link href={{ asset('css/font-awesome.min.css') }} rel="stylesheet">
    <link href={{ asset('css/jquery.dataTables.min.css') }} rel="stylesheet">
    <link href={{ asset('css/datatables-bootstrap3.css') }} rel="stylesheet">
    @yield('styles')

    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

{{-- Navigation Bar --}}
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">{{ config('blog.title') }} Admin</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            @include('admin.layout.navbar')
        </div>
    </div>
</nav>

@yield('content')

<script src={{ asset('js/jquery.min.js') }}></script>
<script src={{ asset('js/bootstrap.min.js') }}></script>
<script src={{ asset('js/jquery.dataTables.min.js') }}></script>
<script src={{ asset('js/datatables-bootstrap3.js') }}></script>

@yield('scripts')

</body>
</html>
