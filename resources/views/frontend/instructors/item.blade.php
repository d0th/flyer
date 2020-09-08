@extends('layouts.app')

@section('metatags')
<title>{{$instructor->ceo_title}}</title>
<meta name="description" content="{{$instructor->ceo_description}}" />
<meta name="keywords" content="{{$instructor->ceo_keywords}}" />
@endsection

@section('content')
<main class="main__instructor">

    @include('.frontend.blocks.form_callback_instructors')

    <section class="instructor__banner instructors__wrap" style="background-image : url(/storage/{{$instructor_banner[0]}}/{{$instructor_banner[1]}}/{{$instructor_banner[2]}})">
    <div class="container container__breadcrumb">
        <div class="row">
        <nav aria-label="breadcrumb" class="nav__breadcrumb">
            <ol class="breadcrumb">
                @if(Session::get('locale') == "en")
                <li class="breadcrumb-item o-1"><a href="/">Home</a></li>
                <li class="breadcrumb-item o-1"><a href="/instructors">Instructors</a></li>
                <li class="breadcrumb-item active o-1" aria-current="page">{{$instructor->name}}</li>
                @else
                <li class="breadcrumb-item o-1"><a href="/">Главная</a></li>
                <li class="breadcrumb-item o-1"><a href="/instructors">Инструкторы</a></li>
                <li class="breadcrumb-item active o-1" aria-current="page">{{$instructor->name}}</li>
                @endif
            </ol>
        </nav>
        </div>
    </div>
    <div class="container">
        <div class="row instructor__caption">
        <h1 class="title o-1">{{$instructor->name}}</h1>
        <p class="instructor__description o-1">{{$instructor->position}}, {{$instructor->age}}</p>
        </div>
    </div>
    <div class="container">
        <div class="row instructor__counters">
        <span  class="instructor__countersWrap">
            <span  class="instructor__counterWrap">
            <span class="instructor__counter"><span class="instructor__counterIcon">+</span>{{$instructor->number_of_jumps}}</span>
                @if(Session::get('locale') == "en")
                <span class="instructor__counterDescription o-1">Skydiving</span>
                @else
                <span class="instructor__counterDescription o-1">Прыжков с парашютом</span>
                @endif
            </span>
            <span  class="instructor__counterWrap">
            <span class="instructor__counter"><span class="instructor__counterIcon">+</span>{{$instructor->flight_hours}}</span>
                @if(Session::get('locale') == "en")
                <span class="instructor__counterDescription o-1">Hours of flying time in a wind tunnel</span>
                @else
                <span class="instructor__counterDescription o-1">Часов налёта в аэротрубе</span>
                @endif
            </span>
        </span>
            @if(Session::get('locale') == "en")
            <a href="javascript:void(0)" class="instructor__btn btn want_write btn-hove o-1r" data-id="{{$instructor->id}}">sign up</a>
            @else
            <a href="javascript:void(0)" class="instructor__btn btn want_write btn-hover o-1" data-id="{{$instructor->id}}">записаться к инструктору</a>
            @endif
        </div>
    </div>
    </section>
    <section class="info">
    <div class="container">
        <div class="row">
        <div class="instructor__description">
            @if(Session::get('locale') == "en")
            <h2 class="title">Instructor Information</h2>
            @else
            <h2 class="title">Сведения об инструкторе</h2>
            @endif

            {!!$instructor->description!!}
        </div>
        <div class="instructor__profile">
            <div class="instructor__topWrap">
            <h3 class="instructor__subTitle">{{$instructor->name}}</h3>
            <span class="instructor__feature">
                @if(Session::get('locale') == "en")
                    <span class="instructor__item">
                    <span class="instructor__title">Age</span>
                    <span class="instructor__count">{{$instructor->age}}</span>
                    </span>
                    <span class="instructor__item">
                    <span class="instructor__title">Flying hours</span>
                    <span class="instructor__count">{{$instructor->flight_hours}}</span>
                    </span>
                @else
                    <span class="instructor__item">
                    <span class="instructor__title">Возраст</span>
                    <span class="instructor__count">{{$instructor->age}}</span>
                    </span>
                    <span class="instructor__item">
                    <span class="instructor__title">Часов налёта</span>
                    <span class="instructor__count">{{$instructor->flight_hours}}</span>
                    </span>
                @endif
            </span>
            </div>
            <div class="instructor-socials">
                <div class="instructor-socials-block">
                    <ul class="instructor-socials__list">
                        @empty(!$array_socials)
                            @foreach ($array_socials as $key=>$item)
                                <li class="social-item">
                                    <a class="social__link" href="{{$item}}">
                                        <img
                                            class="social__img"
                                            src="/img/_src/{{$key}}.svg"
                                        />
                                    </a>
                                </li>
                            @endforeach
                        @endempty
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </div>
    </section>
    @empty(!$medias)
    <section class="multimedia bg-gray pt-60">
        <div class="container">
            <div class="row">
            <h2 class="title">Мультимедиа</h2>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="wrap__media">
                    @foreach ($medias as $keyArray=>$media)
                        <div class="media__row">
                            @foreach ($media as $keyValue=>$item)
                                @empty(!$item['status'])
                                    <div class="media__item {{$keyArray % 2 !== 0 ? $keyValue % 2 == 0 ? 'w66' : 'w33' : ''}} {{$keyArray % 2 == 0 ? $keyValue % 2 == 0 ? 'w33' : 'w66' : ''}}">
                                        @if(!empty(json_decode($item['file'])[0]->download_link))
                                            <div class="item__img" style="background-image: url(/storage/{{str_replace('\\', '/', json_decode($item['file'])[0]->download_link)}})">
                                            </div>
                                        @endif
                                        @empty(!$item['url_video'])
                                            <div class="item__img">
                                                <iframe src="{{$item['url_video']}}" frameborder="0" allowfullscreen="allowfullscreen" height="100%" width="100%">

                                                </iframe>
                                            </div>
                                        @endempty
                                        <div class="item__content">
                                            <p class="item__title"><b>{{$item['name']}}</b></p>
                                            {{--<p class="item__date">{{$item['created_at']}}</p>--}}
                                            <p class="item__date">{{date('d F Y', strtotime($item['created_at']))}}</p>
                                        </div>
                                    </div>
                                @endempty
                            @endforeach
                        </div>
                    @endforeach
                </div>
                {{--<button id="instructor-btn" class="instructor__btn mt-24">Показать еще</button>--}}
            </div>
        </div>
    </section>
    @endempty
    @if(count($array_review) !== 0)
        <section class="reviews bg-gray">
            <div class="container">
                <div class="row">
                @if(Session::get('locale') == "en")
                <h2 class="title">Instructor reviews</h2>
                @else
                <h2 class="title">Отзывы об инструкторе</h2>
                @endif
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="instructor__list slider reviews-slider pagin-number">
                        @foreach ($array_review as $key=>$item)
                            <div class="instructor__item">
                                <div class="instructor__itemWrap">
                                <p class="instructor__text">{{$item->description}}</p>
                                    @empty(!$item->name_persone)
                                        <span class="instructor__name">{{$item->name_persone}}</span>
                                    @endempty
                                    @empty(!$item->position_persone)
                                        <span class="instructor__description">{{$item->position_persone}}</span>
                                    @endempty
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="reviews__counter slider__counter"></div>
                    <div class="total-desc none">{{count($array_review)}}</div>
                </div>
            </div>
        </section>
    @endif
</main>
@endsection
