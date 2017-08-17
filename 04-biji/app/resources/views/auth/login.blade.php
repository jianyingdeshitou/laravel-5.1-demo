@extends('layout.master')

@section('script')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet" type="text/css">

    <script src="https://cdn.bootcss.com/jquery/1.10.1/jquery.min.js"></script>
    <script language="JavaScript" src="{{ URL::asset('/') }}js/auth.js"></script>
@endsection

@section('title')
    登录
@endsection

@section('content')
    @include('partials.errors')
    @include('partials.forms.login')
@endsection
