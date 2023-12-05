@extends('_base')

@section('title')
    {{ $product->getSeoTitle() }} -
@endsection

@section('meta_tags')
    @include('_meta_tags', ['obj' => $product])
    <meta property="og:type" content="product">
@endsection

@section('main_content')
    <script>window.currentPage = "product-single";</script>

    <?php $availability_flag = false; ?>

    <div class="container-fluid product">
        <ol class="breadcrumb hidden-md">
            @foreach($product->directory->getParentDirectories() as $parentDirectory)
                <li><a href="{{$parentDirectory->getLandingUrl()}}" title="{{$parentDirectory->title}}">
                        <h2>{{$parentDirectory->title}}</h2></a></li>
            @endforeach
            <li class="active"><h1>{{$product->title}}</h1></li>
        </ol>

        <div class="container-fluid-small">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-xs-12 pics-container">
                    <div id="gal-single-product" class="clearfix">
                        <div class="single-product-sections group-product-right">
                            <div class="single-product-section single-product-right">
                                <div id="product-gallery">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <script>
                                                window.galleryObj = [
                                                        @foreach($product->images()->orderBy("priority", "ASC")->where('link', '=', "")->extension(['gif'])->get() as $gif)
                                                    {
                                                        small: "{{url($gif->getImagePath())}}",
                                                        original: "{{url($gif->getImagePath())}}",
                                                        big: "{{url($gif->getImagePath())}}",
                                                        alt: "{{$gif->caption ? : $product->title}}"
                                                    },
                                                        @endforeach
                                                        @foreach($product->images()->orderBy("priority", "ASC")->where('link', '=', "")->notExtension(['gif'])->get() as $image)
                                                    {
                                                        small: "{{url(ImageService::getImage($image, 'thumb'))}}",
                                                        original: "{{url(ImageService::getImage($image, 'preview'))}}",
                                                        big: "{{url(ImageService::getImage($image, 'original'))}}",
                                                        alt: "{{$image->caption ? : $product->title}}"
                                                    },
                                                    @endforeach
                                                ];
                                            </script>
                                            @foreach($product->images()->orderBy("priority", "ASC")->where('link', '=', "")->extension(['gif'])->get() as $gif)
                                                <div class="swiper-slide">
                                                    <div class="product-item-content">
                                                        <a href="javascript:void(0)"
                                                           data-index="2000"
                                                           data-original-image="{{url($gif->getImagePath())}}"
                                                           data-zoom-image="{{url($gif->getImagePath())}}">
                                                            <img src="{{url($gif->getImagePath())}}"
                                                                 alt="{{$gif->caption ? : $product->title}}"
                                                                 class="img-fluid">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach

                                            @foreach($product->images()->orderBy("priority", "ASC")->orderBy("priority", "ASC")->where('link', '!=', "")->get() as $clip)
                                                <div class="swiper-slide">
                                                    <div class="product-item-content video">
                                                        <a class="absolute-link" data-toggle="modal"
                                                           data-target="#clip{{$clip->id}}"></a>
                                                        <img src="{{url($clip->getImagePath())}}"
                                                             alt="clip{{$clip->id}}">
                                                    </div>
                                                </div>
                                            @endforeach

                                            @foreach($product->images()->orderBy("priority", "ASC")->where('link', '=', "")->notExtension(['gif'])->get() as $image)
                                                <div class="swiper-slide">
                                                    <div class="product-item-content">
                                                        <a href="javascript:void(0)"
                                                           data-index="{{$image->id}}"
                                                           data-original-image="{{url(ImageService::getImage($image, 'preview'))}}"
                                                           data-zoom-image="{{url(ImageService::getImage($image, 'original'))}}">
                                                            <img src="{{url(ImageService::getImage($image, 'preview'))}}"
                                                                 alt="{{$image->caption ? : $product->title}}">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="swiper-navigation">
                                        <div class="product-gallery-swiper-prev">
                                            <i class="fa fa-angle-up"></i>
                                        </div>
                                        <div class="product-gallery-swiper-next">
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>

                                </div>
                                <div class="popup_bg" style="display: none;"></div>
                            </div>
                            <div class="single-product-section single-product-center product-detail">
                                <div class="product-gallery-image product-center-section sb-product-gallery-image">
                                    <a href="javascript:void(0)" id="product-gallery-image" class="magnifier">
                                        <img data-index="0"
                                             src="{{url(ImageService::getImage($product, 'preview'))}}"
                                             data-high-res-img="{{url(ImageService::getImage($product, 'original'))}}"
                                             class="gallery-items"
                                             alt="{{$product->title}}">

                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-11 col-sm-12 content">
                    <div product-box
                         data-product-id="{{$product->id}}" product-price="{{$product->latest_price}}"
                         data-discount-group="{{json_encode($product->discountGroup)}}">
                        <div class="header">
                            <div class="pg-title">{{$product->title}}</div>
                            <div class="product-code">
                                <div class="title">کد کالا:</div>
                                <span>{{$product->code}}</span>
                            </div>
                        </div>

                        <div class="product-property-wrapper">
                            <div class="title-wrapper">
                                <div class="title">ویژگی‌ها</div>
                            </div>
                            <div class="row">
                                @foreach($attributes as $keyId => $attribute)
                                    @if($attribute->show_type === PSAttrKeyShowType::NORMAL)
                                        <div class="product-property col-md-4">
                                            <div class="property-title">{{ $attribute->title }}</div>
                                            @foreach($attribute->values as $valIndex => $value)
                                                <span class="property-value p-structure-value">
                                                {{ $value->name }}
                                                    @if($valIndex+1 != count($attribute->values))
                                                        ،
                                                    @endif
                                            </span>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                                @foreach($product->getExtraProperties() as $property)
                                    @if($property->key == "availability_type")
                                            <?php $availability_flag = true ?>
                                            <?php $availability_value = $property->value ?>
                                    @elseif($property->type != 9)
                                        <div class="product-property col-md-4">
                                            <div class="property-title">{{ $property->key }}</div>
                                            <span class="property-value">{{$property->value}}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <?php $colorModels = get_product_color_models($product); $count = 1 ?>
                        @if($colorModels != null and count($colorModels) > 1)
                            <div class="section product-models" id="models-container">
                                <div class="title-wrapper">
                                    <div class="title">سایر رنگ ها</div>
                                </div>
                                <div class="product-models-wrapper">
                                    @foreach($colorModels as $index => $colorModel)
                                        <div class="model-item @if($colorModel->color_code == $product->color_code) active @endif">
                                            <a href="{{$colorModel->getFrontUrl()}}">
                                                <div class="img-container">
                                                    <img src="{{url(ImageService::getImage($colorModel, 'thumb'))}}"
                                                         class="model-thumb img-fluid" alt="{{$colorModel->title}}">
                                                </div>
                                            </a>
                                        </div>
                                            <?php $count++ ?>
                                    @endforeach
                                </div>
                                @if($count > 6)
                                    <div class="overflow-btn"></div>
                                @endif
                            </div>
                        @endif

                        @if($product->is_location_limited)
                            <div class="delivery-notice">
                                <img src="/HCMS-assets/img/icons/delivery-green.svg" class="icon">
                                ارسال فقط
                                {{($product?->location_limitations[0] ?? null)?->getCity()?->name}}
                            </div>
                        @endif

                        <div class="product-notice">{!! $product->notice !!}</div>
                        <div class="footer">
                            @if($product->is_active)
                                <div class="price">
                                    <div class="price-title">قیمت واحد</div>
                                    @if($product->has_discount)
                                        <span class="before-special-offer digit">
                                                <strike>
                                                    <span class="digit price-data">{{$product->previous_price}}</span>
                                                </strike>
                                                </span>
                                    @endif
                                    <div class="product-price value">
                                        <span class="digit price-data">{{$product->latest_price}}</span>
                                        <span>تومان</span>
                                    </div>
                                </div>
                                <div class="counter-input">
                                    <div class="cart-row" data-product-id="{{$product->id}}">
                                        @include("_product-counter-box", ["item" => $product])
                                    </div>
                                </div>
                            @else
                                @if($product->inaccessibility_type ==1)
                                    <div class="price">
                                        <span>در حال حاضر این کالا موجود نیست،<br>  برای اطلاع از موجود شدن کالا روی دکمه زیر کلیک کنید.   </span>
                                    </div>
                                    @if(!$product->is_needed)
                                        <a href="{{route('customer.need-list.attach-product', $product)}}"
                                           class="btn add-need-list" title="موجود شد خبرم کن">
                                            <div class="btn-add-basket-text">موجود شد خبرم کن</div>
                                            <div class="btn-add-basket-icon">
                                                <i class="fa fa-bell-o"></i>
                                            </div>
                                        </a>
                                    @else
                                        <div class="active-info order">
                                            <span>به محض موجود شدن کالا به شما اطلاع میدهیم.</span>
                                        </div>
                                    @endif
                                @elseif($product->inaccessibility_type ==2)
                                    @if($availability_flag)
                                        @if($availability_value == 1)
                                            <div class="price"><span>در حال تامین</span></div>
                                            @if(!$product->is_needed)
                                                <a href="{{route('customer.need-list.attach-product', $product)}}"
                                                   class="btn add-need-list" title="موجود شد خبرم کن">
                                                    <div class="btn-add-basket-text">موجود شد خبرم کن</div>
                                                    <div class="btn-add-basket-icon">
                                                        <i class="fa fa-bell-o"></i>
                                                    </div>
                                                </a>
                                            @else
                                                <div class="active-info order">
                                                    <span>به محض موجود شدن کالا به شما اطلاع میدهیم.</span>
                                                </div>
                                            @endif
                                        @elseif($availability_value == 2)
                                            <div class="price"><span>به زودی</span></div>
                                            @if(!$product->is_needed)
                                                <a href="{{route('customer.need-list.attach-product', $product)}}"
                                                   class="btn add-need-list" title="موجود شد خبرم کن">
                                                    <div class="btn-add-basket-text">موجود شد خبرم کن</div>
                                                    <div class="btn-add-basket-icon">
                                                        <i class="fa fa-bell-o"></i>
                                                    </div>
                                                </a>
                                            @else
                                                <div class="active-info order">
                                                    <span>به محض موجود شدن کالا به شما اطلاع میدهیم.</span>
                                                </div>
                                            @endif
                                        @elseif($availability_value == 3)
                                            <div class="price"><span>توقف تولید</span></div>
                                            <a href="{{$product->directory->getFrontUrl()}}" class="btn add-need-list"
                                               title="مشاهده محصولات مشابه {{$product->directory->title}}">
                                                <div class="btn-add-basket-text">مشاهده محصولات مشابه</div>
                                                <div class="btn-add-basket-icon">
                                                    <i class="fa fa-folder-o"></i>
                                                </div>
                                            </a>
                                        @endif
                                    @else
                                        <div class="price"><span>برای اطلاع از قیمت تماس بگیرید.</span></div>
                                        <a href="tel:" class="btn add-need-list"
                                           title="تماس بگیرید">
                                            <div class="btn-add-basket-text">تماس بگیرید</div>
                                            <div class="btn-add-basket-icon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                        </a>
                                    @endif
                                @endif
                            @endif
                        </div>
                        @include("_special-discount", compact("product"))

                        @if(isset($model_options->items) and count($model_options->items) > 1)
                            <div class="section product-models">
                                <div class="title-wrapper">
                                    <div class="title">@lang($model_options->title)</div>
                                </div>
                                <div class="product-models-wrapper">
                                        <?php $countSize = 1 ?>
                                    @foreach($model_options->items as $item)
                                        <a href="{{ url('/product/'. $item->product_id)}}">
                                            <div class="model-item model-small size @if($item->product_id == $product->id) active @endif">
                                                {{join(" | ", $item->name)}}
                                            </div>
                                        </a>
                                            <?php $countSize++ ?>
                                    @endforeach
                                </div>
                                @if($countSize > 6)
                                    <div class="overflow-btn overflow-size"></div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 side-content">
                    <ul>
                        <li><a href="{{$product->is_liked ?
                    route('customer.wish-list.detach-product', $product) :
                    route('customer.wish-list.attach-product', $product)}}"
                               class="btn like" title="Like">
                                <svg version="1.1"
                                     id="svg2" xmlns:cc="http://creativecommons.org/ns#"
                                     xmlns:dc="http://purl.org/dc/elements/1.1/"
                                     xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                     xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="-290 382 30 30"
                                     style="enable-background:new -290 382 30 30;" xml:space="preserve">
                                <g id="g10" transform="matrix(1.3333333,0,0,-1.3333333,0,146.66667)">
                                    <g id="g12" transform="scale(0.1)">
                                        <path id="path14"
                                              style="fill:#f1f1f1;stroke:#000000;stroke-width:10;stroke-miterlimit:10;"
                                              d="M-2001.8-1816c-9.1,9.1-21.2,14.1-34,14.1c-12.8,0-25-5-34.1-14.1l-4.7-4.7l-4.8,4.8
			c-9.1,9.1-21.3,14.2-34.1,14.2c-12.8,0-25-5-34-14.1c-9.1-9.1-14.1-21.3-14.1-34.1s5-25,14.2-34l69.1-69.1
			c0.9-0.9,2.2-1.5,3.5-1.5c1.2,0,2.6,0.5,3.5,1.5l69.3,69.1c9.1,9.1,14.1,21.3,14.1,34.1C-1987.8-1837.1-1992.7-1825-2001.8-1816"
                                        />
                                        @if($product->is_liked)
                                            <path id="path14_1_"
                                                  style="fill:#ff0000;stroke:#ff0000;stroke-width:10;stroke-miterlimit:10;"
                                                  d="M-1999.6-1813.2c-9.4,9.3-21.9,14.5-35.3,14.5c-13.4,0-25.9-5.2-35.3-14.5l-4.9-4.9l-4.9,4.9
			c-9.4,9.3-22,14.6-35.3,14.6s-25.9-5.2-35.3-14.5c-9.4-9.4-14.6-21.7-14.6-35s5.2-25.6,14.7-34.9l71.7-71c1-1,2.3-1.5,3.6-1.5
			s2.6,0.5,3.6,1.5l71.8,70.9c9.4,9.4,14.6,21.7,14.6,35C-1985-1834.8-1990.1-1822.5-1999.6-1813.2"/>
                                        @endif
                                    </g>
                                </g>
                    </svg>
                            </a></li>
                        <li>
                            <div class="btn share" title="Share">
                                <svg version="1.1"
                                     id="svg2" xmlns:svg="http://www.w3.org/2000/svg"
                                     xmlns:cc="http://creativecommons.org/ns#"
                                     xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                     xmlns:dc="http://purl.org/dc/elements/1.1/"
                                     xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                     x="0px"
                                     y="0px" viewBox="-293 384 25 25"
                                     style="enable-background:new -293 384 25 25;" xml:space="preserve">
<g id="g10" transform="matrix(1.3333333,0,0,-1.3333333,0,6.6666667)">
    <g id="g12" transform="scale(0.1)">
        <path id="path14" d="M-2058.8-2948.4c-8.8,0-16.8-3.9-21.8-10.1l-42.2,22.3c1,2.7,1.5,5.6,1.5,8.6c0,3-0.5,5.9-1.5,8.6l42.2,22.2
			c5-6.2,12.9-10.2,21.8-10.2c15.2,0,27.5,11.6,27.5,25.9s-12.3,25.9-27.5,25.9c-15.2,0-27.5-11.6-27.5-25.9c0-3,0.5-5.9,1.5-8.6
			l-42.2-22.2c-5,6.2-12.9,10.2-21.8,10.2c-15.2,0-27.5-11.6-27.5-25.9c0-14.3,12.4-25.9,27.5-25.9c8.9,0,16.8,4,21.8,10.2
			l42.2-22.3c-1-2.7-1.6-5.6-1.6-8.7c0-14.3,12.3-25.9,27.5-25.9c15.2,0,27.5,11.6,27.5,25.9
			C-2031.2-2960.1-2043.6-2948.4-2058.8-2948.4z M-2058.8-2863.4c10.4,0,18.9-8,18.9-17.8s-8.4-17.8-18.9-17.8
			c-10.4,0-18.9,8-18.9,17.8S-2069.1-2863.4-2058.8-2863.4z M-2148.7-2945.6c-10.4,0-18.9,8-18.9,17.8s8.4,17.8,18.9,17.8
			c10.4,0,18.9-8,18.9-17.8C-2129.9-2937.6-2138.4-2945.6-2148.7-2945.6z M-2058.8-2992.1c-10.4,0-18.9,8-18.9,17.8
			s8.4,17.8,18.9,17.8c10.4,0,18.9-8,18.9-17.8S-2048.3-2992.1-2058.8-2992.1"/>
    </g>
</g>
</svg>
                            </div>
                            <ul class="share-list">
                                <li>
                                    <a href="http://www.linkedin.com/shareArticle?url={{$product->getFrontUrl()}}&amp;title={{$product->title}}"
                                       target="_blank">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://telegram.me/share/url?url={{$product->getFrontUrl()}}"
                                       target="_blank">
                                        <i class="fa fa-paper-plane"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.facebook.com/sharer/sharer.php?u={{$product->getFrontUrl()}}"
                                       target="_blank">
                                        <i class="fa fa-facebook-f"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="rating-content">
                        <div class="rating-container" data-rate="{{$product->average_rating}}"
                             data-active="on" data-action="{{route('customer.rate.product', $product)}}"></div>
                        <p>از {{$product->rates_count}} رای</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row product-details">
            <div class="col">
                <div class="title-wrapper">
                    <div class="title">معرفی محصول</div>
                </div>
                <div class="product-description">
                    {!! $product->description !!}
                    <div class="detailed-properties">
                        @foreach($product->attributeKeys()->whereShowType(PSAttrKeyShowType::DETAILS)->get() as $attributeKey)
                            <div class="product-property">
                                <div class="title">{{ $attributeKey->title }}:</div>
                                @foreach($product->pAttributes()->where('p_structure_attr_key_id', '=', $attributeKey->id)
                                    ->with('value', 'key')->get() as $pAttr)
                                    <a href="/small-wares?tag={{$pAttr->value->id .'&/'. $pAttr->getUrlHash()}}"
                                       title="{{$pAttr->value->name}}">
                                        <div class="p-structure-value">{{$pAttr->value->name}}</div>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <?php $accessories = get_product_accessories($product); ?>
            @if(isset($accessories) and $accessories != null and count($accessories) > 0)
                <div class="col-lg-5 col-md-5">
                    <div class="title-wrapper">
                        <div class="title">لوازم مصرفی و اکسسوری این کالا</div>
                    </div>


                    <div class="swiper-container product-accessories">
                        <div class="swiper-wrapper">
                            @foreach($accessories as $index => $model)
                                <div class="swiper-slide">
                                    @include("_product-box", ["item" => $model])
                                </div>
                            @endforeach
                        </div>

                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                </div>
            @endif
        </div>
    </div>

    <div class="related-pd">
        <div class="container-fluid">
            <div class="title-wrapper">
                <div class="title">محصولات مرتبط</div>
            </div>
            <div class="row">
                @foreach(get_product_related_products($product, 5) as $relatedProduct)
                    <div class="col-xl-25 col-lg-3 col-md-6 col-sm-6">
                        @include("_product-box", ["item" => $relatedProduct])
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @foreach($product->images()->orderBy("priority", "ASC")->where('link', '!=', "")->get() as $clip)
        <div class="modal fade video-popup" id="clip{{$clip->id}}" tabindex="-1" role="dialog"
             aria-labelledby="productVideoLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <iframe src="{{url($clip->link)}}"></iframe>
                    <div class="close" data-dismiss="modal"><i class="fa fa-close"></i></div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('back_to_top_class')
    back-to-top-product-single
@endsection

@section('footer_class')
    padding-bottom
@endsection

@section('extra_js')
    @include("_product-rich-snippet", compact("product"))
    @include("_product-extras", compact("product"))
@endsection
