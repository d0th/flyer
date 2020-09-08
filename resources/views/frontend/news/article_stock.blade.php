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
                  <li class="breadcrumb-item"><a href="/">Stocks</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{$article[0]->title}}</li>
                  @else
                  <li class="breadcrumb-item"><a href="/">Главная</a></li>
                  <li class="breadcrumb-item"><a href="/">Акции</a></li>
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
            <a href="/" class="new__btn">
            @if(Session::get('locale') == "en") Stocks @else Акции @endif
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
      @if(!empty($slider_array))
      <section class="new__slider">
        <div class="container">
          <div class="row">
            <ul class="slider newpost-slider pagin-number">
              @foreach ($slider_array as $key=>$item)
                <li class="new__item"><img src="/storage/{{$item}}" alt="{{$article[0]->title}}"></li>
              @endforeach
            </ul>
            <div class="new__counter newpost_counter slider__counter"></div>
            <!-- <span class="pagingInfo"></span> -->
          </div>
        </div>
      </section>
      @endif
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
    </main>
@endsection        

