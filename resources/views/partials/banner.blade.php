@php
    $banner = $page->get($code)->banner;
@endphp
@if (isset($banner))
<section>
    <div class="container py-5">
        <div data-aos="fade" data-aos-delay="0" data-aos-duration="1000" class="d-flex justify-content-center">
            <a href="{{$banner->link}}" class="d-block">
                <img src="{{Voyager::image($banner->image)}}" alt="{{$banner->title}} Banner" style="max-height: 20em;" class="rounded-3 w-100">
            </a>
        </div>
    </div>
</section>
@endif