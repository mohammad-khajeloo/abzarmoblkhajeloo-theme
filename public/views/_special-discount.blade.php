@if($product->is_active and $product->discountGroup != null)
    <div class="footer">
        @php
            $steps_data = $product->discountGroup->steps_data_object;
            $steps_count = count($steps_data);
        @endphp
        <div class="section discount-container discount-list">
            <div class="title-wrapper">
                <div class="title">
                    محاسبه تخفیف @if($steps_count > 1)
                        پلکانی
                    @endif
                </div>
            </div>
            <ul class="discount-value-list">
                @foreach($steps_data as $iter_index => $iter_step)
                    <li class="discount-value-item"
                        data-discount-value="{{$iter_step->value}}">
                        <span class="price-data discount-value">{{$iter_step->value}}</span>
                        <span class="list-price-text">
                            {{ $product->discountGroup->is_percentage ? "٪" : "تومان" }}
                            </span>
                        &nbsp; | &nbsp;
                        @if($iter_step->value != "0")
                            از
                            <span class="price-data">
                                {{ $iter_step->amount }}
                                </span>
                            تومان
                        @endif
                        @if($iter_index < ($steps_count - 1))
                            تا
                            <span class="price-data">
                                    {{ $steps_data[$iter_index+1]->amount }}
                                </span>
                            تومان
                        @else
                            به بالا
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="footer">
        <div class="price">
            <div class="price-title">مبلغ مجموع</div>
            <span class="sum-price-before before-price digit">
                <strike>
                    <span class="digit price-data">0</span>
                </strike>
            </span>
            <div class="product-price value sum-price">
                <span class="digit price-data">{{$product->latest_price}}</span>
                <span>تومان</span>
            </div>
        </div>
    </div>
@endif
