@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
<section>
    <div class="container py-5">
        <div class="position-fixed bottom-0 end-0 start-0 p-3 d-flex align-items-center justify-content-center" style="z-index: 10;">
            <a href="https://wa.me/{{setting('site.whatsapp')}}" class="btn btn-dark rounded-3 px-3">Pesan Sekarang</a>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('product.category',$product->category->slug)}}" class="text-decoration-none text-secondary fw-semibold d-flex flex-wrap align-items-center gap-3">
                    <span class="iconify" data-icon="pajamas:arrow-left"></span>
                    <span class="text-danger fw-semibold">Product</span>/ <span class="text-danger fw-semibold">{{$product->category->name}}</span>/ <span class="text-secondary fw-semibold">{{$product->title}}</span>
                </a>
            </div>
            <div class="col-12 col-lg-9">
                <h1 class="text-capitalize">{{$product->title}}</h1>
                <div class="d-flex align-items-center gap-2 text-warning my-4">
                    @if ($product->rating != 0)
                        @php
                            $i = 1;
                        @endphp
                        @while ($i <= (int)$product->rating)
                            <span class="iconify" data-icon="ph:star-fill"></span>
                            @php
                                $i++;
                            @endphp
                        @endwhile
                    @else
                        <span class="iconify" data-icon="ph:star-fill"></span>
                        <span class="iconify" data-icon="ph:star-fill"></span>
                        <span class="iconify" data-icon="ph:star-fill"></span>
                        <span class="iconify" data-icon="ph:star-fill"></span>
                    @endif
                </div>
                <div class="mb-4">
                    <div class="owl-carousel item-carousel owl-theme">
                        @if (isset($product->images))
                            @foreach (json_decode($product->images, true) as $image)
                                <img src="{{ Voyager::image($image)}}" alt="Image {{$product->title}} product" class="d-block rounded-4" style="aspect-ratio:16/9; object-fit:cover">
                            @endforeach
                        @else
                        	<img data-aos="fade-down" data-aos-delay="0" data-aos-duration="1000" src="{{ Voyager::image($product->thumbnail('cropped')) == "" ? Voyager::image($product->thumbnail('cropped')) : Voyager::image($product->image)}}" alt="Image {{$product->title}} product" class="rounded-4 d-block w-100 my-3" style="aspect-ratio:1/1; object-fit:cover">
                        @endif
                    </div>
                    <div class="d-flex gap-3 my-4 align-items-center justify-content-between">
                        <div class="prev-item cursor-pointer p-2 rounded-5 border border-2 border-dark d-flex align-items-center justify-content-center">
                            <span class="iconify fs-2" data-icon="pajamas:arrow-left"></span>
                        </div>
                        <div id="item-dots"></div>
                        <div class="next-item cursor-pointer p-2 rounded-5 border border-2 border-dark d-flex align-items-center justify-content-center">
                            <span class="iconify fs-2" data-icon="pajamas:long-arrow"></span>
                        </div>
                    </div>
                </div>
                <div data-aos="fade" data-aos-delay="0" data-aos-duration="1000" class="content">
                    {!! $product->content !!}
                </div>
            </div>
            <div class="col-12 col-lg-3 p-4">
                <h6>Category</h6>
                <div class="mt-3 d-flex align-items-center gap-2 flex-wrap">
                    <a href="{{route('product.category',$product->category->slug)}}" class="p-1 px-3 bg-danger bg-opacity-10 cursor-pointer d-block text-danger rounded-4 text-nowrap text-lowercase text-decoration-none">{{$product->category->name}}</a>
                </div>
                @if (isset($banner))
                <div data-aos="fade" data-aos-delay="0" data-aos-duration="1000" class="my-4 d-flex justify-content-center">
                    <a href="{{$banner->link}}" class="d-block">
                        <img src="{{Voyager::image($banner->image)}}" alt="{{$banner->title}} Banner" style="max-height: 20em;" class="rounded-3 w-100">
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container py-5">
        <div class="fs-2 fw-semibold">Product Recommended</div>
        <div class="row mt-4">
            @forelse ($suggests as $suggest)
            <div data-aos="fade-down" data-aos-delay="300" data-aos-duration="1000" class="col-6 col-lg-4 col-xl-3">
                <a href="{{route('product.show',$suggest->slug)}}" class="d-block mb-4 text-decoration-none text-dark">
                    <img src="{{ Voyager::image($suggest->thumbnail('cropped')) == "" ? Voyager::image($suggest->thumbnail('cropped')) : Voyager::image($suggest->image)}}" alt="Image {{$suggest->title}} Product" class="w-100" style="aspect-ratio:1/1;object-fit:cover;">
                    <h6 class="lc lc-3 mb-2 bg-dark text-white text-center py-2 px-3">{{$suggest->title}}</h6>
                </a>
            </div>
            @empty
            <div class="p-4 text-center">No Data</div>
            @endforelse
        </div>
        <div class="d-flex align-items-center justify-content-center my-4">
            <a href="{{route('product')}}" class="btn btn-outline-dark rounded-0 ">See More</a>
        </div>
    </div>
</section>

@include('partials.section',['code'=>'product-show'])

@endsection

@section('beforebody')
@endsection