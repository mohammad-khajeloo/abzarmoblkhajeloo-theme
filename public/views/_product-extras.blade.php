<script>
    const productInfo = {
        title: "{{ $product->title }}",

        category: ["{{$product->directory->title}}"],
        price: {{ $product->latest_price }},
        currency: "IRT",
        brand: "{{ env('APP_NAME') }}",
        averageVote: {{ $product->average_rating }},
        totalVotes: {{ $product->rates_count }},
        isAvailable: {{$product->is_active ? "true" : "false"}}
    };
    yektanet("product", "detail", productInfo);
</script>
