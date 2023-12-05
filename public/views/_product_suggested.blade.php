<div class="suggested">
    <div class="title-wrapper">
        <div class="title">پیشنهادات ما به شما</div>
    </div>

    <div class="row">
        @foreach(custom_query_products("cart_page_popular_products") as $iter_product)
            @if(!in_array($iter_product->id, $cart_product_ids))
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    @include("_product-box", ["item" => $iter_product, "extra_classes" => "suggested-part-cart"])
                </div>
            @endif
        @endforeach
    </div>
</div>