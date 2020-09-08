@extends('layouts.app')

@section('metatags')
<title>{{$content[0]->ceo_title}}</title>
<meta name="description" content="{{$content[0]->ceo_description}}" />
<meta name="keywords" content="{{$content[0]->ceo_keywords}}" />
@endsection

@section('content')
<main>

<section class="advantages__home what_awaits">
       <div class="container container__breadcrumb">
            <div class="row">
                <nav aria-label="breadcrumb" class="nav__breadcrumb">
                    <ol class="breadcrumb">
                        @if(Session::get('locale') == "en")
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$content[0]->title}}</li>
                        @else
                        <li class="breadcrumb-item"><a href="/">Главная</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$content[0]->title}}</li>
                        @endif
                    </ol>
                </nav>
            </div>
        </div>

        <ul id="advantages-list-waiting" class="advantages__list slider">
          @foreach ($slids_array as $key=>$item)
              <li class="advantages__item" style="background-image : url(/storage/{{$array_images[$key][0]}}/{{$array_images[$key][1]}}/{{$array_images[$key][2]}})">
                  <div class="container">
                      <div class="row">
                          <div class="advantages__caption">
                              <h2 class="advantages__title">{{$item->title}}</h2>
                              {!! $item->description !!}
                          </div>
                      </div>
                        <div class="row">
                            <div class="block-content__right">
                                @if(Session::get('locale') == "en")
                                <a class="btn btn-hover">@if($item->title == 'Step 5 - Security') To the begining @else Next step @endif</a>
                                @else
                                <a class="btn btn-hover">@if($item->title == 'Шаг 5 - Безопасность') В начало @else Следующий шаг @endif</a>
                                @endif
                            </div>
                        </div>
                  </div>
              </li>
            @endforeach
        </ul>
    </section>
</main>
@endsection
