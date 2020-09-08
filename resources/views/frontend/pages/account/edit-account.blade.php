@extends('layouts.app')

@section('metatags')
    <title>iFly Minsk - Редактировать аккаунт</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
@endsection

@section('content')
    <edit-customer-component :catalog="{{$data}}"></edit-customer-component>
@endsection
