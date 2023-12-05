@extends('_base')

@section('title')
    سبد خرید -
@endsection

@section('meta_tags')
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta itemprop="description" content="">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:type" content="website">
@endsection


@section('main_content')
    <script>window.currentPage = "cart"</script>
    @php $cart_product_ids = []; @endphp

    <div class="container cart">
        <div class="icon-title">
            <i class="fa icon-shopping-bag" aria-hidden="true"></i><span>سبد خرید</span>
        </div>
        <div class="top-line-content" id="cart-module">
            @if(!isset($cartRows) or count($cartRows) == 0)
                <div class="empty-basket">
                    <p>سبد خرید شما خالی می باشد و هیچ کالایی به آن افزوده نشده است.</p>
                    <a href="/" class="btn btn-icon back" data-text="خرید">
                        <span class="text">خرید </span><i class="fa fa-angle-left" aria-hidden="true"></i>
                    </a>
                </div>
            @else

                @if(has_system_messages())
                    <ul class="error-messages">
                        @foreach(get_system_messages() as $message)
                            <li>{!! $message->text !!}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="product-list">
                    <div class="pd-list-header">
                        <div class="col col-count"></div>
                        <div class="col">شرح محصول</div>
                        <div class="col col-lg-2">قیمت واحد <span>(تومان)</span></div>
                        <div class="col col-lg-2">تعداد</div>
                        <div class="col col-lg-1" style="font-size: 11px">تخفیف واحد</div>
                        <div class="col col-lg-2">قیمت کل <span>(تومان)</span></div>
                    </div>
                    <div class="pd-list-body pd-list-body">
                        <?php $sum = 0; $count = 1; ?>
                        @foreach($cartRows as $cartRow)
                            @php  $cart_product_ids[]=$cartRow->product_id; @endphp
                            <div product-box class="pd-list-item product-box cart-row"
                                 product-price="{{$cartRow->product->has_discount ? $cartRow->product->previous_price : $cartRow->product->latest_price }}"
                                 product-id="{{$cartRow->product->id}}"
                                 product-code="{{$cartRow->product->code}}"
                                 data-product-id="{{$cartRow->product->id}}"
                                 data-row-id="{{$cartRow->id}}"
                                 data-discount-group="{{json_encode($cartRow->product->discountGroup)}}">
                                <div class="col col-count numerical-data price-data">{{$count}}</div>
                                <div class="col product-details">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 pl-0">
                                            <a href="{{$cartRow->product->getFrontUrl()}}">
                                                <img src="{{ImageService::getImage($cartRow->product, 'preview')}}"
                                                     class="img-fluid"
                                                     alt="{{$cartRow->product->title}}">
                                            </a>
                                            @if($cartRow->product->is_location_limited)
                                                <div class="ribbon-delivery">
                                                    <img src="/HCMS-assets/img/icons/delivery.svg" class="icon">
                                                    فقط
                                                    {{($cartRow->product?->location_limitations[0] ?? null)?->getCity()?->name}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                            <a href="{{$cartRow->product->getFrontUrl()}}">
                                                <h3>{{$cartRow->product->title}}</h3>
                                            </a>
                                            <p class="code">KIT: <span>{{$cartRow->product->code}}</span></p>
                                            <div class="product-notice">{!! $cartRow->product->notice !!}</div>
                                            <div class="delete">
                                                <a class="del-product" title="حذف محصول"
                                                   href="{{route('customer.cart.detach-product', $cartRow->product)}}">
                                                    <i class="icon-garbage" aria-hidden="true"></i> حذف محصول از سبد
                                                    خرید
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-2 unit-price">
                                    <div class="after-discount price price-single">
                                                <span class="price-data">
                                                    {{$cartRow->product->has_discount ? $cartRow->product->previous_price : $cartRow->product->latest_price}}
                                                </span>
                                        <span class="list-price-text hidden-xl hidden-lg">تومان</span>
                                    </div>
                                </div>
                                <div class="col col-lg-2">
                                    <div class="counter-product counter-box-{{$cartRow->product->id}}">
                                        <div class="input-counter count-group"
                                             data-action="{{route('customer.cart.detach-product', $cartRow->product->id)}}">
                                            <input type="text"
                                                   class="form-control count-control count-control-local"
                                                   name="count-{{$cartRow->product->id}}"
                                                   value="{{old("count-".$cartRow->product->id, $cartRow->count)}}"
                                                   data-min="{{$cartRow->product->minimum_allowed_purchase_count}}"
                                                   data-max="{{$cartRow->product->maximum_allowed_purchase_count}}">
                                            <i class="fa fa-angle-up plus count-increase"
                                               product-id="{{$cartRow->product->id}}">
                                            </i>
                                            <i class="fa fa-angle-down minus count-decrease"
                                               product-id="{{$cartRow->product->id}}">
                                            </i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-1">
                                    <div class="discount-container">
                                        @if($cartRow->product->has_discount)
                                            <span class="price-data discount-value special"
                                                  data-amount="{{ $cartRow->product->previous_price - $cartRow->product->latest_price }}">
                                                    {{ $cartRow->product->previous_price - $cartRow->product->latest_price }}
                                                </span>
                                            <span class="list-price-text">تومان</span>
                                        @elseif($cartRow->product->discountGroup !== null)
                                            <span class="price-data discount-value">{{ $cartRow->product->discountGroup->value }}</span>
                                            <span class="list-price-text">{{ $cartRow->product->discountGroup->is_percentage ? "٪" : "تومان" }}</span>
                                        @else
                                            <div class="price-data discount-value hidden-sm hidden-xs"
                                                 style="font-size:13px;text-align: center">بدون تخفیف
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-lg-2 price" product-id="{{$cartRow->product->id}}">
                                    <div class="unit-price">
                                        <div class="before-discount">
                                                <span class="sum-price-before before-price digit">
                                                    <strike>
                                                        <span class="digit price-data">
                                                            {{$cartRow->product->latest_price }}
                                                        </span>
                                                    </strike>
                                                </span>
                                        </div>
                                        <div class="after-discount sum-price">
                                            <span class="price-data price-sum">{{$cartRow->product->latest_price}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $count += 1;?>
                        @endforeach
                    </div>
                    <div class="invoice-sum-container">
                        <div class="total">
                            <div class="col-lg-3 col-md-6 col-sm-6 ttl">جمع کل خرید شما</div>
                            <div class="col-lg-4 col-md-6 col-sm-6 price sum-price-before-discount before-discount">
                                <span class="price-data cart-sum">{{$sum}}</span>تومان
                            </div>
                        </div>
                        <div class="total">
                            <div class="col-lg-3 col-md-6 col-sm-6 ttl">سود شما از این خرید</div>
                            <div class="col-lg-4 col-md-6 col-sm-6 price sum-price-discount discount">
                                <span class="price-data">0</span> تومان
                            </div>
                        </div>
                        <div class="payment">
                            <div class="col-lg-3 col-md-6 col-sm-6 ttl">مبلغ قابل پرداخت</div>
                            <div class="col-lg-4 col-md-6 col-sm-6 price sum-price-after-discount after-discount">
                                <span class="price-data cart-sum">{{$sum}}</span>تومان
                            </div>
                        </div>
                    </div>
                </div>

                <div class="button-wrapper">
                    <div class="right-wrapper">
                        <a href="/" class="btn btn-icon-reverse back col-xs-12" data-text='بازگشت به صفحه اصلی'>
                            <i class="fa fa-angle-right" aria-hidden="true"></i><span
                                    class="text">بازگشت به صفحه اصلی</span>
                        </a>
                        <a data-action="{{route(is_customer() ? "customer.cart.remove-all" : "customer.cart.remove-local")}}"
                           data-method="DELETE" class="btn btn-delete-all col-xs-12 virt-form">تخلیه سبد خرید</a>
                    </div>

                    <button type="submit" data-text='ادامه ثبت سفارش' class="btn btn-icon next col-xs-12 virt-form"
                            data-method="post" data-action="{{route('customer.invoice.submit-cart')}}">
                        <span class="text">ادامه ثبت سفارش</span>
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                    </button>
                </div>

                <hr/>
                <div class="alert">
                    * افزودن کالاها به سبد خرید به معنی رزرو کالا برای شما نیست. برای ثبت سفاش باید مراحل بعدی خرید را
                    تکمیل نمایید.
                </div>
            @endif
        </div>

        @include("_product_suggested",['cart_product_ids'=>$cart_product_ids])
    </div>
@endsection
