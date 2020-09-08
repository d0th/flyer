@extends('layouts.app')

@section('metatags')
<title>{{$content[0]->ceo_title}}</title>
<meta name="description" content="{{$content[0]->ceo_description}}" />
<meta name="keywords" content="{{$content[0]->ceo_keywords}}" />
@endsection

@section('content')
<main>
    
    <section class="flight__top">
        <div class="container container__breadcrumb">
          <div class="row">
            <nav aria-label="breadcrumb" class="nav__breadcrumb">
              <ol class="breadcrumb">
                  @if(Session::get('locale') == 'en')
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Gift Cards</li>
                  @else
                  <li class="breadcrumb-item"><a href="/">Главная</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Подарочный сертификат</li>
                  @endif
              </ol>
            </nav>
          </div>
        </div>        
      </section>
      <section class="certificte">
        <div class="container">
          <div class="row top">
            <div class="top__left">
              <h1 class="title">{{$content[0]->title}}</h1>
              <img class="bannersmall" src="/storage/{{$content[0]->banner}}" alt="{{$content[0]->title}}">
              <p class="description">{{$content[0]->description}}</p>
              <div class="wrap__btnGroup">
                  @if(Session::get('locale') == 'en')
                  <a href="https://shop.iflyminsk.by/index.php?ctrl=do&do=setLang&lang=en" class="btn btn__checkout">To issue a certificate</a>
                  <p class="description__if">Already have a certificate? Use it!</p>
                  <a href="https://shop.iflyminsk.by/index.php?ctrl=do&do=setLang&lang=en&goto=store_3" class="btn btn__use">Use</a>
                  @else
                  <a href="https://shop.iflyminsk.by/index.php?ctrl=do&do=setLang&lang=ru" class="btn btn__checkout">Оформить сертификат</a>
                  <p class="description__if">У Вас уже есть сертификат? Используйте его!</p>
                  <a href="https://shop.iflyminsk.by/index.php?ctrl=do&do=setLang&lang=ru&goto=store_3" class="btn btn__use">Использовать</a>
                  @endif
              </div>
            </div>
            <div class="top__right">
              <img src="/storage/{{$content[0]->banner}}" alt="{{$content[0]->title}}">
            </div>            
          </div>
        </div>
      </section>

      @include('.frontend.blocks.programs_home')
</main>
@endsection        
