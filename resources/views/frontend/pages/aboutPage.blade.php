@extends('layouts.app')

@section('metatags')
<title>{{$content[0]->ceo_title}}</title>
<meta name="description" content="{{$content[0]->ceo_description}}" />
<meta name="keywords" content="{{$content[0]->ceo_keywords}}" />
@endsection

@section('content')
<main>

<div class="advantages__home about_us">
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

        <ul id="advantages-list-about_us" class="advantages__list slider abaut_us_container">
          @foreach ($about_array as $key=>$item)
              <li class="advantages__item" style="background-image : url(/storage/{{$array_images[$key][0]}}/{{$array_images[$key][1]}}/{{$array_images[$key][2]}})">
                  <div class="container">
                      <div class="row">
                          <div class="advantages__caption">
                              <h2 class="advantages__title">{{$item->title}}</h2>
                              {!! $item->description !!}
                          </div>
                      </div>
                  </div>
              </li>
            @endforeach
        </ul>
    </div>
</main>
@endsection    
