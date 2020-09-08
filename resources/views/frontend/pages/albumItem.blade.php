@extends('layouts.app')

@section('metatags')
<title>{{$media->ceo_title}}</title>
<meta name="description" content="{{$media->ceo_description}}" />
<meta name="keywords" content="{{$media->ceo_keywords}}" />
@endsection


@section('content')
<main class="main__gallery main__news">
    <div class="container container__breadcrumb">
        <div class="row">
          <nav aria-label="breadcrumb" class="nav__breadcrumb">
            <ol class="breadcrumb">
				@if(Session::get('locale') == "en")
				<li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/media">Photo and video</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$media->preview_description}}</li>
				@else
				<li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item"><a href="/media">Фото и видео</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$media->preview_description}}</li>
				@endif
            </ol>
          </nav>
        </div>
    </div>

    <section class="gallery">
		<media-component :locale="{{json_encode(Session::get('locale'))}}" :media="{{json_encode($media)}}"></media-component>
    </section>
</main>
@endsection
