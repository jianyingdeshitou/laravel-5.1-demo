@extends('biji.layout.master')

@section('script')
    <script type="text/javascript" src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jquery/jquery.zclip.js') }}"></script>

    <script type="text/javascript" src="{{ asset('bootstrap/bootstrap.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/atip.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/user.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/abook.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/copy.js') }}"></script>

    {{--引入artDialog插件--}}
    @include('biji.artdialog.script')
    {{--END--}}

    <script type="text/javascript" src="{{ asset('js/sign.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/dropdowns.js') }}"></script>


    {{--引入artDialog插件--}}
    @include('biji.umeditor.script')
    {{--END--}}

    <link rel="stylesheet" href="{{ asset('css/biji.css') }}">

    <script type="text/javascript" src="{{ asset('js/biji.js') }}"></script>

@endsection

@section('nav')
    @include('biji.layout.nav')
@endsection

@section('list')
    @include('biji.layout.list')
@endsection

@section('header')
    @include('biji.layout.header')
@endsection

@section('content')
    @include('biji.layout.content')

{{--用户DIV--}}
<div id = "user">
    <div class="book_header">
        <a href="{{ url('/setting') }}" target="_Blank">
            <img id = "user_img" src="
            @if(empty($thumbObj->thumb))
                {{ url('images/photo.jpg') }}
             @else
            {{ url($thumbObj->thumb) }}
            @endif
                    "
                 style="width: 60px;margin:15px 0 0 68px" alt="" class="img-circle" data-toggle="tooltip" data-placement="right" title="换一张照片">
        </a>
        <center>
            <h6>{{ Auth::user()->name }}</h6>

            {{--签到模块--}}
            <!--- 签到 Field --->
            <div class="form-group">
                <p>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</p>
                <input type="button" class="sign btn btn-primary" value="签到"/>
            </div>
            {{----END--}}
        </center>
        <hr/>
        <ul>
            <li class="li"><span class="glyphicon glyphicon-cog"></span> <a href="{{ url('/secure') }}">设置</a></li>
            <li class="li"><span class="glyphicon glyphicon-question-sign"></span> <a href="{{ url('/guide') }}">使用指南</a></li>
            <li class="li"><span class="glyphicon glyphicon-envelope"></span> <a href="{{ url('/fedBack') }}">使用反馈</a></li>
            <li class="li"><span class="glyphicon glyphicon-log-out"></span> <a href="{{ url('auth/logout') }}">退出登录</a></li>
        </ul>
    </div>
</div>
{{--END--}}

{{--笔记本DIV--}}
<div id="book">

    <div style="float: left"><h3>笔记本</h3></div>

    <div style="float: right;margin: 15px 15px;cursor: pointer">
        <a class="atip" href="{{ url('/book/create') }}" data-toggle="tooltip" data-placement="bottom" title="创建笔记本"><i class="icon addBook-img"></i></a>
    </div><br/><br/>

    <div>
        <form class="form-inline" method="GET" action="{{ url('/biji/') }}">
            <div class="form-group">
                <input type="text" id="search_book" name="search_book" class="form-control" placeholder="查找笔记本" style="width: 270px;"/>
                <button id="search_btn" type="button" class="btn btn-default">查找</button>
            </div>
        </form>
    </div>
    <div id="book_list">

    </div>
</div>
{{--END--}}

{{--搜索笔记DIV--}}
<div id="search" class="form-horizontal" role="form">
    <div style="float: left"><h3>搜索笔记</h3></div>
</div>
{{--END--}}

@endsection

