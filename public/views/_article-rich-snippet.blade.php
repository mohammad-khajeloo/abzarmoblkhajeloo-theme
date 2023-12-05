<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "NewsArticle",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ $article->getFrontUrl() }}"
  },
  "headline": "{{ $article->title }}",
  "image": {
    "@type": "ImageObject",
    "url": "{{ ImageService::getImage($article, 'original', true) }}"
  },
  "datePublished": "{{ $article->created_at }}",
  "dateModified": "{{ $article->updated_at }}",
  "description": "{{ $article->getSeoDescription() }}",
  @if($article->rates_count > 0)
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ $article->average_rating }}",
        "reviewCount": "{{ $article->rates_count }}"
      },
  @endif
  "author": {
    "@type": "Organization",
    "name": "{{ env('APP_NAME') }}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "{{ env('APP_NAME') }}",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ env('APP_URL') }}/HCMS-assets/img/logo.jpg"
    }
  }
}
</script>