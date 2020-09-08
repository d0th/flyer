@extends('layouts.app')

@section('metatags')
<title>{{$content[0]->ceo_title}}</title>
<meta name="description" content="{{$content[0]->ceo_description}}" />
<meta name="keywords" content="{{$content[0]->ceo_keywords}}" />
@endsection

@section('content')
<main id="corporate">

    <div class="corporate">
        <section class="corporate__banner" style="background-image: url({{asset('/storage/' . str_replace('\\', '/', $content[0]->banner))}});">
            <div class="container container__breadcrumb">
                <div class="row">
                    <nav aria-label="breadcrumb" class="nav__breadcrumb">
                        <ol class="breadcrumb">
                            @if(Session::get('locale') == "en")
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                            @else
                                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                            @endif
                            <li class="breadcrumb-item active" aria-current="page">{{$content[0]->title}}</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="container">
                <div class="row fd-c">
                    <div class="corporate__caption">
                        <h2 class="corporate__title">Корпоративы в аэротрубе</h2>
                        <p class="corporate__text">
                            {{$content[0]->preview_description}}
                        </p>
                    </div>
                    <div class="corporate__btn">
                        <div class="wrap-btn">
                            @if(Session::get('locale') == "en")
                                <a class="btn-hover corporate__btn white btn color-red border-red arrow-white want_write corporate__anchor" href="#corporate__form">Submit a request</a>
                            @else
                                <a class="btn-hover corporate__btn white btn color-red border-red arrow-white want_write corporate__anchor" href="#corporate__form">Оставить заявку</a>
                            @endif
                        </div>
                        <div class="wrap-btn">
                            @if(Session::get('locale') == "en")
                                @if($content[0]->file_url)
                                    <a class="btn-hover corporate__btn btn want_write" target="_blank" href="{{$content[0]->file_url}}">Download the offer</a>
                                @endif
                            @else
                                @if($content[0]->file_url)
                                    <a class="btn-hover btn" target="_blank" href="{{$content[0]->file_url}}">Скачать предложение</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

      <section class="parties pt-40">
        <div class="container">
          <div class="parties__title text-center">
              <h2 class="title__bold">Корпоративные праздники в iFLY Minsk</h2>
          </div>
          <div class="row">
            {!! $content[0]->description !!}
          </div>
        </div>
      </section>

    <section class="corporate__slider">
        <ul class="corporate__list">
            @foreach(json_decode($content[0]->slider) as $slide)
                <li class="corporate__slider-item">
                    <img class="slider__img" src={{asset('/storage/' . $slide)}} alt="">
                </li>
            @endforeach
        </ul>
    </section>

    <section class="media_video pt-40 pb-0 video__center">
        <div class="container">
            <div class="row new__content">
                <div class="new__text" style="width: 100%;">
                    <iframe src="{{$content[0]->video}}" frameborder="0" allowfullscreen="allowfullscreen" width="100%" class="video_pages">

                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <section id="corporate__form" class="corporate__form bg-gray pt-60 pb-60">
        @include('.frontend.blocks.form_callback_corporate')
    </section>

    <section id="corporate__map" class="corporate__map contacts" style="margin: 0">
        <div class="container">
            @include('.frontend.blocks.contacts')
        </div>
    </section>
</main>

@endsection




