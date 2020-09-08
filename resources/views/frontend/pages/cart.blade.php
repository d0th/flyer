@extends('layouts.app')

{{--@section('metatags')
    <title>{{$content[0]->ceo_title}}</title>
    <meta name="description" content="{{$content[0]->ceo_description}}" />
    <meta name="keywords" content="{{$content[0]->ceo_keywords}}" />
@endsection--}}

@section('content')
    <cart-component></cart-component>
@endsection
