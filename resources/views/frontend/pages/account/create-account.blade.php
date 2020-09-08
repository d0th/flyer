@extends('layouts.app')

@section('metatags')
    <title>iFly Minsk - Создать аккаунт</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <create-account-component></create-account-component>
@endsection
