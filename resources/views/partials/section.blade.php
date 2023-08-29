@php
    $section = section($code);
@endphp
@if (isset($section))
<section>
    <div class="container py-5">
        <div class="">
            <div class="row align-items-center">
                <div data-aos="fade-right" data-aos-delay="0" data-aos-duration="1000" class="col-12 col-lg-6 mb-3">
                    <img src="{{Voyager::image($section->image)}}" alt="{{$section->title}}" class="w-100">
                </div>
                <div data-aos="fade-down" data-aos-delay="100" data-aos-duration="1000" class="col-12 col-lg-6 px-4">
                    <h3>{{$section->title}}</h3>
                    <p>{{$section->desc}}</p>
                    <a href="{{url($section->btn_link)}}" class="btn btn-danger rounded-0">{{$section->btn_text}}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif