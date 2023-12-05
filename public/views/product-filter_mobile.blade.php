@extends('_base')
@include("_product-filter-header")
@section('main_content')
    <script>window.currentPage = "product-filter"</script>
    <div class="side-filter options" data-open=".btn.filter-btn"
         data-close=".side-filter .btn.submit, .side-filter .gray-layer">
        <div class="gray-layer"></div>
        <div class="filter-content">
            <h1 class="title">فیلترها<i class="fa fa-sliders" aria-hidden="true"></i></h1>
            <div class="content">
                <div class="loading-protector-layer is-loading"></div>
                <div class="op-item">
                    <div class="price-range">
                        <div class="op-title"><i class="icon-price" aria-hidden="true"></i>
                            قیمت<span class="unit">(تومان)</span>
                        </div>
                        <div class="value" data-model="filter.price_range">
                            <span class="range-separator">از</span>
                            <input class="price-number" act="price" data-key='{"rtl":1, "ltr":0}' disabled/>
                            <span class="range-separator">تا</span>
                            <input class="price-number" act="price" data-key='{"rtl":0, "ltr":1}' disabled/>
                        </div>
                    </div>
                    <div act="price-range" data-filter-id="price-range" data-model="filter.price_range"
                         data-start="{{$price_range['min']}}"
                         data-end="{{$price_range['max']}}"></div>
                </div>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @if(count($colors) > 0)
                        <div class="panel">
                            <div class="panel-heading" role="tab" id="heading-color">
                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                   href="#mb-collapse-color" title="رنگ"
                                   aria-expanded="false" aria-controls="mb-collapse-color"
                                   data-category-id="colors" class="collapsed">
                                    <h4 class="panel-title">
                                        رنگ<i class="fa fa-angle-left" aria-hidden="true"></i>
                                    </h4></a>
                            </div>
                            <div id="mb-collapse-color" class="panel-collapse collapse colors" role="tabpanel"
                                 aria-labelledby="heading-color" aria-expanded="false">
                                <ul class="panel-body"
                                    act="filter-control" data-filter-id="colors"
                                    data-type="multi" data-is-colors="true">
                                    @foreach($colors as $color)
                                        <li class="checkbox"
                                            act="filter-option"
                                            data-alias="{{$color->name}}"
                                            data-value='{{$color->id}}'>
                                            <label class="checkbox-lb">
                                                <input type="checkbox" value="{{$color->id}}"/>
                                                {{$color->name}}
                                                <span class="bg-checked"></span>
                                                <i class="color-box" style="background: {{$color->hex_code}}"></i>
                                            </label>
                                        </li>

                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @foreach($keys as $key)
                        <div class="panel">
                            <div class="panel-heading" role="tab" id="heading-{{$key->id}}">
                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapse-{{$key->id}}" title="{{$key->title}}"
                                   aria-expanded="false" aria-controls="collapse-{{$key->id}}"
                                   data-category-id="{{$key->id}}" class="collapsed">
                                    <h4 class="panel-title">
                                        {{$key->title}}<i class="fa fa-angle-left" aria-hidden="true"></i>
                                    </h4></a>
                            </div>
                            <div id="collapse-{{$key->id}}" class="panel-collapse collapse " role="tabpanel"
                                 aria-labelledby="heading-{{$key->id}}" aria-expanded="false">
                                <div class="panel-body">
                                    <ul act="filter-control" data-filter-id="{{ $key->title }}"
                                        data-type="multi">
                                        @foreach($key->values as $value)
                                            <li class="checkbox"
                                                act="filter-option" data-alias="{{$value->name}}"
                                                data-value='{{$value->id}}'>
                                                <label class="checkbox-lb">
                                                    <input type="checkbox" value="{{$value->id}}"/>
                                                    {{$value->name}}
                                                    <span class="filter-en-title">{{$value->en_name}}</span>
                                                    <span class="bg-checked"></span>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="footer">
                <button type="button" data-toggle="side-filter" aria-expanded="false"
                        class="form-control btn submit" data-text="اعمال فیلترها">
                    <span class="text">اعمال فیلترها</span>
                </button>
            </div>
        </div>
    </div>
    <div class="side-categories options" data-open=".btn.categories-btn"
         data-close=".side-categories .btn.submit, .side-categories .gray-layer">
        <div class="gray-layer"></div>
        <div class="filter-content" id="product-category-service">
            @if(isset($directory))
                @if($directory->directories()->count() > 0)
                    <div class="title">{{$directory->title}}<i class="fa fa-sliders" aria-hidden="true"></i></div>
                    <div class="content">
                        @foreach($directory->directories()->orderBy("priority", "ASC")->get() as $subDirectory)
                            <div class="checkbox">
                                <label class="checkbox-lb" data-href="{{$subDirectory->getFrontUrl()}}">
                                    <input type="radio" name="category" value="{{$subDirectory->id}}"/>
                                    {{$subDirectory->title}}
                                    <span class="bg-checked"></span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                @elseif($directory->parentDirectory != null)
                    <div class="title">
                        <a href="{{$directory->parentDirectory->getFrontUrl()}}"
                           title="{{$directory->parentDirectory->title}}">
                            {{$directory->parentDirectory->title}}
                        </a>
                        <i class="fa fa-sliders" aria-hidden="true"></i>
                    </div>
                    <div class="content">
                        @foreach($directory->parentDirectory->directories()->orderBy("priority", "ASC")->get() as $subDirectory)
                            <div class="checkbox">
                                <label class="checkbox-lb" @if($directory->id == $subDirectory->id) > @else
                                        data-href="{{$subDirectory->getFrontUrl()}}">
                                    @endif

                                    <input type="radio" name="category" value="{{$subDirectory->id}}"
                                           @if($directory->id == $subDirectory->id) checked disabled @endif/>

                                    {{$subDirectory->title}}
                                    <span class="bg-checked"></span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endif
            @elseif(count($directories) > 0)
                <div class="title">دسته‌بندی‌ها<i class="fa fa-sliders" aria-hidden="true"></i></div>
                <div class="content">
                    @foreach($directories as $subDirectory)
                        <div class="checkbox">
                            <label class="checkbox-lb" data-href="{{$subDirectory->getFrontUrl()}}">
                                <input type="radio" name="category" value="{{$subDirectory->id}}"/>
                                {{$subDirectory->title}}
                                <span class="bg-checked"></span>
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif
            {{-- for each sub category item / End --}}

            <div class="footer">
                <button type="button" data-toggle="side-filter" aria-expanded="false"
                        class="form-control btn submit" data-text="انتخاب دسته">
                    <span class="text">انتخاب دسته</span>
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid background-white">
        <div class="loading-protector-layer"></div>
        <div class="applied-filters">
            <ul class="chips filter-option-tag-container"></ul>
        </div>
    </div>

    <div class="container-fluid">
        <div class="pd-list">
            <div class="row options">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="sort-by">
                        <div class="op-title">مرتب سازی بر اساس</div>
                        <div class="dropdown form-group">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" class="form-control" act="filter-monitor"
                                    data-filter-id="sort">
                                جدید ترین
                            </button>
                            <ul class="dropdown-menu" act="filter-control" data-filter-id="sort"
                                data-type="single">
                                <li act="filter-option" data-alias="گرانترین"
                                    data-value='{"field":"latest_price", "method":"DESC"}'>
                                    <a>گرانترین</a>
                                </li>
                                <li act="filter-option" data-alias="ارزان ترین"
                                    data-value='{"field":"latest_price", "method":"ASC"}'>
                                    <a>ارزان ترین</a>
                                </li>
                                <li act="filter-option" data-alias="جدید ترین"
                                    data-value='{"field":"id", "method":"DESC"}'>
                                    <a>جدید ترین</a>
                                </li>
                                <li act="filter-option" data-alias="محبوب‌ترین"
                                    data-value='{"field":"average_rating", "method":"DESC"}'>
                                    <a>محبوبترین</a>
                                </li>
                                <li act="filter-option" data-alias="تخفیف‌"
                                    data-value='{"field":"has_discount", "method":"DESC"}'>
                                    <a>تخفیف</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <h2 class="page-title-md">
                        @if(isset($directory))
                            {{$directory->title}}
                        @elseif(isset($product_filter))
                            {{$product_filter->title}}
                        @else
                            جستجو برای "{{ $query }}"
                        @endif
                    </h2>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <h5 class="product-count">
                        <span class="price-data" id="products-counts">0</span>&nbsp;
                        محصول یافت شده
                    </h5>
                </div>
            </div>

            <div class="pd-list-content">
                <div id="products-wrapper">
                    <div class="row filter-result-container" id="filter-result-container"
                         @if(isset($directory))
                             data-directory-id="{{$directory->id}}"
                         @elseif(isset($product_filter))
                             data-product-filter-id="{{$product_filter->id}}"
                         @else
                             data-query="{{$query}}"
                            @endif ></div>
                    <div class="row filter-loading-container is-loading" id="filter-loading-container">
                        <div class="filter-loading-layer">
                            @for($i=0; $i<2; $i++)
                                <div class="col-xl-25 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="product-item loading">
                                        <div class="product-pic"></div>

                                        <div class="pd-item-md-details">
                                            <div class="rating-value">
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <div class="product-title"></div>
                                            <div class="product-price"></div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--show if the page has subcategorie / Start--}}
    <div class="md-categories">
        <div class="row">
            <div class="col-sm-6 col-xs-6">
                <button type="button" data-toggle="side-categories" class="form-control btn categories-btn"
                        data-text="دسته بندی ها">
                    <span class="text">دسته بندی ها</span>
                </button>
            </div>
            <div class="col-sm-6 col-xs-6">
                <button type="button" data-toggle="side-filter" class="form-control btn filter-btn" data-text="فیلترها">
                    <span class="text">فیلترها</span>
                </button>
            </div>
        </div>
    </div>
    {{--show if the page has subcategorie / End--}}
@endsection

@section('back_to_top_class')
    back-to-top-product-list
@endsection


@section('footer_class')
    padding-bottom
@endsection
