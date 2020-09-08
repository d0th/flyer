@extends('layouts.app')

{{--
@section('metatags')
    <title>{{$content[0]->ceo_title}}</title>
    <meta name="description" content="{{$content[0]->ceo_description}}" />
    <meta name="keywords" content="{{$content[0]->ceo_keywords}}" />
@endsection
--}}

@section('content')
    <main id="corporate">
        <div class="corporate">
            <section class="corporate__banner h600" style="background-image: url({{asset('/storage/' . str_replace('\\', '/', $sportsman_tariff->banner))}});">
                <div class="container container__breadcrumb">
                    <div class="row">
                        <nav aria-label="breadcrumb" class="nav__breadcrumb">
                            <ol class="breadcrumb">
                                @if(Session::get('locale') == "en")
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                @else
                                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                                @endif
                                <li class="breadcrumb-item active" aria-current="page">{{$sportsman_tariff->title}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="container">
                    <div class="row fd-c">
                        <div class="corporate__caption block-center">
                            <h2 class="corporate__title text-center fs-54">{{$sportsman_tariff->title_on_banner}}</h2>
                            <p class="corporate__text text-center">
                                {{$sportsman_tariff->preview_description}}
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

       <section class="parties pt-40">
            <div class="container">
                <div class="row">
                    {!! $sportsman_tariff->description !!}
                </div>
            </div>
        </section>

        <section class="corporate__slider mt-40">
            <ul class="corporate__list">
                @empty(!json_decode($sportsman_tariff->slider))
                    @foreach(json_decode($sportsman_tariff->slider) as $slide)
                        <li class="corporate__slider-item">
                            <img class="slider__img" src={{asset('/storage/' . $slide)}} alt="">
                        </li>
                    @endforeach
                @endempty
            </ul>
        </section>

<section class="parties">
<div class="container">
    <div class="parties__title text-center mb-1rem">
        <strong>
            <span class="title-price">Летайте в iFly Minsk по самым выгодным ценами в Европе</span>
        </strong>
    </div>
    <div class="row">
        {!! $sportsman_tariff->table  !!}
    </div>
</div>
</section>

</main>

@endsection






