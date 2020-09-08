
    @foreach($items as $item)
    <li class="header__item"><a class="header__subLink" href="{{ url("/sportsman/{$item->url}") }}">{{$item->title}}</a></li>
    @endforeach
