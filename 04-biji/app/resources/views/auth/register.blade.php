@extends('auth.layout.master')

@section('script')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('title')
    注册
@endsection

@section('content')
    @include('partials.errors')
    @include('auth.forms.register')
@endsection
