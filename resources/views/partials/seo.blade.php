<title>{{$data->title}}</title>
<link rel="canonical" href="{{url()->current()}}">

<!-- Meta Informasi -->
<meta name="description" content="{{$data->desc}}">
<meta name="keywords" content="{{$data->keyword}}">
<meta name="robots" content="index, follow">
<meta name="image" content="{{$data->image}}">
<meta name="twitter:card" content="summary_large_image">

<!-- Open Graph (OG) -->
<meta property="og:title" content="{{$data->title}}">
<meta property="og:description" content="{{$data->desc}}">
<meta property="og:image" content="{{$data->image}}">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:locale" content="en_US">
<meta property="og:site_name" content="CV Dwi Mitra Liftindo">
<meta property="og:type" content="{{request()->is('/') ? "website" : "webpage"}}">
<meta property="og:image:width" content="602">
<meta property="og:image:height" content="145">

<!-- Twitter Card -->
<meta name="twitter:title" content="{{$data->title}}">
<meta name="twitter:description" content="{{$data->desc}}">
<meta name="twitter:image" content="{{$data->image}}">

<!-- Schema.org Markup -->
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    @if(request()->is('/'))
        "type": "WebSite",
    @else
        "type": "WebPage",
    @endif
    "name": "{{$data->title}}",
    "url": "{{url()->current()}}",
    "dateModified": "{{isset($data->update) ? $data->update : now()->format('Y-m-d')}}",
    "description": "{{$data->desc}}",
    "publisher": {
        "@type": "Organization",
        "name": "CV Dwi Mitra Liftindo",
        "logo": {
            "@type": "ImageObject",
            "url": "{{Voyager::image(setting('site.logo'))}}"
        }
    }
}
</script>