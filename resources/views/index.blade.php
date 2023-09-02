@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
{{-- First Load Banner Modal --}}
@include('modals.firstload')

<section class="hero">
    <div class="position-relative">
        <div class="owl-carousel owl-theme hero-carousel">
            @forelse ($heros as $hero)
            <div class="position-relative">
                <img src="{{Voyager::image($hero->image)}}" alt="{{$hero->title}} Image" class="w-100" style="aspect-ratio:16/9 !important;object-fit:cover;">
                <div class="hero-content top-0 bottom-0 end-0 start-0">
                    <div class="container p-4 h-100">
                        <div class="d-flex align-items-center h-100">
                            <div style="max-width: 40em;">
                                <h1>{{$hero->title}}</h1>
                                <p>{{$hero->desc}}</p>
                                <a href="{{$hero->btn_link}}" class="d-inline-flex p-2 text-decoration-none fw-semibold px-3 align-items-center gap-2 px-3 bg-danger text-white rounded-0">{{$hero->btn_text}} <span class="iconify" data-icon="pajamas:arrow-right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-5 text-center">
                No data
            </div>
            @endforelse
            
        </div>
        <div class="position-absolute bottom-0 end-0 p-2 p-md-5" style="z-index: 10;">
            <div id="hero-dots" class="d-flex items-center gap-2">
            </div>
        </div>
    </div>
</section>
<section class="py-5 bg-light">
    <div class="container">
        <h2>{{setting('typography.home_featured_title')}}</h2>
        <p style="max-width: 40em;">{{setting('typography.home_featured_desc')}}</p>
        <div class="row">
            @forelse ($products as $product)
            <div data-aos="fade-down" data-aos-delay="400" data-aos-duration="1000" class="col-12 col-md-4 mb-3">
                <a href="{{route('product.show',$product->slug)}}" class="text-decoration-none d-block text-dark">
                    <img src="{{Voyager::image($product->image)}}" alt="Product" class="w-100 mb-3" style="aspect-ratio:1/1">
                    <h6>{{$product->title}}</h6>
                </a>
            </div>
            @empty
            <div class="p-3 text-center">No Data Featured Product, atur di product dan buat menjadi featured</div>                
            @endforelse
        </div>
        <div class="d-flex align-items-center gap-3 my-5">
            <span class="fw-semibold text-secondary text-uppercase" style="letter-spacing: 0.4em;">select category</span>
            <hr class="border-1 w-25">
            
        </div>
        <div data-aos="fade-down" data-aos-delay="0" data-aos-duration="1000" class="row">
            @forelse ($categories as $category)
                <div class="col-6 col-md-4 col-lg-2 text-center">
                    <a href="{{route('product.category',$category->slug)}}" class="m-3 d-block text-decoration-none text-dark">
                        <div class="rounded-4 bg-white d-flex align-items-center justify-content-center p-3 p-lg-4 mb-2 mx-auto" style="height:6em;width:6em">
                            @if (isset($category->icon))
                            <span class="iconify fs-1" data-icon="{{$category->icon}}"></span>
                            @else
                            <img src="{{Voyager::image($category->image_icon)}}" alt="Image Category" class="d-block rounded-2" style="max-width: 4em;aspect-ratio:1/1">
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
<section class="bg-danger text-white py-4">
    <div class="container py-5">
        <div class="row">
            <div data-aos="fade-right" data-aos-delay="0" data-aos-duration="1000" class="col-12 col-md-6">
                <h2>{{setting('typography.home_service_title')}}</h2>
                <p>{{setting('typography.home_service_desc')}}</p>
                <a href="{{route('service')}}" class="btn btn-dark px-3 rounded-0">See Service</a>
            </div>
            <div data-aos="fade-down" data-aos-delay="0" data-aos-duration="1000" class="col-12 col-md-6 mt-4">
                <div class="owl-carousel owl-theme service-carousel">
                    @forelse ($services as $service)
                    <a href="{{route('service.show',$service->slug)}}" class="bg-white d-block text-decoration-none p-2 rounded-3 text-dark text-center">
                        <img src="{{Voyager::image($service->image)}}" alt="{{$service->title}} service image" class="rounded-2 mb-3" style="aspect-ratio:10/7">
                        <h6>{{$service->title}}</h6>
                    </a>
                    @empty
                    <div class="rounded-3 p-4 text-center">No Data</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container py-5">
        <h2 class="text-center mb-4">Brand Product</h2>
        <div class="d-flex items-center gap-3 mb-5 flex-wrap justify-content-center mx-auto" style="max-width: 30em;">
            @forelse ($brands as $brand)
            <div data-aos="fade-down" data-aos-delay="700" data-aos-duration="1000" class="d-flex align-items-center justify-content-center px-5 py-2 rounded-3 border border-2" style="width: 5em;">
                <img src="{{Voyager::image($brand->image)}}" alt="Brand Logo {{$brand->title}}" title="{{$brand->title}}" class="d-block" style="aspect-ratio:10/7;object-fit:contain;max-height: 2.7em;">
            </div>
            @empty
            <div class="p-3 text-center">No Data</div>
            @endforelse
        </div>
        <h2 class="text-center mb-4">Our Client</h2>
        <div data-aos="fade" data-aos-delay="0" data-aos-duration="1000" class="client-carousel owl-carousel owl-theme">
            @forelse ($clients as $client)
            <div class="d-flex align-items-center justify-content-center p-3 px-5">
                <img src="{{Voyager::image($client->image)}}" alt="Client Logo {{$client->title}}" title="{{$client->title}}" class="d-block" style="aspect-ratio:10/7;object-fit:contain;max-height: 3.7em;">
            </div>
            @empty
            <div class="p-3 text-center">No Data</div>
            @endforelse
        </div>
    </div>
</section>

@include('partials.banner',['code' => 'home'] )

<section class="bg-light">
    <div class="container py-5">
        <h2 class="mb-3">Latest News</h2>
        <div style="width: 3em;" class="p-1 bg-danger"></div>
        <div class="row mt-4">
            @forelse ($news as $new)
            <div data-aos="fade-down" data-aos-delay="300" data-aos-duration="1000" class="col-6 col-lg-4 col-xl-3">
                <a href="{{route('news.show',$new->slug)}}" class="d-block mb-4 text-decoration-none text-dark">
                    <img src="{{Voyager::image($new->image)}}" alt="Image Thumbnail {{$new->title}} News" class="w-100 mb-2" style="aspect-ratio:16/9">
                    <h6 class="lc lc-3 mb-2">{{$new->title}}</h6>
                    <p class="fs-6 text-secondary lc lc-3 text-justify">{{$new->meta_description}}</p>
                </a>
            </div>
            @empty
            <div class="p-4 text-center">No Data</div>
            @endforelse
            
        </div>
    </div>
</section>

@include('partials.section',['code' => 'home'])

@endsection

@section('beforebody')
@endsection