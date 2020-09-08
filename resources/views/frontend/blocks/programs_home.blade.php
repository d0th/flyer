<section class="programs__home">
    <div class="container">
        <div class="row">
            @if(Session::get('locale') == "en")
            <h2 class="title">Flight programs</h2>
            @else
            <h2 class="title">Программы полётов</h2>
            @endif
        </div>
    </div>
    <div class="container programs__wrapper">
        <div class="row programs__nav">				
                <ul id="programs-list" class="programs__list slider">
                    @foreach ($programs as $key=>$item)
                    <li class="programs__item" style="background-image : url(/storage/{{$programs_preview_array[$key][0]}}/{{$programs_preview_array[$key][1]}}/{{$programs_preview_array[$key][2]}})">
                        <a class="programs__link" href="{{$item->slug}}">
                            <div class="wrap__title">
                                <h3 class="programs__title">{{$item->title}}</h3>									
                                <span class="programs__description">{{$item->preview_description}}</span>
                            </div>
                            <span class="programs__wrapBtn">
                                @if(Session::get('locale') == "en")
                                <span class="programs__btn btn">more details</span>
                                @else
                                <span class="programs__btn btn">подробнее</span>
                                @endif
                            </span>
                            <span class="programs__order">{{$item->price}}</span>
                        </a>
                    </li>
                    @endforeach
                    @if(Session::get('locale') == "en")
                    <li class="programs__item item06">
                        <a class="programs__link" href="https://shop.iflyminsk.by/index.php?ctrl=do&do=setLang&lang=en">
                            <div class="wrap__title">
                                <h3 class="programs__title">All programs</h3>
                                <span class="programs__description"></span>
                            </div>
                            <span class="programs__wrapBtn">
                                <span class="programs__btn btn">more details</span>
                            </span>
                        </a>
                    </li>
                    @else
                    <li class="programs__item item06">
                        <a class="programs__link" href="https://shop.iflyminsk.by/index.php?ctrl=do&do=setLang&lang=ru">
                            <div class="wrap__title">
                                <h3 class="programs__title">Все программы</h3>
                                <span class="programs__description"></span>
                            </div>
                            <span class="programs__wrapBtn">
                                <span class="programs__btn btn">подробнее</span>
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
                <div class="programs__counter slider__counter"></div>
        </div>
    </div>
</section>    