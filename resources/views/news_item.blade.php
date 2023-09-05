@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
<section>
    <div class="container py-5">
        <img src="{{Voyager::image($news->image)}}" alt="{{$news->title}} Image" class="w-100 my-4 rounded-4" style="aspect-ratio:16/9">
        <div class="fs-6 text-secondary fw-semibold">{{makeDate($news->created_at)}}</div>
        <h1>{{$news->title}}</h1>
        <div class="d-flex my-3 align-items-center gap-2">
            <span class="iconify" data-icon="mingcute:tag-line"></span>
            <div class="d-flex align-items-center gap-2 flex-wrap tag-box">
                @forelse ($news->categories as $category)
                <a href="{{route('news.category',$category->slug)}}" class="p-1 px-3 bg-light cursor-pointer d-block text-dark rounded-4 text-nowrap text-lowercase text-decoration-none">{{$category->name}}</a>
                @empty
                <a href="#" class="p-1 px-3 bg-light cursor-pointer d-block text-dark rounded-4 text-nowrap text-lowercase text-decoration-none">Undefined</a>
                @endforelse
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 col-lg-9">
                <div class="content">
                    {!! $news->content !!}
                </div>
            </div>
            <div class="col-12 col-lg-3 order-first order-lg-last">
                <div class="d-flex align-items-start ">
                    <div class="bg-light p-5 rounded-5">
                        <div class="fs-4 text-dark fw-semibold mb-2">Table of Content</div>
                        <div class="p-1 bg-danger mb-3" style="width: 2em;"></div>
                        <ul class="list-unstyled toc" id="toc-ul">
                            
                        </ul>
                    </div>
                </div>
                @foreach ($news->banners as $banner)
                <div data-aos="fade" data-aos-delay="0" data-aos-duration="1000" class="my-4 d-flex justify-content-center">
                    <a href="{{$banner->link}}" class="d-block">
                        <img src="{{Voyager::image($banner->image)}}" alt="{{$banner->title}} Banner" style="max-height: 20em;" class="rounded-3 w-100">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container py-5">
        <div class="fs-2 fw-semibold">News for you</div>
        <div class="row mt-4">
            @forelse ($suggests as $suggest)
            <div data-aos="fade-down" data-aos-delay="300" data-aos-duration="1000" class="col-6 col-lg-4 col-xl-3">
                <a href="{{route('news.show',$suggest->slug)}}" class="d-block mb-4 text-decoration-none text-dark">
                    <img src="{{ Voyager::image($suggest->thumbnail('cropped')) == "" ? Voyager::image($suggest->thumbnail('cropped')) : Voyager::image($suggest->image)}}" alt="Image {{$suggest->title}} News" class="w-100 mb-2" style="aspect-ratio:16/9;object-fit:cover;">
                    <h6 class="lc lc-3 mb-2">{{$suggest->title}}</h6>
                    <p class="fs-6 text-secondary lc lc-3 text-justify">{{$suggest->meta_description}}</p>
                </a>
            </div>
            @empty
            <div class="col-12 p-4 text-center">No Data</div>
            @endforelse
        </div>
        <div class="d-flex align-items-center justify-content-center my-4">
            <a href="{{route('news')}}" class="btn btn-outline-dark rounded-0 ">See More</a>
        </div>
    </div>
</section>
<section>
    <div class="container py-5">
        <div class="">
            <div class="row align-items-center">
                <div data-aos="fade-right" data-aos-delay="0" data-aos-duration="1000" class="col-12 col-lg-6 mb-3">
                    <img src="{{Voyager::image($news->section->image)}}" alt="{{$news->section->title}} Image" class="w-100" style="aspect-ratio:45/30;object-fit:cover">
                </div>
                <div data-aos="fade-down" data-aos-delay="100" data-aos-duration="1000" class="col-12 col-lg-6 px-4">
                    <h3>{{$news->section->title}}</h3>
                    <p>{{$news->section->desc}}</p>
                    <a href="{{$news->section->btn_link}}" class="btn btn-danger rounded-0">{{$news->section->btn_text}}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('beforebody')
<script>
    $(document).ready(function() {
    var $tableOfContents = $('#toc-ul');

    // Mencari semua heading yang akan dimasukkan ke dalam daftar isi
    var $headings = $('h2');

    // Membuat daftar isi
    $headings.each(function(index, element) {
      var $heading = $(element);
      var headingText = $heading.text();
      var headingLevel = parseInt($heading.prop('tagName').substring(1));
      
      // Membuat anchor ID untuk heading
      var anchorId = 'toc-anchor-' + index;
      $heading.attr('id', anchorId);
      
      // Membuat link daftar isi untuk heading
      var tocEntry = '<a class="d-block" href="#' + anchorId + '"><li class="border-start border-2 ps-3 fs-6 cursor-pointer pb-3 text-secondary fw-semibold text-decoration-underline">' + headingText + '</li></a>';
      $tableOfContents.append(tocEntry);
    });
  });
</script>
@endsection