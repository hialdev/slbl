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
                <div class="col-6 col-md-4 col-lg-2 text-center">
                    <a href="{{route('service.category',$category->slug)}}" class="m-3 d-block text-decoration-none text-dark">
                        <div class="rounded-4 bg-white d-flex align-items-center justify-content-center p-3 p-lg-4 mb-2 mx-auto" style="height:6em;width:6em">
                            <img src="{{Voyager::image($category->image_icon)}}" alt="{{$category->name}} Icon" class="d-block rounded-2" style="max-width: 4em;aspect-ratio:1/1">
                        </div>
                        <h6>{{$category->name}}</h6>
                    </a>
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
        <div class="d-flex my-5 flex-wrap">
            @forelse ($services as $service)
            <div class="col-4 p-3">
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
            <div class="col-12 text-center p-4">No Data</div>
            @endforelse
        </div>
        <div class="d-flex align-items-center py-5 justify-content-between">
            @php
                $total = $services->total(); // Total data
                $lastPage = $services->lastPage(); // Total halaman terakhir
                $perPage = $services->perPage(); // Data per halaman
                $currentPage = $services->currentPage(); // Halaman saat ini
            @endphp
            <a href="{{ $services->url(1) }}" class="p-3 bg-dark text-white rounded-5 text-dark d-flex align-items-center justify-content-center">
                <span class="iconify" data-icon="icon-park-outline:to-left"></span>
            </a>
            <div class="d-flex align-items-center gap-3 justify-content-center">
                @php
                    $pagePaginate = $currentPage > 2 ? $currentPage-2 : $currentPage;
                @endphp
                @while ($pagePaginate <= $lastPage && $pagePaginate <= $currentPage+2)
                    <a href="{{ $services->url($pagePaginate) }}" class="text-dark {{ $pagePaginate === $currentPage ? 'fw-bold' : ''}}">{{ $pagePaginate }}</a>
                    @php
                        $pagePaginate++;
                    @endphp
                @endwhile
            </div>
            <a href="{{ $services->url($lastPage) }}" class="p-3 bg-dark text-white rounded-5 text-dark d-flex align-items-center justify-content-center">
                <span class="iconify" data-icon="icon-park-outline:to-right"></span>
            </a>
        </div>
    </div>
</section>

@include('partials.banner',['code'=>'sparepart'])

@include('partials.section',['code'=>'sparepart'])

@endsection

@section('beforebody')
@endsection