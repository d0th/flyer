@extends('layouts.app')

@section('metatags')
<title>{{$content[0]->ceo_title}}</title>
<meta name="description" content="{{$content[0]->ceo_description}}" />
<meta name="keywords" content="{{$content[0]->ceo_keywords}}" />
@endsection

@section('content')

<main class="main__history">
    <section class="history__banner" style="background-image : url(/storage/{{$content_image[0]}}/{{$content_image[1]}}/{{$content_image[2]}})">
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
            <div class="row">
            <h1 class="title">{{$content[0]->title}}</h1>
            </div>
            <div class="row">
            <ul class="slider history-slide">
                @foreach ($history_array as $key=>$item)
                    <li class="history__caption">
                    <span  class="history__date">{{$item->number}}</span>
                    <p class="history__text">{{$item->description}}</p>
                    </li>
                @endforeach
            </ul>
            </div>
            
        </div>
    </section>
</main>
@endsection        
