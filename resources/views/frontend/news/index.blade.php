@extends('layouts.app')

@section('metatags')
<title>{{$content[0]->ceo_title}}</title>
<meta name="description" content="{{$content[0]->ceo_description}}" />
<meta name="keywords" content="{{$content[0]->ceo_keywords}}" />
@endsection

@push('cssVue')
<!-- <link rel="stylesheet" href="{{asset("/css/app.css")}}" /> -->
@endpush

@section('content')
<main class="main__news">

    <div class="container container__breadcrumb">
    <div class="row">
        <nav aria-label="breadcrumb" class="nav__breadcrumb">
        <ol class="breadcrumb">
            @if(Session::get('locale') == "en")
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">News and promotions</li>
            @else
            <li class="breadcrumb-item"><a href="/">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Новости и акции</li>
            @endif
        </ol>
        </nav>
    </div>
    </div>
    <section class="news">
        <news-component :locale="{{json_encode(Session::get('locale'))}}"></news-component>
    </section>
</main>

@endsection        

@push('scripts')
<!-- <script src="{{asset("/js/app.js")}}"></script> -->
@endpush