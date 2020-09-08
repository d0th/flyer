@extends('layouts.app')

@section('metatags')
<title>{{$content[0]->ceo_title}}</title>
<meta name="description" content="{{$content[0]->ceo_description}}" />
<meta name="keywords" content="{{$content[0]->ceo_keywords}}" />
@endsection

@section('content')
<main>

    @include('.frontend.blocks.form_callback_instructors')

    <section class="insructorsPage">
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
        <div class="block-hidden">
            @foreach ($sliders as $key=>$item)
                <div class="instructor__name">
                    {{$item->name}}
                </div>
            @endforeach
        </div>
        <div class="insructors__slider" >
            <ul class="insructors__sliders slider">
                @foreach ($sliders as $key=>$item)
                    <li class="insructors__item instructors__wrap" style="background-image : url(/storage/{{$sliders_image[$key][0]}}/{{$sliders_image[$key][1]}}/{{$sliders_image[$key][2]}})">
                        <div class="container">
                            <h3 class="insructors-title" data-thumb="{{$item->name}}">{{$item->name}}</h3>
                            @if(Session::get('locale') == "en")
                            <p class="insructors-text">Flying hours: {{$item->flight_hours}}</p>
                            <a class="insructors-link btn want_write btn-hover" href="javascript:void(0)" data-id="{{$item->id}}">sign up</a>
                            @else
                            <p class="insructors-text">Часов налёта: {{$item->flight_hours}}</p>
                            <a class="insructors-link btn want_write btn-hover" href="javascript:void(0)" data-id="{{$item->id}}">записаться к инструктору</a>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    <section class="insructors">
        <div class="container">
            <div class="row">
                    @if(Session::get('locale') == "en")
                    <h2 class="title">All instructors</h2>
                    @else
                    <h2 class="title">Все инструкторы</h2>
                    @endif
            </div>
        </div>
        <div class="container">
            <ul class="insructors__list row">
                @foreach ($instructors as $key=>$item)
                    <li class="insructors__item ">
                        <div class="instructors__wrap">
                            <img class="insructors__img" src="/storage/{{$item->images}}" alt="{{$item->name}}">
                        </div>
                        <div class="insructors__profile">
                            <h3 class="insructors__subTitle">{{$item->name}}</h3>
                            <ul class="insructors__info">

                                @if(Session::get('locale') == "en")
                                    <li class="insructors__subItem">
                                        <span class="insructors__infoTitle">Age</span>
                                        <span class="insructors__counter">{{$item->age}}</span>
                                    </li>
                                    <li class="insructors__subItem">
                                        <span class="insructors__infoTitle">Flying hours</span>
                                        <span class="insructors__counter">{{$item->flight_hours}}</span>
                                    </li>
                                @else
                                    <li class="insructors__subItem">
                                        <span class="insructors__infoTitle">Возраст</span>
                                        <span class="insructors__counter">{{$item->age}}</span>
                                    </li>
                                    <li class="insructors__subItem">
                                        <span class="insructors__infoTitle">Часов налёта</span>
                                        <span class="insructors__counter">{{$item->flight_hours}}</span>
                                    </li>
                                @endif

                            </ul>
                        </div>
                        <div class="insructors__btnWrap">
                            @if(Session::get('locale') == "en")
                            <a class="insructors__btn" href="/instructors/{{$item->slug}}">View profile</a>
                            @else
                            <a class="insructors__btn" href="/instructors/{{$item->slug}}">Смотреть профайл</a>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- <div class="pagination container">
            <div class="row">
                <ul class="pagination__counter">
                <li class="pagination__item">Показано:</li>
                <li class="pagination__item number">9</li>
                <li class="pagination__item">из</li>
                <li class="pagination__item quantity">68</li>
                </ul>
                <div class="pagination__wrap">
                <ul class="pagination__list">
                    <li class="pagination__item">1</li>
                    <li class="pagination__item is-active">2</li>
                    <li class="pagination__item">...</li>
                    <li class="pagination__item">6</li>
                </ul>
                <span class="pagination__arr left"></span>
                <span class="pagination__arr right"></span>
                </div>
            </div>
        </div> -->
    </section>
</main>
@endsection
