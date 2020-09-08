<header>
<div class="container container__header ">
	<div class="header row">
		<div class="header__logo">
			<a href="/">
				<img class="" src="{{asset("/img/_src/logo.png")}}" alt="iFly" />
			</a>
		</div>
		<nav class="header__nav">
			<ul class="header__list-nav">
				<li class="header__item">
				@if(Session::get('locale') == 'en')
				<a href="javascript:void(0)" class="header__link">Beginner</a>
					<ul class="header__subList">
						<li class="header__item"><a class="header__subLink" href="/chto-vas-jdet">What to expect</a></li>
						<li class="header__item"><a class="header__subLink" href="/programs-poletov">Flight packages</a></li>
						<li class="header__item"><a class="header__subLink" href="/podarochnii-sertifikat">Gift Cards</a></li>
						<li class="header__item"><a class="header__subLink" href="/stat-sportsmenom">Become a Proflyer</a></li>
						<li class="header__item"><a class="header__subLink" href="/faq">FAQ</a></li>
					</ul>
					@else
					<a href="javascript:void(0)" class="header__link">Новичкам</a>
					<ul class="header__subList">
						<li class="header__item"><a class="header__subLink" href="/chto-vas-jdet">Что вас ждет</a></li>
						<li class="header__item"><a class="header__subLink" href="/programs-poletov">Программы полетов</a></li>
						<li class="header__item"><a class="header__subLink" href="/podarochnii-sertifikat">Подарочный сертификат</a></li>
						<li class="header__item"><a class="header__subLink" href="/stat-sportsmenom">Стать спортсменом</a></li>
						<li class="header__item"><a class="header__subLink" href="/faq">Вопрос-ответ</a></li>
					</ul>
					@endif
				</li>
				<li class="header__item">
					@if(Session::get('locale') == 'en')
					<a href="javascript:void(0)" class="header__link">Athletes</a>

                        <? echo menu('menu_sportsman_pages') ?>

					<ul class="header__subList">
						<li class="header__item">
                            <a class="header__subLink" href="/sportsman-tariff">Rates</a>
                        </li>
						<li class="header__item"><a class="header__subLink" href="javascript:void(0)">Coaching</a></li>
						<li class="header__item"><a class="header__subLink" href="javascript:void(0)">Kids league</a></li>
						<li class="header__item"><a class="header__subLink" href="javascript:void(0)">AFF Course</a></li>
						<li class="header__item"><a class="header__subLink" href="javascript:void(0)">Facility</a></li>
						<li class="header__item"><a class="header__subLink" href="javascript:void(0)">Сamps and events</a></li>
						<li class="header__item"><a class="header__subLink" href="javascript:void(0)">Indoor Skydiving</a></li>
					</ul>
					@else
					<a href="javascript:void(0)" class="header__link">Спортсменам</a>

                        <ul class="header__subList">
                            <? echo menu('menu_sportsman_pages', '.frontend.blocks.nav') ?>
                        </ul>

					{{--<ul class="header__subList">
						<li class="header__item"><a class="header__subLink" href="/sportsman-tariff">Тарифы</a></li>
						<li class="header__item"><a class="header__subLink" href="javascript:void(0)">Коучинг</a></li>
						<li class="header__item"><a class="header__subLink" href="javascript:void(0)">Детская лига</a></li>
						<li class="header__item"><a class="header__subLink" href="javascript:void(0)">Курс AFF</a></li>
						<li class="header__item"><a class="header__subLink" href="javascript:void(0)">Возможности объекта</a></li>
						<li class="header__item"><a class="header__subLink" href="javascript:void(0)">Кэмпы и соревнования</a></li>
						<li class="header__item"><a class="header__subLink" href="javascript:void(0)">Аэротрубный спорт</a></li>
					</ul>--}}
					@endif
				</li>
				<li class="header__item">
					@if(Session::get('locale') == 'en')
					<a href="javascript:void(0)" class="header__link">Your holiday</a>
					<ul class="header__subList">
						<li class="header__item"><a class="header__subLink" href="/korporativi">Corporate events</a></li>
						<li class="header__item"><a class="header__subLink" href="/dni-rojdeniya">Birthday parties</a></li>
						<li class="header__item"><a class="header__subLink" href="/business">Business meetings</a></li>
					</ul>
					@else
					<a href="javascript:void(0)" class="header__link">Ваш праздник</a>
					<ul class="header__subList">
						<li class="header__item"><a class="header__subLink" href="/korporativi">Корпоративы</a></li>
						<li class="header__item"><a class="header__subLink" href="/dni-rojdeniya">Дни рождения</a></li>
						<li class="header__item"><a class="header__subLink" href="/business">Бизнес встречи</a></li>
					</ul>
					@endif
				</li>
			</ul>
		</nav>
		<div class="header__function">
		<a class="header__phone" href="tel:+375257776655">+375 25 777-66-55</a>
        <a class="header__cart" href="/booking">
            <div id="appCartWidget">
                <cart-widget-component></cart-widget-component>
            </div>

        </a>

		<div class="header__profile">

				@if(app()->getLocale() !== 'en')
				<a class="lang__btn" href="/lang/en">en</a>
				@else
				<a class="lang__btn" href="/lang/ru">ru</a>
				@endif

			<div class="profile__container">

                @if(Auth::user())
                    <a class="profile__containerLogo" href="{{route('customer-account')}}">
                        <img
                            class="profile__logo is-active"
                            src="{{asset("/img/_src/profileiconActive.svg")}}"
                            alt="profile icon active"
                        />
                    </a>
                @else
                    <a class="profile__containerLogo" href="{{route('login')}}">
                        <img
                            class="profile__logo is-active"
                            src="{{asset("/img/_src/profileicon.svg")}}"
                            alt="profile icon active"
                        />
                    </a>
                @endif

				</div>
			</div>
		</div>
	</div>
	<div class="burger-menu hide-menu">
		<a href="#" class="burger-menu__button">
			<span class="burger-menu__lines"></span>
		</a>
	</div>
	<nav id="nav-menu" class="nav">
		@if(Session::get('locale') == 'en')
		<ul class="menu__wrap">
			<li class="menu__subItem">
				<div class="menu-title menu-mobile-title">Beginner
					<ul class="menu__list menu-mobile">
						<li class="menu__item"><a class="menu__link" href="/chto-vas-jdet">What to expect</a></li>
						<li class="menu__item"><a class="menu__link" href="/programs-poletov">Flight packages</a></li>
						<li class="menu__item"><a class="menu__link" href="/podarochnii-sertifikat">Gift Cards</a></li>
						<li class="menu__item"><a class="menu__link" href="/stat-sportsmenom">Become a Proflyer</a></li>
						<li class="menu__item"><a class="menu__link" href="/faq">FAQ</a></li>
					</ul>
				</div>
			</li>
			<li class="menu__subItem">
				<div class="menu-title menu-mobile-title">Athletes
					<ul class="menu__list menu-mobile">
                        <? echo menu('menu_sportsman_pages', '.frontend.blocks.nav') ?>
					</ul>
				</div>
			</li>
			<li class="menu__subItem">
				<div class="menu-title menu-mobile-title">Your holiday
					<ul class="menu__list menu-mobile">
						<li class="menu__item"><a class="menu__link" href="/korporativi">Corporate events</a></li>
						<li class="menu__item"><a class="menu__link" href="/dni-rojdeniya">Birthday parties</a></li>
						<li class="menu__item"><a class="menu__link" href="javascript:void(0)">Business meetings</a></li>
					</ul>
				</div>
			</li>
			<li class="menu__subItem">
				<div class="menu-title">News
					<ul class="menu__list">
						<li class="menu__item"><a class="menu__link" id="akcii_block" href="/news">Special offers</a></li>
						<li class="menu__item"><a class="menu__link" id="all_block" href="/news">News</a></li>
					</ul>
				</div>
			</li>
			<li class="menu__subItem">
				<div class="menu-title">About us
					<ul class="menu__list">
						<li class="menu__item"><a class="menu__link" href="/about-us">iFLY Minsk</a></li>
						<li class="menu__item"><a class="menu__link" href="/kak-eto-rabotaet">How it works</a></li>
						<li class="menu__item"><a class="menu__link" href="javascript:void(0)">Our team</a></li>
						<!-- <li class="menu__item"><a class="menu__link" href="javascript:void(0)">Virtual tour</a></li> -->
						<li class="menu__item"><a class="menu__link" href="/media">Media</a></li>
						<li class="menu__item"><a class="menu__link" href="/contacts">Contacts</a></li>
					</ul>
				</div>
			</li>
		</ul>
		@else
		<ul class="menu__wrap">
			<li class="menu__subItem">
				<div class="menu-title menu-mobile-title">Новичкам
					<ul class="menu__list menu-mobile">
						<li class="menu__item"><a class="menu__link" href="/chto-vas-jdet">Что вас ждет</a></li>
						<li class="menu__item"><a class="menu__link" href="/programs-poletov">Программы полетов</a></li>
						<li class="menu__item"><a class="menu__link" href="/podarochnii-sertifikat">Подарочный сертификат</a></li>
						<li class="menu__item"><a class="menu__link" href="/stat-sportsmenom">Стать спортсменом</a></li>
						<li class="menu__item"><a class="menu__link" href="/faq">Вопрос-ответ</a></li>
					</ul>
				</div>
			</li>
			<li class="menu__subItem">
				<div class="menu-title menu-mobile-title">Спортсменам
					<ul class="menu__list menu-mobile header__subList">
                        <? echo menu('menu_sportsman_pages', '.frontend.blocks.nav') ?>
					</ul>
				</div>
			</li>
			<li class="menu__subItem">
				<div class="menu-title menu-mobile-title">Ваш праздник
					<ul class="menu__list menu-mobile">
						<li class="menu__item"><a class="menu__link" href="/korporativi">Корпоративы</a></li>
						<li class="menu__item"><a class="menu__link" href="/dni-rojdeniya">Дни рождения</a></li>
						<li class="menu__item"><a class="menu__link" href="/business">Бизнес встречи</a></li>
					</ul>
				</div>
			</li>
			<li class="menu__subItem">
				<div class="menu-title">Новости
					<ul class="menu__list">
						<li class="menu__item"><a class="menu__link" id="akcii_block" href="/news">Специальные предложения</a></li>
						<li class="menu__item"><a class="menu__link" id="all_block" href="/news">Новости</a></li>
					</ul>
				</div>
			</li>
			<li class="menu__subItem">
				<div class="menu-title">О нас
					<ul class="menu__list">
						<li class="menu__item"><a class="menu__link" href="/about-us">iFLY Minsk</a></li>
						<li class="menu__item"><a class="menu__link" href="/kak-eto-rabotaet">Как это работает</a></li>
						<li class="menu__item"><a class="menu__link" href="/instructors">Наша команда</a></li> <!-- /instructors -->
						<!-- <li class="menu__item"><a class="menu__link" href="javascript:void(0)">Виртуальный тур</a></li> -->
						<li class="menu__item"><a class="menu__link" href="/media">Фото и видео</a></li>
						<li class="menu__item"><a class="menu__link" href="/contacts">Контакты</a></li>
					</ul>
				</div>
			</li>
		</ul>
		@endif
		<ul class="seti__list">
			<li class="seti__item"><a class="seti__link" href="https://www.instagram.com/ifly.minsk/"><img class="seti__icon" src="{{asset("/img/_src/instagramBlack.svg")}}" alt="Мы в инстаграм"></a></li>
			<li class="seti__item"><a class="seti__link" href="https://web.facebook.com/iFLYMinsk"><img class="seti__icon" src="{{asset("/img/_src/FacebookBlack.svg")}}" alt="Мы в фэйсбук"></a></li>
			<li class="seti__item"><a class="seti__link" href="https://www.youtube.com/"><img class="seti__icon" src="{{asset("/img/_src/youtubeBlack.svg")}}" alt="Мы в ютуб"></a></li>
		</ul>
		<ul class="contacts__list">
			<li class="contacts__item">
				<a class="contacts__link contacts__phone" href="tel:+375257776655">+375 25 777-66-55</a>
			</li>
			<li class="contacts__item">
				<a class="contacts__link contacts__mail" href="mailto:info@iflyminsk.by">info@iflyminsk.by</a>
			</li>
			<li class="contacts__item">
				@if(Session::get('locale') == "en")
				<a class="contacts__link contacts__map" href="/contacts">Timiryazev street 74</a>
				@else
				<a class="contacts__link contacts__map" href="/contacts">Тимирязева 74</a>
				@endif
			</li>
		</ul>
	</nav>
	<div class="burger-menu__overlay"></div>
</div>
</header>
