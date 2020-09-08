@extends('layouts.app')

@section('metatags')
    <title>{{$content[0]->ceo_title}}</title>
    <meta name="description" content="{{$content[0]->ceo_description}}" />
    <meta name="keywords" content="{{$content[0]->ceo_keywords}}" />
@endsection

@section('content')
    <main>

        @include('.frontend.blocks.form_callback_parties')

        <div class="birthday">
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
            <ul id="birthday-list" class="birthday__list slider">
                @foreach ($birthday_array as $key=>$item)
                    <li class="birthday__item" style="background-image : url(/storage/{{$array_images[$key][0]}}/{{$array_images[$key][1]}}/{{$array_images[$key][2]}})">
                        <div class="container">
                            <div class="row">
                                {!! $item->description !!}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

    </main>
@endsection

