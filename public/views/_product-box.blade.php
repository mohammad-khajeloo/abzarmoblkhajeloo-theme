<?php $availability_flag = false; ?>
<div class="product-item @if(isset($extra_classes)) {{$extra_classes}} @endif"
     product-box data-product-id="{{$item->id}}" product-price="{{$item->latest_price}}"
     data-discount-group="{{json_encode($item->discountGroup)}}">

    @foreach($item->getExtraProperties() as $property)
        @if($property->key == "availability_type")
                <?php $availability_flag = true ?>
                <?php $availability_value = $property->value ?>
        @endif
    @endforeach

    @if(isset($remove_cart_button) and $remove_cart_button)
        <a class="remove" href="{{route('customer.wish-list.detach-product', $item)}}"
           title="حذف از علاقه مندی ها">
            <i class="fa fa-close"></i>
        </a>
    @endif
    <a href="{{$item->getFrontUrl()}}" target="_blank" title="{{$item->title}}">
        <div class="product-pic">
            <img src="{{ImageService::getImage($item, 'thumb')}}" alt="{{$item->title}}"
                 class="img-fluid @if($item->getSecondaryPhoto()) img-main @endif">
            @if($item->getSecondaryPhoto())
                <img src="{{ImageService::getImage($item->getSecondaryPhoto(), 'thumb')}}"
                     alt="{{$item->title}}" class="img-fluid img-secondary">
            @endif
            @if($item->has_discount)
                <div class="ribbon hidden-sm hidden-xs">ویژه
                    <span class="numerical-data">{{floor(($item->previous_price - $item->latest_price) /  $item->previous_price * 100)}}</span>٪
                </div>
            @endif

            @if($item->is_location_limited)
                <div class="ribbon-delivery">
                    <img src="/HCMS-assets/img/icons/delivery.svg" class="icon">
                    فقط
                    {{($item?->location_limitations[0] ?? null)?->getCity()?->name}}
                </div>
            @endif

            @if($item->is_active)
                <div class="hidden-xs">
                    @include("_product-counter-box", compact("item"))
                </div>
            @elseif(!$item->is_needed)
                @if($item->inaccessibility_type==1)
                    <a href="{{route('customer.need-list.attach-product', $item)}}"
                       class="btn add-need-list hidden-xs" title="">
                        <div class="btn-add-basket-text">موجود شد خبرم کن</div>
                        <div class="btn-add-basket-icon">
                            <i class="fa fa-bell-o"></i>
                        </div>
                    </a>
                @elseif($item->inaccessibility_type==2)
                    @if($availability_flag && $availability_value != 3)
                        <a href="{{route('customer.need-list.attach-product', $item)}}"
                           class="btn add-need-list hidden-xs" title="">
                            <div class="btn-add-basket-text">موجود شد خبرم کن</div>
                            <div class="btn-add-basket-icon">
                                <i class="fa fa-bell-o"></i>
                            </div>
                        </a>
                    @endif
                @endif
            @endif
        </div>
        <a href="{{$item->getFrontUrl()}}" target="_blank"
           title="{{$item->title}}">
            <h3 class="product-title hidden-xs">{{$item->title}}</h3>
        </a>
        <div class="product-footer hidden-xs">
            @if($item->is_active)
                <div class="product-price">
                    @if($item->has_discount)
                        <span class="price-data discount">{{$item->previous_price}}</span>
                    @endif
                    <span class="unit-price price-data">{{$item->latest_price}} </span>
                    تومان
                </div>
            @elseif(!$item->is_needed)
                @if($item->inaccessibility_type==1)
                    <div class="not-available">ناموجود</div>
                @elseif($item->inaccessibility_type==2)
                    @if($availability_flag)
                        @if($availability_value == 1)
                            <span class="call">در حال تامین</span>
                        @elseif($availability_value == 2)
                            <span class="call">به زودی</span>
                        @else
                            <div class="not-available">توقف تولید</div>
                        @endif
                    @else
                        <span class="call">تماس بگیرید</span>
                    @endif
                @endif
            @endif
            <div class="rating-value">
                <span class="numerical-data price-data">{{ $item->average_rating }}</span>
                <i class="fa fa-star-o"></i>
            </div>
        </div>

        <div class="pd-item-md-details hidden-xl hidden-lg hidden-md hidden-sm">
            @if($item->has_discount)
                <div class="ribbon">ویژه
                    <span class="numerical-data">{{floor(($item->previous_price - $item->latest_price) /  $item->previous_price * 100)}}</span>٪
                </div>
            @endif
            <div class="rating-value">
                <i class="fa fa-star-o"></i>
                <span class="numerical-data price-data">{{ $item->average_rating }}</span>
            </div>
            <a href="{{$item->getFrontUrl()}}" target="_blank" title="{{$item->title}}">
                <h4 class="product-title">{{$item->title}}</h4></a>
            @if($item->is_active)
                <div class="product-price unit-price">
                    <span class="before-discount">
                        @if($item->has_discount)
                            <span class="price-data discount">{{$item->previous_price}}</span>
                        @elseif($item->discountGroup !== null)
                            <span class="price-data discount"></span>
                        @endif
                    </span>
                    <span class="after-discount sum-price">
                        <span class="unit-price price-data">{{$item->latest_price}} </span>                         تومان
                    </span>
                </div>
            @else
                @if($item->inaccessibility_type==2)
                    @if($availability_flag)
                            @if($availability_value == 1)
                                <span class="call">در حال تامین</span>
                            @elseif($availability_value == 2)
                                <span class="call">به زودی</span>
                            @else
                                <div class="not-available">توقف تولید</div>
                            @endif
                    @else
                        <span class="call">تماس بگیرید</span>
                    @endif
                @elseif($item->inaccessibility_type==1)
                    <div class="not-available">ناموجود</div>
                @endif
            @endif
            <div class="btn-row">
                @if($item->is_active)
                    @include("_product-counter-box", compact("item"))
                @else
                    @if($item->inaccessibility_type==1)
                        <a href="/customer/need-list/attach-product/{{$item->id}}" class="btn add-need-list"
                           title="خبرم کن" target="_blank"><i class="fa fa-bell-o"></i>
                        </a>
                    @elseif($item->inaccessibility_type==2)
                        @if($availability_flag && $availability_value != 3)
                            <a href="/customer/need-list/attach-product/{{$item->id}}" class="btn add-need-list"
                               title="خبرم کن" target="_blank"><i class="fa fa-bell-o"></i></a>
                        @else
                            <a href="{{$item->getFrontUrl()}}" class="btn btn-call"
                               title="تماس بگیرید" target="_blank"><i class="fa fa-phone"></i>
                            </a>
                        @endif

                    @endif
                @endif
            </div>
        </div>

    </a>
</div>
