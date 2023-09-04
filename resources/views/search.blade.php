@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
<section>
    <div class="container py-5">
        <div class="d-flex align-items-center justify-content-center p-5">
            <div class="text-center">
                <h1>Search</h1>
                <div class="h2 text-secondary">"{{$q}}"</div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container py-5">
        <h2>Products</h2>
        <div class="row mb-5">
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
            @if (count($products) == 4)
            <div class="text-end">
                <a href="{{route('product','search='.$q)}}" class="btn btn-outline-dark">See More</a></div>
            @endif
        </div>
        <h2>Spareparts</h2>
        <div class="row mb-5">
            @forelse ($spareparts as $sparepart)
            <div data-aos="fade-down" data-aos-delay="300" data-aos-duration="4000" class="mb-4 col-6 col-md-4 col-lg-3">
                <a href="{{route('sparepart.show',$sparepart->slug)}}" class="text-decoration-none d-block">
                    <img src="{{ Voyager::image($sparepart->thumbnail('cropped')) == "" ? Voyager::image($sparepart->thumbnail('cropped')) : Voyager::image($sparepart->image)}}" alt="Image {{$sparepart->title}} Sparepart" class="w-100 d-block" style="aspect-ratio:1/1">
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
            @if (count($spareparts) == 4)
            <div class="text-end">
                <a href="{{route('sparepart','search='.$q)}}" class="btn btn-outline-dark">See More</a></div>
            @endif
        </div>
        <h2>Service</h2>
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
            @if (count($services) == 4)
            <div class="text-end">
                <a href="{{route('service','search='.$q)}}" class="btn btn-outline-dark">See More</a></div>
            @endif
        </div>
    </div>
</section>

@endsection

@section('beforebody')
@endsection