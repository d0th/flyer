@extends('layouts.app')

@section('metatags')
<title>{{$content[0]->ceo_title}}</title>
<meta name="description" content="{{$content[0]->ceo_description}}" />
<meta name="keywords" content="{{$content[0]->ceo_keywords}}" />
@endsection

@section('content')
<main>
    
    <section class="flight__top">
        <div class="container container__breadcrumb">
          <div class="row mb-100">
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
      </section>

      @include('.frontend.blocks.programs_home')

</main>
@endsection        
