@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
<section>
    <div class="container py-5">
        <h1 class="text-capitalize">Terms of Service</h1>
        <div class="p-1 bg-danger mb-3" style="width: 2em;"></div>
        <div>
            {!! setting('site.tos') !!}
        </div>
    </div>
</section>

@include('partials.section',['code'=>'tos'])

@endsection

@section('beforebody')
@endsection