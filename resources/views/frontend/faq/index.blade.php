@extends('layouts.app')

@section('metatags')
<title>{{$content[0]->ceo_title}}</title>
<meta name="description" content="{{$content[0]->ceo_description}}" />
<meta name="keywords" content="{{$content[0]->ceo_keywords}}" />
@endsection

@section('content')
<main class="main__faq">

    @include('.frontend.blocks.form_callback')
    
    <div class="container container__breadcrumb">
        <div class="row">
            <nav aria-label="breadcrumb" class="nav__breadcrumb">
            <ol class="breadcrumb">
                @if(Session::get('locale') == 'en')
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                @else
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{$content[0]->title}}</li>
            </ol>
            </nav>
        </div>
    </div>
    <section class="faq">
    <div class="container">
        <div class="row">
        <h2 class="title">{{$content[0]->title}}</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach ($fags as $key=>$item)
                <div class="panel panel-default">
                @php $key++ @endphp
                    <div class="panel-heading" role="tab" id="heading{{$key}}">
                        <h3 class="panel-title">
                            <a class="faq__btn collapsed" role="button" data-toggle="collapse"  href="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse1"><span class="faq__number">@if($key >= 10){{$key}}@else 0{{$key}} @endif</span><span class="faq__title">{{$item->question}}</span><span class="faq__iconWrap"><span class="faq__icon"></span></span></a>
                        </h3>
                    </div>
                        <div id="collapse{{$key}}" class="panel-collapse collapse" data-parent="#accordion" role="tabpanel" aria-labelledby="heading{{$key}}" >
                            <div class="panel-body">{!! $item->answer !!}</div>				
                        </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    </section>
</main>
@endsection        
