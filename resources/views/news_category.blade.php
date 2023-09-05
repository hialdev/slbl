@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
<section class="bg-light">
    <div class="container py-5">
        <a href="{{route('news')}}" class="text-decoration-none fw-semibold text-danger d-flex align-items-center gap-3">
            <span class="iconify" data-icon="pajamas:arrow-left"></span>
            Back to News
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
        <form action="{{route('product.category',$category->slug)}}" method="GET" class="row mb-4">
            <div class="col-6 mb-3 col-lg-3">
                <div class="d-flex align-items-center gap-3 text-nowrap">
                    Order by :
                    <select name="order" class="form-select rounded-4 border border-2" aria-label="Default select example">
                        <option value="0" {{request()->input('order') == '0' ? 'selected' : ''}}>Latest</option>
                        <option value="1" {{request()->input('order') == '1' ? 'selected' : ''}}>Oldest</option>
                    </select>
                </div>
            </div>
            <div class="col-6 mb-3 col-lg-3">
                <div class="d-flex align-items-center gap-3 text-nowrap">
                    Limit :
                    <select name="limit" class="form-select rounded-4 border border-2" aria-label="Default select example">
                        <option value="10" {{request()->input('limit') == '10' ? 'selected' : ''}}>10</option>
                        <option value="15" {{request()->input('limit') == '15' ? 'selected' : ''}}>15</option>
                        <option value="20" {{request()->input('limit') == '20' ? 'selected' : ''}}>20</option>
                        <option value="25" {{request()->input('limit') == '25' ? 'selected' : ''}}>25</option>
                    </select>
                </div>
            </div>
            <div class="col-12 mb-3 col-lg-6">
                <div class="d-flex align-items-center gap-3">
                    <input type="text" class="form-control border border-2 rounded-4 bg-transparent" name="search" placeholder="Search news.." {{ request()->has('search') ? 'value='.request()->input('search') : ''}}>
                    <button type="submit" class="btn d-flex align-items-center justify-content-center btn-danger rounded-5 py-2"><span class="iconify" data-icon="iconamoon:search"></span></button>
                </div>
            </div>
        </form>
        <div class="d-flex my-3 align-items-center gap-2">
            <span class="iconify" data-icon="mingcute:tag-line"></span>
            <div class="d-flex align-items-center gap-2 overflow-auto tag-box">
                @forelse ($tags as $tag)
                <a href="{{route('news.category',$tag->slug)}}" class="p-1 px-3 bg-light cursor-pointer d-block text-dark rounded-4 text-nowrap text-lowercase text-decoration-none {{$tag->name == $category->name ? 'active' : ''}}">{{$tag->name}}</a>
                @empty
                <div class="p-2">No Data News Category</div>
                @endforelse
            </div>
        </div>
        <div class="row mt-4">
            @forelse ($news as $new)
            <div data-aos="fade-down" data-aos-delay="300" data-aos-duration="1000" class="col-6 col-lg-4 col-xl-3">
                <a href="{{route('news.show',$new->slug)}}" class="d-block mb-4 text-decoration-none text-dark">
                    <img src="{{ Voyager::image($new->thumbnail('cropped')) == "" ? Voyager::image($new->thumbnail('cropped')) : Voyager::image($new->image)}}" alt="Image {{$new->title}} News" class="w-100 mb-3" style="aspect-ratio:16/9;object-fit:cover;">
                    <h6 class="lc lc-3 mb-2">{{$new->title}}</h6>
                    <p class="fs-6 text-secondary lc lc-3 text-justify">{{$new->meta_description}}</p>
                </a>
            </div>
            @empty
            <div class="p-4 text-center">No Data News</div>
            @endforelse
        </div>
        <div class="d-flex align-items-center py-5 justify-content-between">
            @php
                $total = $news->total(); // Total data
                $lastPage = $news->lastPage(); // Total halaman terakhir
                $perPage = $news->perPage(); // Data per halaman
                $currentPage = $news->currentPage(); // Halaman saat ini
            @endphp
            <a href="{{ $news->url(1) }}" class="p-3 bg-dark text-white rounded-5 text-dark d-flex align-items-center justify-content-center">
                <span class="iconify" data-icon="icon-park-outline:to-left"></span>
            </a>
            <div class="d-flex align-items-center gap-3 justify-content-center">
                @php
                    $pagePaginate = $currentPage > 2 ? $currentPage-2 : $currentPage;
                @endphp
                @while ($pagePaginate <= $lastPage && $pagePaginate <= $currentPage+2)
                    <a href="{{ $news->url($pagePaginate) }}" class="text-dark {{ $pagePaginate === $currentPage ? 'fw-bold' : ''}}">{{ $pagePaginate }}</a>
                    @php
                        $pagePaginate++;
                    @endphp
                @endwhile
            </div>
            <a href="{{ $news->url($lastPage) }}" class="p-3 bg-dark text-white rounded-5 text-dark d-flex align-items-center justify-content-center">
                <span class="iconify" data-icon="icon-park-outline:to-right"></span>
            </a>
        </div>
    </div>
</section>

@include('partials.banner',['code'=>'news'])

@include('partials.section',['code'=>'news'])

@endsection

@section('beforebody')
@endsection