@extends('layouts.app')

@section('metatags')
<title>{{$content[0]->ceo_title}}</title>
<meta name="description" content="{{$content[0]->ceo_description}}" />
<meta name="keywords" content="{{$content[0]->ceo_keywords}}" />
@endsection

@section('content')
<main>
    
    <section class="new__top" style="background: inherit;">
        <div class="container container__breadcrumb">
          <div class="row">
            <nav aria-label="breadcrumb" class="nav__breadcrumb">
              <ol class="breadcrumb">
                @if(Session::get('locale') == 'en')
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                @else
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                @endif
                <li class="breadcrumb-item active">
                  <a href="/zakaz-poleta">{{$content[0]->title}}</a>
                </li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <h1 class="title">{{$content[0]->title}}</h1>
          </div>
        </div>
      </section>
      <section class="new">
        <div class="container">
          <div class="row new__content">
            <div class="new__text">
              {!!$content[0]->description!!}
            </div>
          </div>
        </div>
      </section>
</main>
@endsection        
