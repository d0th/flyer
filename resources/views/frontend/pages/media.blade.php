@extends('layouts.app')

@section('metatags')
<title>{{$content[0]->ceo_title}}</title>
<meta name="description" content="{{$content[0]->ceo_description}}" />
<meta name="keywords" content="{{$content[0]->ceo_keywords}}" />
@endsection


@section('content')
<main class="main__gallery main__news">
    <div class="container container__breadcrumb">
        <div class="row">
          <nav aria-label="breadcrumb" class="nav__breadcrumb">
            <ol class="breadcrumb">
				@if(Session::get('locale') == "en")
				<li class="breadcrumb-item"><a href="/">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Photo and video</li>
				@else
				<li class="breadcrumb-item"><a href="/">Главная</a></li>
				<li class="breadcrumb-item active" aria-current="page">Фото и видео</li>
				@endif
            </ol>
          </nav>
        </div>
    </div>

    <section class="news">
      <div class="container">
        <div class="row">
          <ul class="news__list @if(count($albums) == 2) new_style @endif">
            @foreach ($albums as $key=>$item)
              <li class="news__item news_post date">
                <a class="news__link" href="media/{{$item->slug}}">
                  <img class="news__img" src="storage/{{$item->preview_img}}" alt="{{$item->preview_description}}"/>
                  <h3 class="news__subTitle">{{$item->preview_description}}</h3>
                  @if($item->date)
                  <span class="news__date">{{$item->date}}</span>
                  @endif
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </section>
    <!-- <section class="gallery">
		<media-component :locale="{{json_encode(Session::get('locale'))}}"></media-component>
    </section> -->
</main>
@endsection