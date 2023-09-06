@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
<section>
    <div class="container py-5">
        <h1 class="text-capitalize">Hubungi Kami</h1>
        <div class="p-1 bg-danger mb-3" style="width: 2em;"></div>
        <div class="row">
            <div class="col-12 col-lg-6 mb-4">
                <img src="{{Voyager::image($image->image)}}" alt="Image Kantor" class="d-block w-100 rounded-4" style="aspect-ratio:16/9;object-fit:cover">
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <iframe src="{{setting('site.gmap')}}" style="border:0;min-height: 30em;width: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-12 mb-4">
                <div class="row">
                    @forelse ($offices as $office)
                    <div class="col-12 col-lg-6 my-4">
                        <h3>{{$office->title}}</h3>
                        <p>{{$office->address}}</p>
                    </div>
                    @empty
                    <div class="col-12 p-4 text-center">No Data</div> 
                    @endforelse
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <h3>Mail us</h3>
                <form method="POST" action="{{route('contact.send')}}" class="row mt-3">
                    @csrf
                    <div class="col-12">
                        <input type="text" class="form-control w-100 rounded-4 bg-light border-0 p-2 px-3 mb-3" name="name" placeholder="Nama Anda" minlength="4" maxlength="23">
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="email" class="form-control w-100 rounded-4 bg-light border-0 p-2 px-3 mb-3" name="email" placeholder="your@email.com">
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="number" class="form-control w-100 rounded-4 bg-light border-0 p-2 px-3 mb-3" name="no" placeholder="no telp/whatsapp">
                    </div>
                    <div class="col-12">
                        <textarea name="messages" id="" cols="30" rows="10" class="form-control w-100 rounded-4 bg-light border-0 p-2 px-3 mb-3"></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-dark px-3">Send</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <h3>Social Media</h3>
                <div class="mt-3 row">
                    <div class="col-12">
                        @forelse ($sosmeds as $sosmed)
                        <a href="{{$sosmed->link}}" target="_blank" class="d-flex mb-3 text-dark align-items-center gap-3 p-3 rounded-4 border border-2">
                            <span class="iconify" data-icon="{{$sosmed->icon}}"></span>
                            <span class="fw-semibold">{{$sosmed->username}}</span>
                            <div class="ms-auto"><span class="iconify" data-icon="pajamas:long-arrow"></span></div>
                        </a>
                        @empty
                        <div class="p-4 text-center">No Data</div>                            
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.banner',['code'=>'contact'])

@include('partials.section',['code'=>'contact'])

@endsection

@section('beforebody')
@endsection