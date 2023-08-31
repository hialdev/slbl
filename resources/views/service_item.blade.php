@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
<section>
    <div class="container py-5">
        <div class="position-fixed bottom-0 end-0 start-0 p-3 d-flex align-items-center justify-content-center" style="z-index: 99;">
            <a href="{{url('https://wa.me/'.setting('site.whatsapp'))}}" class="btn btn-dark rounded-3 px-3">Pesan Sekarang</a>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('service.category',$service->category->slug)}}" class="text-decoration-none text-secondary fw-semibold d-flex flex-wrap align-items-center gap-3">
                    <span class="iconify" data-icon="pajamas:arrow-left"></span>
                    <span class="text-danger fw-semibold">Service</span>/ <span class="text-danger fw-semibold">Category Name</span>/ <span class="text-secondary fw-semibold">Lorem ipsum dolor sit amet consectetur adipisicing elit</span>
                </a>
            </div>
            <div class="col-12 col-lg-9">
                <h1 class="text-capitalize">{{$service->title}}</h1>
                <div class="d-flex align-items-center gap-2 text-warning my-4">
                    <span class="iconify" data-icon="ph:star-fill"></span>
                    <span class="iconify" data-icon="ph:star-fill"></span>
                    <span class="iconify" data-icon="ph:star-fill"></span>
                    <span class="iconify" data-icon="ph:star-fill"></span>
                    <span class="iconify" data-icon="ph:star-fill"></span>
                </div>
                <div class="mb-4">
                    <div class="owl-carousel item-carousel owl-theme">
                        @forelse (json_decode($service->images, true) as $image)
                        <img src="{{Voyager::image($image)}}" alt="Image {{$service->title}} service" class="d-block rounded-4">
                        @empty
                        <img data-aos="fade-down" data-aos-delay="0" data-aos-duration="1000" src="{{Voyager::image($service->image)}}" alt="Img {{$service->title}}" class="rounded-4 d-block w-100 my-3" style="aspect-ratio:1/1">
                        @endforelse
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
                    {!! $service->content !!}
                </div>
            </div>
            <div class="col-12 col-lg-3 p-4">
                <h6>Category</h6>
                <div class="mt-3 d-flex align-items-center gap-2 flex-wrap">
                    <a href="{{route('service.category',$service->category->slug)}}" class="p-1 px-3 bg-danger bg-opacity-10 cursor-pointer d-block text-danger rounded-4 text-nowrap text-lowercase text-decoration-none">{{$service->category->name}}</a>
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
<section class="bg-light">
    <div class="container py-5">
        <div class="fs-2 fw-semibold">Service For You</div>
        <div class="d-flex flex-column gap-3 my-5 ms-3">
            @forelse ($suggests as $suggest)
            <a data-aos="fade-down" data-aos-delay="00" data-aos-duration="4000" href="{{route('service.show',$suggest->slug)}}" class="row bg-white text-decoration-none text-dark w-100 overflow-hidden rounded-4">
                <div class=" col-12 col-md-6 p-0 m-0">
                    <img src="{{Voyager::image($suggest->image)}}" alt="{{$suggest->title}} Image" class="d-block w-100 p-0" style="max-width: 40em;aspect-ratio:10/7 !important;object-fit:cover;">
                </div>
                <div class=" col-12 col-md-6 p-0 m-0">
                    <div class="p-5 bg-white d-flex flex-column h-100">
                        <h4>{{$suggest->title}}</h4>
                        <p>{{$suggest->meta_description}}</p>
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
            <div class="p-4 text-center">No Data</div>
            @endforelse
            
        </div>
        <div class="d-flex align-items-center justify-content-center my-4">
            <a href="./service.html" class="btn btn-outline-dark rounded-0 ">See More</a>
        </div>
    </div>
</section>
<section>
    <div class="container py-5">
        <div class="">
            <div class="row align-items-center">
                <div data-aos="fade-right" data-aos-delay="0" data-aos-duration="1000" class="col-12 col-lg-6 mb-3">
                    <img src="https://placehold.co/450x300" alt="" class="w-100">
                </div>
                <div data-aos="fade-down" data-aos-delay="100" data-aos-duration="1000" class="col-12 col-lg-6 px-4">
                    <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis molestias ratione aut pariatur odio, est ab dignissimos! Asperiores, mollitia quas? Porro nisi error, ea tempore consequatur maiores est officia fugiat.</p>
                    <a href="#" class="btn btn-danger rounded-0">CTA Button</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('beforebody')
@endsection