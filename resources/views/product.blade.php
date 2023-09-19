@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
<section class="bg-light">
    <div class="container py-5">
        <div data-aos="fade-down" data-aos-delay="0" data-aos-duration="1000" class="row">
            @forelse ($categories as $category)
                <div class="col-6 col-md-4 col-lg-2 text-center">
                    <a href="{{route('product.category',$category->slug)}}" class="m-3 d-block text-decoration-none text-dark">
                        <div class="rounded-4 bg-white d-flex align-items-center justify-content-center p-3 p-lg-4 mb-2 mx-auto" style="height:6em;width:6em">
                            @if (isset($category->icon))
                            <span class="iconify fs-1" data-icon="{{$category->icon}}"></span>
                            @else
                            <img src="{{Voyager::image($category->image_icon)}}" alt="{{$category->name}} Icon" class="d-block rounded-2" style="max-width: 4em;aspect-ratio:1/1">
                            @endif
                        </div>
                        <h6>{{$category->name}}</h6>
                    </a>
                </div>
            @empty
                <div class="p-3 text-center">No Data Category</div> 
            @endforelse
        </div>
    </div>
</section>
<section>
    <div class="container py-5">
        <h1>{{setting('typography.product_title')}}</h1>
        <div class="p-1 bg-danger mb-3" style="width: 2em;"></div>
        <div class="row">
            <div class="col-12 my-4">
                <form action="{{route('product')}}" method="GET" class="d-flex align-items-center gap-3">
                    <input type="text" class="form-control border border-2 rounded-4 bg-transparent" name="search" placeholder="Search product.." {{request()->has('search') ? "value=".request()->input('search')."" : ''}}>
                    <button type="submit" class="btn d-flex align-items-center justify-content-center btn-danger rounded-5 py-2"><span class="iconify" data-icon="iconamoon:search"></span></button>
                </form>
            </div>
            @forelse ($products as $product)
            <div data-aos="fade-down" data-aos-delay="00" data-aos-duration="4000" class="mb-4 col-6 col-md-4 col-lg-3">
                <a href="{{route('product.show',$product->slug)}}" class="text-decoration-none d-block">
                    <img src="{{ Voyager::image($product->thumbnail('cropped')) == "" ? Voyager::image($product->thumbnail('cropped')) : Voyager::image($product->image)}}" alt="Image {{$product->title}} Product" class="w-100 d-block" style="aspect-ratio:1/1; object-fit:cover">
                    <div class="text-center fs-6 bg-dark fw-bold py-1 text-white">
                        {{$product->title}}
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 p-4 text-center">No Data</div>
            @endforelse
            
        </div>
        <div class="d-flex align-items-center py-5 justify-content-between">
            @php
                $total = $products->total(); // Total data
                $lastPage = $products->lastPage(); // Total halaman terakhir
                $perPage = $products->perPage(); // Data per halaman
                $currentPage = $products->currentPage(); // Halaman saat ini
            @endphp
            <a href="{{ $products->url(1) }}" class="p-3 bg-dark text-white rounded-5 text-dark d-flex align-items-center justify-content-center">
                <span class="iconify" data-icon="icon-park-outline:to-left"></span>
            </a>
            <div class="d-flex align-items-center gap-3 justify-content-center">
                @php
                    $pagePaginate = $currentPage > 2 ? $currentPage-2 : $currentPage;
                @endphp
                @while ($pagePaginate <= $lastPage && $pagePaginate <= $currentPage+2)
                    <a href="{{ $products->url($pagePaginate) }}" class="text-dark {{ $pagePaginate === $currentPage ? 'fw-bold' : ''}}">{{ $pagePaginate }}</a>
                    @php
                        $pagePaginate++;
                    @endphp
                @endwhile
            </div>
            <a href="{{ $products->url($lastPage) }}" class="p-3 bg-dark text-white rounded-5 text-dark d-flex align-items-center justify-content-center">
                <span class="iconify" data-icon="icon-park-outline:to-right"></span>
            </a>
        </div>
    </div>
</section>

@include('partials.banner',['code'=>'product'])

@include('partials.section',['code'=>'product'])

@endsection

@section('beforebody')
@endsection