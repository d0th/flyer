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
                  <a href="/how-it-works">{{$content[0]->title}}</a>
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
            <div class="new__text" style="padding: 0 0 50px;">
              {!!$content[0]->description!!}
            </div>
          </div>
        </div>
      </section>
      <section class="media_video">
        <div class="container">
          <div class="row new__content">
            <div class="new__text" style="width:100%">
            <iframe class="video_page" src="{{$content[0]->video}}" frameborder="0" allowfullscreen width="100%" height="700px"></iframe>
            </div>
          </div>
        </div>
      </section>
</main>
@endsection        
