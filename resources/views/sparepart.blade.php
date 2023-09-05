@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
<section class="bg-light">
    <div class="container py-5">
        <h1 class="mb-3">{{setting('typography.sparepart_title')}}</h1>
        <p class="mb-3">{{setting('typography.sparepart_desc')}}</p>
        <div data-aos="fade-down" data-aos-delay="0" data-aos-duration="1000" class="row">
            @forelse ($categories as $category)
            <div class="col-6 col-md-4 col-lg-3 mb-3">
                <a href="{{route('sparepart.category',$category->slug)}}" class="d-block text-decoration-none text-dark bg-white fw-semibold p-3 rounded-3 px-4">{{$category->name}}</a>
            </div>
            @empty
            <div class="p-4 fw-bold">No Data</div>
            @endforelse
        </div>
    </div>
</section>
<section>
    <div class="container py-5">
        <h2>{{setting('typography.sparepart_list_title')}}</h2>
        <div class="p-1 bg-danger mb-3" style="width: 2em;"></div>
        <div class="row">
            <div class="col-12 my-4">
                <form action="{{route('sparepart')}}" method="GET" class="d-flex align-items-center gap-3">
                    <input type="text" class="form-control border border-2 rounded-4 bg-transparent" name="search" placeholder="Search product.." {{request()->has('search') ? "value=".request()->input('search')."" : ''}}>
                    <button type="submit" class="btn d-flex align-items-center justify-content-center btn-danger rounded-5 py-2"><span class="iconify" data-icon="iconamoon:search"></span></button>
                </form>
            </div>
            @forelse ($spareparts as $sparepart)
            <div data-aos="fade-down" data-aos-delay="300" data-aos-duration="4000" class="mb-4 col-6 col-md-4 col-lg-3">
                <a href="{{route('sparepart.show',$sparepart->slug)}}" class="text-decoration-none d-block">
                    <img src="{{ Voyager::image($sparepart->thumbnail('cropped')) == "" ? Voyager::image($sparepart->thumbnail('cropped')) : Voyager::image($sparepart->image)}}" alt="Image {{$sparepart->title}} Sparepart" class="w-100 d-block" style="aspect-ratio:1/1;object-fit:cover;">
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

@include('partials.banner',['code'=>'sparepart'])

@include('partials.section',['code'=>'sparepart'])

@endsection

@section('beforebody')
@endsection