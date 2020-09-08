@extends('layouts.app')

@section('metatags')
    <title>Войти — iFLY Minsk | Аэродинамическая труба в Минске</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
@endsection

@push('cssVue')
@endpush

@section('content')
    <form method="post" action="/login">
        {{ csrf_field()  }}
        <input type="email" placeholder="Email" name="email" value=""><br>
        <input type="password" placeholder="Пароль" name="password" value=""><br><br>
        <input type="submit" value="Войти">
    </form>
@endsection

@push('scripts')
@endpush
