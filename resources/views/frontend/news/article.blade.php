@extends('layouts.app')

@section('metatags')
<title>{{$article[0]->ceo_title}}</title>
<meta name="description" content="{{$article[0]->ceo_description}}" />
<meta name="keywords" content="{{$article[0]->ceo_keywords}}" />
@endsection

@section('content')
<main>

      <section class="new__top">
        <div class="container container__breadcrumb">
          <div class="row">
            <nav aria-label="breadcrumb" class="nav__breadcrumb">
              <ol class="breadcrumb">
                  @if(Session::get('locale') == "en")
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item"><a href="/news">News</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{$article[0]->title}}</li>
                  @else
                  <li class="breadcrumb-item"><a href="/">Главная</a></li>
                  <li class="breadcrumb-item"><a href="/news">Новости</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{$article[0]->title}}</li>
                  @endif
              </ol>
            </nav>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <h1 class="title">{{$article[0]->title}}</h1>
          </div>
          <div class="row new__btnWrap">
            <a href="/news" class="new__btn">
            @if(Session::get('locale') == "en") News @else Новости @endif
            </a>
            <span class="new__date">{{$article[0]->date}}</span>
          </div>
        </div>
      </section>
      <section class="new">
        <div class="container">
          <div class="row new__content">
            <img class="new__img" src="/storage/{{$article[0]->banner}}" alt="{{$article[0]->title}}" />
            <div class="new__text">
              {!! $article[0]->description_before !!}
            </div>
          </div>
        </div>
      </section>
      <section class="new__slider">
        <div class="container">
          <div class="row">
            <ul class="slider newpost-slider pagin-number">
              @foreach ($slider_array as $key=>$item)
                <li class="new__item"><img src="/storage/{{$item}}" alt="{{$article[0]->title}}"></li>
              @endforeach
            </ul>
            <div class="newpost_counter slider__counter"></div>
            <!-- <span class="pagingInfo"></span> -->
          </div>
        </div>
      </section>
      <section class="new__contentBottom">
        <div class="container">
          <div class="row">
            <div class="new__info">
            {!! $article[0]->description_after !!}

            @include('.frontend.blocks.share')

            </div>
          </div>
        </div>
      </section>
      @if(count($similar_news_array) !== 0)
      <section class="new__posts">
        <div class="container">
          <div class="row">
            <h2 class="title">Похожие новости</h2>
            <ul class="new__list new__bottom slider">
                @foreach ($similar_news_array as $key=>$item)
                  <li class="new__item">
                    <div class="new__itemContent">
                      <a class="new__link" href="/news/{{$item[0]->slug}}">
                        <img class="new__img" src="/storage/{{$item[0]->banner}}" alt="{{$item[0]->text}}"/>
                        <h3 class="new__subTitle">{{$item[0]->text}}</h3>
                        <div class="new__date">{{$item[0]->date}}</div>
                      </a>
                    </div>
                  </li>
                @endforeach
            </ul>
            <!-- <div class="new__counter slider__counter"></div> -->
          </div>
        </div>
      </section>
      @endif
    </main>
@endsection        

