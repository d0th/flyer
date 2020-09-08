<section class="seti__home">
        <div class="container">
            <div class="row">
                @if(Session::get('locale') == 'en')
                <h2 class="title">Social networks</h2>
                @else
                <h2 class="title">Социальные сети</h2>
                @endif
                <ul class="seti__list">
                    {{--<li class="seti__item"><a class="seti__link active" href="" id="face"><img class="seti__icon" src="img/_src/FacebookBlack.svg" alt="Мы в фэйсбук"></a></li>--}}
                    <li class="seti__item"><a class="seti__link active" href="" id="inst"><img class="seti__icon" src="img/_src/instagramBlack.svg" alt="Мы в инстаграм"></a></li>
                </ul>
            </div>
        </div>
        <div id="ul-insta" style="display: block">
            <ul id="seti-lenta" class="seti__lenta slider">
                @empty(!$inst_array)
                    @foreach ($inst_array as $key=>$item)
                        <li class="seti__item">
                            <a class="seti__description_btn" href="{{$item->link}}">
                                <div class="seti__itemWrap">
                                <!-- <div class="seti__top">
                                    <div class="seti__topLogo">
                                        <img class="seti__avatar" src="{{$item->user->profile_picture}}" alt="{{$item->user->username}}">
                                    </div>
                                    <div class="seti__topGroup">
                                        <span class="seti__name">{{$item->user->username}}</span>
                                        <span class="seti__time"></span>
                                    </div>
                                </div> -->
                                    <img class="seti__img" src="{{$item->images->standard_resolution->url}}" alt="instagram">
                                    <p class="seti__description">{{str_limit($item->caption->text,  135,'...')}}
                                        <a class="seti__description_btn" href="{{$item->link}}">Ещё</a>
                                    </p>
                                    <div class="seti__bottom">
                                    <span class="seti__group">
                                        <span class="seti__comment">{{$item->comments->count}}</span>
                                        <span class="seti__like">{{$item->likes->count}}</span>
                                    </span>
                                        <a class="seti__link" href="{{$item->link}}"><img class="seti__logo" src="img/_src/instagramBlack.svg" alt="instagram"></a>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                @endempty
            </ul>
            <div class="seti__counter seti__counter_inst slider__counter"></div>
        </div>
        {{--<div id="ul-face">
            <ul id="seti-lenta-facebook" class="seti__lenta slider">
                @empty(!$facebook_array)
                    @foreach ($facebook_array as $key=>$item)
                        <li class="seti__item">
                            <a class="seti__description_btn" href="https://www.facebook.com/iFLYMinsk/posts/@php echo mb_substr($item->id,-15,15) @endphp">
                                <div class="seti__itemWrap">
                                    @if (!empty($item->full_picture))
                                        <img class="seti__img" src="{{$item->full_picture}}" alt="facebook">
                                    @endif
                                    @if (!empty($item->message))
                                        <p class="seti__description">{{str_limit($item->message,  135,'...')}}
                                            <a class="seti__description_btn" href="https://www.facebook.com/iFLYMinsk/posts/@php echo mb_substr($item->id,-15,15) @endphp">Ещё</a>
                                        </p>
                                    @endif
                                    <div class="seti__bottom">
                                <span class="seti__group">
                                    @if (!empty($item->comments))
                                        <span class="seti__comment">@php echo count($item->comments->data) @endphp</span>
                                    @endif
                                    @if (!empty($item->likes))
                                        <span class="seti__like">@php echo count($item->likes->data) @endphp</span>
                                    @endif
                                </span>
                                        <a class="seti__link" href="https://www.facebook.com/iFLYMinsk/posts/@php echo mb_substr($item->id,-15,15) @endphp"><img class="seti__logo" src="img/_src/FacebookBlack.svg" alt="facebook"></a>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                @endempty
            </ul>
            <div class="seti__counter_facebook slider__counter seti__counter"></div>
        </div>--}}
</section>
