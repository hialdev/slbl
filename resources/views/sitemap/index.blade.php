
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($routes as $route)
        <url>
            <loc>{{ url($route) }}</loc>
            <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>