<?xml version="1.0" encoding="UTF-8"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

@foreach ($urls as $url)

    <url>
        <loc>{{ $url['loc'] }}</loc>
        <changefreq>{{$url['freq']}}</changefreq>
        <priority>{{ $url['priority'] }}</priority>
    </url>

@endforeach

@foreach ($noticias as $noticia)
        <url>
            <loc>{{ url('/news-detalis/' . $noticia->slug) }}</loc>
            <lastmod>{{ $noticia->updated_at->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

</urlset>