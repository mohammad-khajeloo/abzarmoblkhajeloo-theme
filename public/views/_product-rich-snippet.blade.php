<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Product",
  "name": "{{ $product->title }}",
  "image":
    @if($image = $product->getMainPhoto())
        "{{ ImageService::getImage($image, 'preview', true) }}"
    @endif
  ,
  "description": "{{ $product->description }}",
  "mpn": "{{ $product->code }}",
  "brand": {
    "@type": "Thing",
    "name": "{{ env('APP_NAME') }}"
  },
  @if($product->rates_count > 0)
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ $product->average_rating }}",
        "reviewCount": "{{ $product->rates_count }}"
      },
  @endif
  "offers": {
    "@type": "Offer",
    "priceCurrency": "IRR",
    "price": "{{ $product->latest_price }}0",
    "itemCondition": "http://schema.org/NewCondition",
    "availability": @if($product->is_active) "http://schema.org/InStock" @else "http://schema.org/OutOfStock" @endif,
    "seller": {
      "@type": "Organization",
      "name": "{{ env('APP_NAME') }}"
    }
  }
}
</script>