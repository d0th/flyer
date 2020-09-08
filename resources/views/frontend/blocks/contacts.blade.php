
	{!! $contacts[0]->info !!}

    <div>
        <div class="contacts__caption-block">
            <div class="contacts__caption">
                <h3 class="subTitle">Адрес:</h3>
                <p class="contacts__address">г. Минск, Тимирязева 74А<br>ТРЦ «Palazzo»</p>
                <ul class="contacts__list">
                    <li class="contacts__item"><a href="tel:+375257776655" class="contacts__phone">+375 25 777 66 55</a></li>
                    <li class="contacts__item"><a href="mailto:info@iflyminsk.by" class="contacts__phone  contacts__phone_email">info@iflyminsk.by</a></li>
                </ul> <h3 class="subTitle">Режим работы:</h3>
                <ul class="contacts__list mode">
                    <li class="contacts__item">
                        <span class="contacts__info">Пн-Вс: 10:00-22:00</span>
                    </li>
                    <li class="contacts__item">
                        <span class="contacts__info">Без выходных</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@push('scripts')
@if(Session::get('locale') == "en")
<script src="https://api-maps.yandex.ru/2.1/?lang=en_RU"></script>
@else
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
@endif

<script>
  $(document).ready(function(){
  if ( $( "#contacts__map" ).length ) {

    //yandex maps
var myMap;

// Дождёмся загрузки API и готовности DOM.
ymaps.ready(init);

function init () {
    // Создание экземпляра карты и его привязка к контейнеру с
    // заданным id ("map").
    myMap = new ymaps.Map('contacts__map', {
        // При инициализации карты обязательно нужно указать
        // её центр и коэффициент масштабирования.
        center: [53.926980, 27.509715], //
        zoom: 16,
        controls: []
    }, {
        searchControlProvider: 'yandex#search'
    });
    // Создаём макет содержимого.
        MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
            '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
        ),

              myPlacemarkWithContent = new ymaps.Placemark([53.926980, 27.509715], {
                  hintContent: '',
                  balloonContent: '',
                  iconContent: ''
              }, {
                // Опции.
                //Необходимо указать данный тип макета.
                iconLayout: 'default#imageWithContent',
                // Своё изображение иконки метки.
                iconImageHref: '../img/_src/icon-map.svg',
                // Размеры метки.
                iconImageSize: [60, 84],
                // Смещение левого верхнего угла иконки относительно
                // её "ножки" (точки привязки).
                iconImageOffset: [-60, -84],
                // Смещение слоя с содержимым относительно слоя с картинкой.
                iconContentOffset: [0, 0],
                // Макет содержимого.
                iconContentLayout: MyIconContentLayout
            });

              myMap.geoObjects
                  .add(myPlacemarkWithContent);
              myMap.behaviors.disable('scrollZoom');



    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    //... отключаем перетаскивание карты
    myMap.behaviors.disable('drag');
    }

   }
}
});
</script>
@endpush
