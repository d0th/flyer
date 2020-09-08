@extends('layouts.app')

@section('metatags')
    <title>iFly Minsk - Мой аккаунт</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
@endsection

@section('content')
    <customer-account-component :user="{{$data_user}}" :bookings="{{$data_bookings}}" :vouchers="{{$data_vouchers​}}"></booking-component>
@endsection
