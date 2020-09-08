@extends('layouts.app')

@section('metatags')
<title>{{$content[0]->ceo_title}}</title>
<meta name="description" content="{{$content[0]->ceo_description}}" />
<meta name="keywords" content="{{$content[0]->ceo_keywords}}" />
@endsection

@section('content')
<main>

	@include('.frontend.blocks.form_callback_athletic')

<div class="athlete">
			<div class="container container__breadcrumb">
				<div class="row">
					<nav aria-label="breadcrumb" class="nav__breadcrumb">
						<ol class="breadcrumb">
							@if(Session::get('locale') == "en")
							<li class="breadcrumb-item"><a href="/">Home</a></li>
							@else
							<li class="breadcrumb-item"><a href="/">Главная</a></li>
							@endif
							<li class="breadcrumb-item active" aria-current="page">{{$content[0]->title}}</li>
						</ol>
					</nav>
				</div>
			</div>
			<section class="athlete__banner" style="background-image : url(/storage/{{$banner_image[0]}}/{{$banner_image[1]}}/{{$banner_image[2]}})">
				<div class="container">
					<div class="row">
						<div class="athlete__caption">
							<h2 class="athlete__title">{{$content[0]->title}}</h2>
							<p class="athlete__text">{{$content[0]->preview_description}}</p>
							@if(Session::get('locale') == "en")
							<a class="athlete__btn white btn want_write btn-hover" href="javascript:void(0)">Order training</a>
							@else
							<a class="athlete__btn white btn want_write btn-hover" href="javascript:void(0)">Заказать обучение</a>
							@endif
						</div>
					</div>
				</div>
			</section>
		</div>
		<!-- <section class="athlete__programs">
			<div class="container">
				<div class="row">

						@if(Session::get('locale') == "en")
						<h2 class="title">Training program</h2>
						@else
						<h2 class="title">Программа обучения</h2>
						@endif

				</div>
			</div>
			<div class="container">
				<div class="row athlete__container">

					{!! $content[0]->description !!}

					@if(Session::get('locale') == "en")
					<h4 class="athlete__titleSection">Get a training package to improve your professional level</h4>
					@else
					<h4 class="athlete__titleSection">Приобретайте пакет тренировок для повышения своего профессионального уровня</h4>
					@endif

					<div class="athlete__right">
						<div class="athlete__sliderWrap">
							<div class="athlete__slider">
								<div class="athlete__item">
									<div class="athlete__video">
										<img class="athlete__img" src="{{$content[0]->video}}" alt="1">
									</div>
								</div>
							</div>
						</div>
						<div class="athlete__sliderNav">
							@foreach ($slider_array as $key=>$item)
								<div class="athlete__item"><div class="athlete__video"><img class="athlete__img" src="/storage_old_@/{{$item}}" alt="1"></div></div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</section> -->
	</main>

</main>
@endsection
