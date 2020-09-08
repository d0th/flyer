@extends('layouts.app')

@section('metatags')
<title>{{$content[0]->ceo_title}}</title>
<meta name="description" content="{{$content[0]->ceo_description}}" />
<meta name="keywords" content="{{$content[0]->ceo_keywords}}" />
@endsection

@section('content')
<main class="main__vacancies">

    @include('.frontend.blocks.form_callback')
    
    <section class="vacancies__banner" style="background-image : url(/storage/{{$content_image[0]}}/{{$content_image[1]}}/{{$content_image[2]}})">
        <div class="container container__breadcrumb">
          <div class="row">
            <nav aria-label="breadcrumb" class="nav__breadcrumb">
              <ol class="breadcrumb">
                @if(Session::get('locale') == 'en')
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                @else
                  <li class="breadcrumb-item"><a href="/">Главная</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">
                {{$content[0]->title}}
                </li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="container">
          <div class="row vacancies__caption">
            <h1 class="title">{{$content[0]->title}}</h1>
            <p class="text">{{$content[0]->preview_description}}</p>
            <a href="#vacancies__block" class="vacancies__btn banner_btn btn">
              @if(Session::get('locale') == 'en')
                See all jobs
              @else
                Смотреть все вакансии
              @endif
              <span class="vacancies__counter">@php echo count($vacancies) @endphp</span>
            </a>
          </div>
        </div>
    </section>
    <section class="vacancies" id="vacancies__block">        
        <div class="container">
          <div class="row">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @if(count($vacancies) == 0)
              <div class="panel panel-default">

                @if(Session::get('locale') == 'en')
                  <p class="text">No current vacancies</p>
                @else
                  <p class="text">Нет текущих вакансий</p>
                @endif
              
              </div>
            @else
              @foreach ($vacancies as $key=>$item)
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="heading1">
                      <h3 class="panel-title">{{$item->title}}</h3>
                      <span class="panel-description active-desc">{{$item->preview_description}}</span>
                      @php $key++ @endphp
                      <div id="collapse{{$key}}" class="panel-collapse collapse vacancies__body" data-parent="#accordion" role="tabpanel" aria-labelledby="heading{{$key}}" >
                      <span class="panel-description active-mobile">{{$item->preview_description}}</span>
                        {!!$item->description!!}
                        @if(Session::get('locale') == "en")
                        <a href="#" class="panel-link btn register btn-mobile">Connect with us</a>
                        @else
                        <a href="#" class="panel-link btn register btn-mobile">Связаться с нами</a>
                        @endif
                      </div>
                      <div class="vacancies__btnWrap">
                        @if(Session::get('locale') == "en")
                        <a href="#" class="panel-link btn register">Connect with us</a>
                        @else
                        <a href="#" class="panel-link btn register">Связаться с нами</a>
                        @endif
                        
                        <div class="vacancies__btnContainer">
                          <a class="vacancies__btn collapsed" role="button" data-toggle="collapse"  href="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
                            <span class="wrap">
                              <span class="value">
                                @if(Session::get('locale') == "en")
                                <span class="disabled">More details</span>
                                <span class="active">Collapse</span>
                                @else
                                <span class="disabled">Подробнее</span>
                                <span class="active">Свернуть</span>
                                @endif
                              </span>
                              <span class="btn__icon"><span class="btn__line"></span></span>
                            </span>
                          </a>
                        </div>
                      </div>
                  </div>              
                </div> 
              @endforeach 
            @endif 
          </div>
        </div>
        </div>
    </section>
</main>
@endsection        
