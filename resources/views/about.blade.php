@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
<section>
    <div class="container py-5">
        <h1 class="text-capitalize">{{setting('typography.about_title')}}</h1>
        <div class="p-1 bg-danger mb-3" style="width: 2em;"></div>
        <div>
            <img data-aos="fade-down" data-aos-delay="0" data-aos-duration="1000" src="{{Voyager::image(setting('about.image'))}}" alt="Image About {{setting('site.title')}}" class="d-block float-end w-100 my-3 m-lg-4" style="max-width: 40em; object-fit:cover">
            <div class="content" data-aos="fade" data-aos-delay="0" data-aos-duration="1000">
                {!! setting('about.content') !!}
            </div>
        </div>
    </div>
</section>

@include('partials.banner',['code'=>'about'])

@include('partials.section',['code'=>'about'])

@endsection

@section('beforebody')
@endsection