@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
<section class="bg-light">
    <div class="container py-5">
        <h1>{{setting('typography.service_title')}}</h1>
        <p data-aos="fade-left" data-aos-duration="4000" style="max-width: 40em;">{{setting('typography.service_desc')}}</p>
        <div data-aos="fade-down" data-aos-delay="0" data-aos-duration="1000" class="row my-4">
            @forelse ($categories as $category)
            <div class="col-6 col-md-4 col-lg-3 mb-3">
                <a href="{{route('service.category',$category->slug)}}" class="d-block text-decoration-none text-dark bg-white fw-semibold p-3 rounded-3 px-4">{{$category->name}}</a>
            </div>
            @empty
            <div class="col-12 text-center p-4">No Data</div>                
            @endforelse
        </div>
        <h2>{{setting('typography.service_list_title')}}</h2>
        <div class="p-1 bg-danger mb-3" style="width: 2em;"></div>
        <div class="col-12 my-4">
            <form action="{{route('service')}}" method="GET" class="d-flex align-items-center gap-3">
                <input type="text" class="form-control border border-2 rounded-4 bg-transparent" name="search" placeholder="Search product.." {{request()->has('search') ? "value=".request()->input('search')."" : ''}}>
                <button type="submit" class="btn d-flex align-items-center justify-content-center btn-danger rounded-5 py-2"><span class="iconify" data-icon="iconamoon:search"></span></button>
            </form>
        </div>
        <div class="d-flex flex-column gap-3 my-5 ms-3">
            @forelse ($services as $service)
            <a data-aos="fade-down" data-aos-delay="00" data-aos-duration="4000" href="{{route('service.show', $service->slug)}}" class="row bg-white text-decoration-none text-dark w-100 overflow-hidden rounded-4">
                <div class=" col-12 col-md-6 p-0 m-0">
                    <img src="{{ Voyager::image($service->thumbnail('cropped')) == "" ? Voyager::image($service->thumbnail('cropped')) : Voyager::image($service->image)}}" alt="{{$service->title}} Image" class="d-block w-100 p-0" style="max-width: 40em;aspect-ratio:10/7;object-fit:cover">
                </div>
                <div class=" col-12 col-md-6 p-0 m-0">
                    <div class="p-5 bg-white d-flex flex-column h-100">
                        <h4>{{$service->title}}</h4>
                        <p>{{$service->meta_description}}</p>
                        <div class="d-flex align-items-center gap-3 text-danger">
                            <span class="iconify" data-icon="bxs:category-alt"></span>
                            <span class="text-lowercase">{{isset($service->category->name) ? $service->category->name : 'undefined'}}</span>
                        </div>
                        <div class="mt-auto d-flex justify-content-end">
                            <div class="d-inline-flex align-items-center text-decoration-none text-white bg-danger p-2 px-3 gap-2">
                                Read More
                                <span class="iconify" data-icon="pajamas:arrow-right"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-12 text-center p-4">No Data</div>
            @endforelse
        </div>
    </div>
</section>

@include('partials.banner',['code'=>'sparepart'])

@include('partials.section',['code'=>'sparepart'])

@endsection

@section('beforebody')
@endsection