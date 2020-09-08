<footer>
    <div class="footer__logo container">
        <div class="row">
            <a class="footer__link" href="/"><img src="{{asset("/img/_src/logo-footer.png")}}" alt="iFly"/></a>
        </div>
    </div>
        <div class="container">
            <nav class="footer__nav row">
            @if(Session::get('locale') == 'en')
            <ul class="footer__list">
                <li class="footer__item">
                <a class="footer__link" href="/programs-poletov">FLIGHT PACKAGES</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="/podarochnii-sertifikat">Gift Cards</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" id="akcii_block_footer" href="/news">SPECIAL OFFERS</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="/contacts">CONTACTS</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="/faq">FAQ</a>
                </li>
            </ul>
            <ul class="footer__list">
                <li class="footer__item">
                <a class="footer__link" href="/about-us">HISTORY IFLY</a>
                <!-- <a class="footer__link" href="/history">HISTORY IFLY</a> -->
                </li>
                <li class="footer__item">
                <a class="footer__link" href="https://palazzo.by/">SEC PALAZZO</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="/">FOR PRESS</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="/">PARTNERS</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="/vacancies">VACANCIES</a>
                </li>
            </ul>
            @else
            <ul class="footer__list">
                <li class="footer__item">
                <a class="footer__link" href="/programs-poletov">Программы полетов</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="/podarochnii-sertifikat">Подарочный сертификат</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" id="akcii_block_footer" href="/news">Специальные предложения</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="/contacts">Контакты</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="/faq">FAQ</a>
                </li>
            </ul>
            <ul class="footer__list">
                <li class="footer__item">
                <!-- <a class="footer__link" href="/history">История iFLY</a> -->
                <a class="footer__link" href="/about-us">История iFLY</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="https://palazzo.by/">ТРЦ Palazzo</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="/">Для прессы</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="/">Партнерам</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="/vacancies">Вакансии</a>
                </li>
            </ul>
            @endif
            <ul class="footer__list law">
            @if(Session::get('locale') == 'en')
                <li class="footer__item">
                <a class="footer__link" target="_blank" href="/storage/{{setting('site.public_offer')}}">Public offer</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="/">Legal information</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="/zakaz-poleta">How to order a flight</a>
                </li>
            @else
                <li class="footer__item">
                <a class="footer__link" target="_blank" href="/storage/{{setting('site.public_offer')}}">Публичная оферта</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="/">Юридическая информация</a>
                </li>
                <li class="footer__item">
                <a class="footer__link" href="/zakaz-poleta">Как оформить полет</a>
                </li>
            @endif
                <li class="footer__item">
                    <ul class="footer__sublist">
                        <li class="footer__item">
                            <a class="footer__link" href="https://www.instagram.com/ifly.minsk/">
                                <img
                                    class="footer__img"
                                    src="{{asset("/img/_src/instagram.svg")}}"
                                    alt="Мы в инстаграм"
                                />
                            </a>
                        </li>
                        <li class="footer__item">
                        <a class="footer__link" href="https://web.facebook.com/iFLYMinsk"
                            ><img
                            class="footer__img"
                            src="{{asset("/img/_src/Facebook.svg")}}"
                            alt="Мы в фэйсбук"
                        /></a>
                        </li>
                        <li class="footer__item">
                        <a class="footer__link" href="https://www.youtube.com/"
                            ><img
                            class="footer__img"
                            src="{{asset("/img/_src/youtube.svg")}}"
                            alt="Мы в ютуб"
                        /></a>
                        </li>
                    </ul>
                </li>
            </ul>
            </nav>
        </div>
        <div class="container">
            <div class="footer__bottom  row">
            <span class="footer__copiryte">
            @if(Session::get('locale') == 'en')
                <span class="footer__description"><script>document.write(new Date().getFullYear());</script> &#169; iFLY.</span>
                <span class="footer__description">All rights reserved.</span><br><br>
                <span class="footer__description">JLLC BelMartPlaza<br>Republic of Belarus, Minsk, st. Timiryazev, 67,<br>office 1702, UNP 191305848</span>
            @else
                <span class="footer__description"><script>document.write(new Date().getFullYear());</script> &#169; iFLY.</span>
                <span class="footer__description">Все права защищены.</span><br><br>
                <span class="footer__description">СООО «БелМартПлаза»<br>Республика Беларусь, г. Минск, ул. Тимирязева, 67,<br>офис 1702, УНП 191305848</span>
            @endif
            </span>
            <span><img class="footer__img" src="{{asset("/img/_src/logos.png")}}" /></span>
            @if(Session::get('locale') == 'en')
            <span>Website Developer <a href="https://gik.by/" target="_blanck">- Gik-Media</a></span>
            @else
            <span>Разработчик сайта <a href="https://gik.by/" target="_blanck">- Gik-Media</a></span>
            @endif

            </div>
        </div>
</footer>
