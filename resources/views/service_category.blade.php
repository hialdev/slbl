@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
<section class="bg-light">
    <div class="container py-5">
        <a href="{{route('service')}}" class="text-decoration-none fw-semibold text-danger d-flex align-items-center gap-3">
            <span class="iconify" data-icon="pajamas:arrow-left"></span>
            Back to Service
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
        <h2>Service</h2>
        <div class="d-flex my-3 align-items-center gap-2">
            <span class="iconify" data-icon="bxs:category-alt"></span>
            <div class="d-flex align-items-center gap-2 overflow-auto tag-box">
                @forelse ($categories as $ctg)
                <a href="{{route('service.category',$ctg->slug)}}" class="p-1 px-3 bg-light cursor-pointer d-block text-dark rounded-4 text-nowrap text-lowercase text-decoration-none {{$ctg->slug == $category->slug ? 'active' : ''}}">{{$ctg->name}}</a>
                @empty
                <a href="#" class="p-1 px-3 bg-light cursor-pointer d-block text-dark rounded-4 text-nowrap text-lowercase text-decoration-none">undefined</a>
                @endforelse
            </div>
        </div>
        <div class="row">
            <div class="col-12 my-4">
                <form action="{{route('service.category',$category->slug)}}" method="GET" class="d-flex align-items-center gap-3">
                    <input type="text" class="form-control border border-2 rounded-4 bg-transparent" name="search" placeholder="Search service.." {{request()->has('search') ? "value=".request()->input('search')."" : ''}}>
                    <button type="submit" class="btn d-flex align-items-center justify-content-center btn-danger rounded-5 py-2"><span class="iconify" data-icon="iconamoon:search"></span></button>
                </form>
            </div>
            <div class="col-12">
                <div class="d-flex flex-wrap">
                    @forelse ($services as $service)
                    <div class="col-12 col-md-6 col-lg-4 p-3">
                        <a data-aos="fade-down" data-aos-delay="00" data-aos-duration="4000" href="{{route('service.show', $service->slug)}}" class="row bg-white text-decoration-none text-dark w-100 overflow-hidden rounded-4">
                            <div class=" col-12 p-0 m-0">
                                <img src="{{ Voyager::image($service->thumbnail('cropped')) == "" ? Voyager::image($service->thumbnail('cropped')) : Voyager::image($service->image)}}" alt="{{$service->title}} Image" class="d-block w-100 p-0" style="max-width: 40em;aspect-ratio:10/7;object-fit:cover">
                            </div>
                            <div class=" col-12 p-0 m-0">
                                <div class="p-4 bg-white d-flex flex-column h-100">
                                    <h4>{{$service->title}}</h4>
                                    <p class="lc lc-3">{{$service->meta_description}}</p>
                                    <div class="d-flex align-items-center gap-3 text-danger">
                                        <span class="iconify" data-icon="bxs:category-alt"></span>
                                        <span class="text-lowercase">{{isset($service->category->name) ? $service->category->name : 'undefined'}}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="p-4 text-center">No Data</div>
                    @endforelse
                    
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.banner',['code'=>'service-category'])

@include('partials.section',['code'=>'service-category'])

@endsection

@section('beforebody')
@endsection