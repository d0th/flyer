<div class="new__social">
    <span class="new__subtitle">@if(Session::get('locale') == "en") Share @else Поделиться @endif:</span>
    <ul class="new__list">
        <li class="new__item">
        <a class="new__link" href="https://www.facebook.com/sharer.php?src=sp&u=https%3A%2F%2Fiflyminsk.by%2Fnews%2F{{$article[0]->slug}}&title=iFly&utm_source=share2"
            ><img
            class="new__icon"
            src="{{asset("/img/_src/FacebookBlack.svg")}}"
            alt="Мы в фэйсбук"
        /></a>
        </li>
        <li class="new__item">
        <a class="new__link" href="https://vk.com/share.php?url=https%3A%2F%2Fiflyminsk.by%2Fnews%2F{{$article[0]->slug}}&title=iFly&utm_source=share2"
            ><img
            class="new__icon"
            src="{{asset("/img/_src/VkBlack.svg")}}"
            alt="Мы в контакте"
        /></a>
        </li>
        <!-- <li class="new__item">
        <a class="new__link" href=""
            ><img
            class="new__icon"
            src="{{asset("/img/_src/instagramBlack.svg")}}"
            alt="Мы в инстаграм"
        /></a>
        </li> -->
        <li class="new__item">
        <a class="new__link" href="https://connect.ok.ru/offer?url=https%3A%2F%2Fiflyminsk.by%2Fnews%2F{{$article[0]->slug}}&title=iFly&utm_source=share2"
            ><img
            class="new__icon"
            src="{{asset("/img/_src/ok.svg")}}"
            alt="Мы в однаклассниках"
        /></a>
        </li>
    </ul>
</div>