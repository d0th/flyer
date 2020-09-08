@extends('layouts.app')

@section('metatags')
    <title>iFly Minsk - Редактировать аккаунт</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <booking-voucher-component :vouchers="{{$data}}"></booking-voucher-component>
@endsection
