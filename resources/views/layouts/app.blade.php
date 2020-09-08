<!DOCTYPE html>
{{App::setLocale(Session::get('locale'))}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	@php header('X-Frame-Options: *'); @endphp
	<meta charset="utf-8">

	@yield('metatags')

    <style>
        [class*="ymaps-2"][class*="-ground-pane"] {
            filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale");
            -webkit-filter: grayscale(100%);
        }
    </style>

	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge" />

	<link rel="icon" href="{{asset("/favicon.ico")}}">
	<meta property="og:image" content="{{asset("/img/@1x/preview.jpg")}}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>
	<!-- <link rel="stylesheet" href="{{asset("/css/jquery.lightbox.css")}}" />  -->
    <link rel="stylesheet" href="{{asset("/css/new-style.css")}}" />
    <link rel="stylesheet" href="{{asset("/css/styles.min.css")}}" />
	@stack('cssVue')

	{!! setting('admin.metrika-yandex') !!}
	{!! setting('admin.google-metrika') !!}

</head>

<body>

	@include('.frontend.blocks.header')

    <div id="app">
	@yield('content')
	</div>

	@include('.frontend.blocks.footer')

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="{{asset("/js/app.js")}}"></script>
	@stack('scripts')
	<script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
	<script
			src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
			integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
			crossorigin="anonymous"
	></script>
	<script
			src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
			integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
			crossorigin="anonymous"
	></script>
	<!-- <script src="{{asset("/js/jquery.lightbox.js")}}"></script> -->
	<script src="{{asset("/js/scripts.min.js")}}"></script>
	<script src="{{asset("/js/slider.js")}}"></script>

	@include('.frontend.blocks.preloader')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vuetify/2.2.15/vuetify.min.css">
    <script src="https://unpkg.com/vuejs-datepicker/dist/locale/translations/fr.js"></script>
</body>
</html>
