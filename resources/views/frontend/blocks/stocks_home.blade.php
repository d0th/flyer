<section class="akcii__home">
    <div class="container">
        <div class="row">

            @if(Session::get('locale') == "en")
            <h2 class="title">Promotions for visitors</h2>
            @else
            <h2 class="title">Промоакции для посетителей</h2>
            @endif

        </div>
    </div>
    <div class="container">
        <div class="row akcii">
            <ul id="akcii-list" class="akcii__list slider">
            @foreach ($stocks as $key=>$item)
                <li class="akcii__item {{$item->sale == 1 ? 'akciiSale' : ''}} {{$item->new == 1 ? 'akciiNew' : ''}}" style="background-image : url(/storage/{{$stocks_preview_array[$key][0]}}/{{$stocks_preview_array[$key][1]}}/{{$stocks_preview_array[$key][2]}})">
                    <a class="akcii__link" href="/akcii/{{$item->slug}}">
                        <div class="wrap__title">
                            <h3 class="akcii__title">{{$item->title}}</h3>
                            <span class="akcii__description">{{$item->text}}</span>
                        </div>
                        <span class="akcii__wrapBtn">
                                @if(Session::get('locale') == "en")
                                <span class="akcii__btn btn">more details</span>
                                @else
                                <span class="akcii__btn btn">подробнее</span>
                                @endif
                        </span>
                    </a>
                </li>
            @endforeach
            </ul>	
            <div class="akcii__counter slider__counter"></div>
        </div>
    </div>
</section>	