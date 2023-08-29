@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
<section class="bg-light">
    <div class="container py-5">
        <a href="{{route('sparepart')}}" class="text-decoration-none fw-semibold text-danger d-flex align-items-center gap-3">
            <span class="iconify" data-icon="pajamas:arrow-left"></span>
            Back to Sparepart
        </a>
        <div class="my-3 d-flex gap-3 align-items-center text-decoration-none text-dark">
            <div class="rounded-4 bg-white d-flex align-items-center justify-content-center p-3 p-lg-4 mb-2" style="height:6em;width:6em">
                <span class="iconify fs-1" data-icon="bxs:category-alt"></span>
            </div>
            <h1>{{$category->name}}</h1>
        </div>
        <div class="content">
            {!! $category->content !!}
        </div>
    </div>
</section>
<section>
    <div class="container py-5">
        <h2>Sparepart</h2>
        <div class="d-flex my-3 align-items-center gap-2">
            <span class="iconify" data-icon="bxs:category-alt"></span>
            <div class="d-flex align-items-center gap-2 overflow-auto tag-box">
                @forelse ($categories as $ctg)
                <a href="{{route('sparepart.category',$ctg->slug)}}" class="p-1 px-3 bg-light cursor-pointer d-block text-dark rounded-4 text-nowrap text-lowercase text-decoration-none {{$ctg->slug == $category->slug ? 'active' : ''}}">{{$ctg->name}}</a>
                @empty
                <a href="#" class="p-1 px-3 bg-light cursor-pointer d-block text-dark rounded-4 text-nowrap text-lowercase text-decoration-none">undefined</a>
                @endforelse
            </div>
        </div>
        <div class="row">
            <div class="col-12 my-4">
                <form action="{{route('sparepart.category',$category->slug)}}" method="GET" class="d-flex align-items-center gap-3">
                    <input type="text" class="form-control border border-2 rounded-4 bg-transparent" name="search" placeholder="Search sparepart.." {{request()->has('search') ? "value=".request()->input('search')."" : ''}}>
                    <button type="submit" class="btn d-flex align-items-center justify-content-center btn-danger rounded-5 py-2"><span class="iconify" data-icon="iconamoon:search"></span></button>
                </form>
            </div>
            @forelse ($spareparts as $sparepart)
            <div data-aos="fade-down" data-aos-delay="300" data-aos-duration="4000" class="mb-4 col-6 col-md-4 col-lg-3">
                <a href="{{route('sparepart.show',$sparepart->slug)}}" class="text-decoration-none d-block">
                    <img src="{{Voyager::image($sparepart->image)}}" alt="Image {{$sparepart->title}}" class="w-100 d-block" style="aspect-ratio:1">
                    <div class="text-dark fs-6 fw-semibold py-1">
                        {{$sparepart->title}}
                        <div class="d-flex align-items-center gap-3 text-danger">
                            <span class="iconify" data-icon="bxs:category-alt"></span>
                            <span class="text-lowercase">{{$sparepart->category->name}}</span>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="p-4 text-center">No Data</div>
            @endforelse
        </div>
    </div>
</section>
@include('partials.banner',['code'=>'sparepart-category'])

@include('partials.section',['code'=>'sparepart-category'])
@endsection

@section('beforebody')
@endsection