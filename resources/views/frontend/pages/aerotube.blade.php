@extends('layouts.app')

{{--@section('metatags')
    <title>{{$aerotube_sports->ceo_title}}</title>
    <meta name="description" content="{{$aerotube_sports->ceo_description}}" />
    <meta name="keywords" content="{{$aerotube_sports->ceo_keywords}}" />
@endsection--}}

<style>
    .block-icon::before {
        background: url({{asset('/storage/' . str_replace('\\', '/', $aerotube_sports->icon))}}) !important
    }

    .header__link::before {
        top: 8px !important
    }
</style>

@section('content')
    <main id="corporate">



        <div class="corporate">
            <section class="corporate__banner" style="background-image: url({{asset('/storage/' . str_replace('\\', '/', $aerotube_sports->banner))}});">
                <div class="container container__breadcrumb">
                    <div class="row">
                        <nav aria-label="breadcrumb" class="nav__breadcrumb">
                            <ol class="breadcrumb">
                                @if(Session::get('locale') == "en")
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                @else
                                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                                @endif
                                <li class="breadcrumb-item active" aria-current="page">{{$aerotube_sports->title}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="container">
                    <div class="row fd-c">
                        <div class="corporate__caption">
                            <h2 class="corporate__title">{{$aerotube_sports->title}}</h2>
                            <p class="corporate__text">
                                {{$aerotube_sports->preview_description}}
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section class="parties business aero pt-40" >
            <div class="container">
                <div class="row">
                    {!! $aerotube_sports->description !!}
                </div>
            </div>
        </section>
    </main>

@endsection




