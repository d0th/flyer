@extends('layouts.app')

@section('metatags')
    <title>{{$sportsman_page->ceo_title}}</title>
    <meta name="description" content="{{$sportsman_page->ceo_description}}" />
    <meta name="keywords" content="{{$sportsman_page->ceo_keywords}}" />
@endsection

@section('content')
    <main id="corporate">
        <div class="corporate">
            <section class="corporate__banner" style="min-height: 600px; background-image: url({{asset('/storage/' . str_replace('\\', '/', $sportsman_page->banner))}});">
                <div class="container container__breadcrumb">
                    <div class="row">
                        <nav aria-label="breadcrumb" class="nav__breadcrumb">
                            <ol class="breadcrumb">
                                @if(Session::get('locale') == "en")
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                @else
                                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                                @endif
                                <li class="breadcrumb-item active" aria-current="page">{{$sportsman_page->title}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="container">
                    <div class="row fd-c">
                        <div>
                            <h2 class="corporate__title" style="text-align: center">{{$sportsman_page->title}}</h2>
                            <p class="corporate__text" style="text-align: center">
                                {{$sportsman_page->preview_description}}
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

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

        <section id="corporate__form" class="corporate__form bg-gray pt-60 pb-60">
            @include('.frontend.blocks.form_callback_sportsman')
        </section>

    </main>
@endsection

