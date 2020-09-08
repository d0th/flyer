@extends('layouts.app')

@section('metatags')
    <title>{{$sportsman_page->ceo_title}}</title>
    <meta name="description" content="{{$sportsman_page->ceo_description}}" />
    <meta name="keywords" content="{{$sportsman_page->ceo_keywords}}" />
@endsection

@section('content')
    <main id="corporate">
        <section class="parties pt-40">
            <div class="container">
                <div class="row">
                    {!! $sportsman_page->description !!}
                </div>
            </div>
        </section>

        <section class="corporate__slider pt-40">
            <ul class="corporate__list">
                @empty(!json_decode($sportsman_page->slider))
                    @foreach(json_decode($sportsman_page->slider) as $slide)
                        <li class="corporate__slider-item">
                            <img class="slider__img" src={{asset('/storage/' . $slide)}} alt="">
                        </li>
                    @endforeach
                @endempty
            </ul>
        </section>
    </main>
@endsection

