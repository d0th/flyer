@extends('layouts.app')

@section('metatags')
<title>{{$home_data[0]->ceo_title}}</title>
<meta name="description" content="{{$home_data[0]->ceo_description}}" />
<meta name="keywords" content="{{$home_data[0]->ceo_keywords}}" />
@endsection

@section('content')
<main class="home">

    <section class="carousel__baner">
        <div id="carouselHome" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="carousel-img d-block w-100" src="/storage/{{$home_data[0]->head_banner}}" alt="Первый слайд">
                    <div class="container">
                        <div class="carousel-caption">
                            <h3 class="carousel-title">{{$home_data[0]->head_banner_text}}</h3>
                            <p class="carousel-text">{{$home_data[0]->head_banner_description}}</p>
							@if(Session::get('locale') == 'en')
                            <a class="carousel-link btn btn-hover" href="https://shop.iflyminsk.by/index.php?ctrl=do&do=setLang&lang=en">Book now</a>
							@else
                            <a class="carousel-link btn btn-hover" href="https://shop.iflyminsk.by/index.php?ctrl=do&do=setLang&lang=ru">Забронировать</a>
							@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('.frontend.blocks.programs_home')

    <div class="advantages__home">
        <ul id="advantages-list" class="advantages__list slider">
            @foreach ($advantages as $key=>$item)
                <li class="advantages__item" style="background-image : url(/storage/{{$new_array_advantages[$key][0]}}/{{$new_array_advantages[$key][1]}}/{{$new_array_advantages[$key][2]}})">
                    <div class="container">
                        <div class="row">
                            <div class="advantages__caption">
                            @php $key++ @endphp
                                <span class="advantages__count"><img src="img/_src/advantages0{{$key}}.png" alt="0{{$key}}"></span>
                                <h2 class="advantages__title">{{$item->title}}</h2>
                                <p class="advantages__text">{{$item->description}}</p>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    @include('.frontend.blocks.stocks_home')

    <section class="order__home" style="background-image : url(/storage/{{$banner_sertificat[0]}}/{{$banner_sertificat[1]}}/{{$banner_sertificat[2]}})">
        <div class="container">
            <div class="order__caption row">
                <h2 class="title">{{$home_data[0]->banner_sertificat_text}}</h2>
                <form class="certificate__form" action="/claim_voucher_code" method="post">
                    {{ csrf_field() }}
                    <label for="certificate" >

                        @if(Session::get('locale') == 'en')
                            <input name="certificate" type="text" placeholder="Gift voucher code">
                        @else
                            <input name="certificate" type="text" placeholder="Введите номер сертификата">
                        @endif

					</label>
                    @if(Session::get('locale') == 'en')
                        <button type="submit" class="order__btn btn btn-hover">fly</button>
                    @else
                        <button type="submit" class="order__btn btn btn-hover">полетели</button>
					@endif
                </form>
            </div>
        </div>
	</section>

	@include('.frontend.blocks.soc_seti_home')

    <section class="contacts__home">
        @include('.frontend.blocks.contacts')
    </section>

    <div class="overlay"></div>

</main>
@endsection


