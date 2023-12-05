@extends('_base')
@include("_product-filter-header")
@section('main_content')
    <script>window.currentPage = "product-filter"</script>
    <div class="container-fluid background-white">
        <div class="loading-protector-layer"></div>
        <ol class="breadcrumb hidden-md">
            @if(isset($directory))
                @foreach($directory->getParentDirectories() as $parentDirectory)
                    <li>
                        <a href="{{$parentDirectory->getLandingUrl()}}"
                           title="{{$parentDirectory->title}}">
                            <h2>{{$parentDirectory->title}}</h2>
                        </a>
                    </li>
                @endforeach
            @elseif(isset($product_filter))
                <li><h2>{{$product_filter->title}}</h2></li>
            @else
                <li><h2>جستجو</h2></li>
            @endif
        </ol>
        <h1 class="page-title">
            @if(isset($directory))
                {{$directory->title}}
            @elseif(isset($product_filter))
                {{$product_filter->title}}
            @else
                جستجو برای "{{ $query }}"
            @endif
        </h1>


        <div class="applied-filters">
            <ul class="chips filter-option-tag-container"></ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="pd-list">
            <div class="row pd-list-content">
                <aside class="col col-xl-2 col-lg-3 col-md-4" id="filters-wrapper">
                    <div class="loading-protector-layer"></div>
                    <div class="filters" id="filters-container">
                        @if(isset($directory))
                            @if($directory->directories()->count() > 0)
                                <div class="panel-group">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <a href="{{$directory->getFrontUrl()}}" title="{{$directory->title}}">
                                                <h4 class="panel-title">{{$directory->title}}
                                                </h4>
                                            </a>
                                        </div>
                                        <div id="collapseCategories" class="panel-collapse collapse show">
                                            <div class="panel-body">
                                                <ul act="filter-control">
                                                    @foreach($directory->directories()->orderBy("priority", "ASC")->get() as $subDirectory)
                                                        <li>
                                                            <h2><a href="{{$subDirectory->getFrontUrl()}}"
                                                                   title="{{$subDirectory->title}}">
                                                                    {{$subDirectory->title}}
                                                                </a></h2>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($directory->parentDirectory != null)
                                <div class="panel-group">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <a class="accordion-toggle" title="{{$directory->parentDirectory->title}}"
                                               href="{{$directory->parentDirectory->getFrontUrl()}}">
                                                <h4 class="panel-title">{{$directory->parentDirectory->title}}</h4>
                                            </a>
                                        </div>
                                        <div id="collapseCategories" class="panel-collapse collapse show">
                                            <div class="panel-body">
                                                <ul act="filter-control">
                                                    @foreach($directory->parentDirectory->directories()->orderBy("priority", "ASC")->get() as $subDirectory)
                                                        <li @if($directory->id == $subDirectory->id) class="active" @endif>
                                                            <h2><a href="{{$subDirectory->getFrontUrl()}}"
                                                                   title="{{$subDirectory->title}}">
                                                                    {{$subDirectory->title}}
                                                                </a></h2>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @elseif(count($directories) > 0)
                            <div class="panel-group">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <a class="accordion-toggle" title="دسته‌بندی‌ها">
                                            <h6 class="panel-title">دسته‌بندی‌ها</h6>
                                        </a>
                                    </div>
                                    <div id="collapseCategories" class="panel-collapse collapse show">
                                        <div class="panel-body">
                                            <ul act="filter-control">
                                                @foreach($directories as $subDirectory)
                                                    <li>
                                                        <a href="{{$subDirectory->getFrontUrl()}}"
                                                           title="{{$subDirectory->title}}">
                                                            {{$subDirectory->title}}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="panel-group price-selector" id="price-filter">
                            <div class="panel">
                                <div class="panel-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" title="محدوده قیمت"
                                       href="#collapse-price">
                                        <h6 class="panel-title">محدوده قیمت<span class="unit">(تومان)</span>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </h6>
                                    </a>
                                </div>
                                <div id="collapse-price" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="price-range">
                                            <div class="value" data-model="filter.price_range">
                                                <span class="range-separator">از</span>
                                                <input class="price-number" act="price" data-key='{"rtl":1, "ltr":0}'
                                                       disabled/>
                                                <span class="range-separator">تا</span>
                                                <input class="price-number" act="price" data-key='{"rtl":0, "ltr":1}'
                                                       disabled/>
                                            </div>
                                        </div>
                                        <div class="price-slider" act="price-range" data-filter-id="price-range"
                                             data-model="filter.price_range"
                                             data-start="{{$price_range['min']}}"
                                             data-end="{{$price_range['max']}}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(count($colors) > 0)
                            <div class="panel-group" id="colors-filter">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" title="رنگ"
                                           href="#collapse-color">
                                            <h6 class="panel-title">رنگ
                                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                                            </h6>
                                        </a>
                                    </div>
                                    <div id="collapse-color" class="panel-collapse collapse">
                                        <div class="panel-body" act="filter-body">
                                            <div class="form-group filter-search">
                                                <input type="text" placeholder="جستجو در رنگ‌ها..."
                                                       class="form-control">
                                                <button class="btn" act="submit">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                                <button class="btn" act="clear" style="display: none">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                            <ul act="filter-control" data-filter-id="colors"
                                                data-type="multi" data-is-colors="true">
                                                @foreach($colors->sortBy('name') as $color)
                                                    <li act="filter-option"
                                                        data-alias="{{$color->name}}"
                                                        data-value='{{$color->id}}'>
                                                        <label class="checkbox-lb">
                                                            <input type="checkbox" value="{{$color->id}}"/>
                                                            {{$color->name}}
                                                            <span class="bg-checked"></span>
                                                            <i class="color-box"
                                                               style="background: {{$color->hex_code}}"></i>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(count($keys) > 0)
                            <div class="panel-group" id="attributes-filter">
                                    <?php $counter = 0 ?>
                                @foreach($keys as $key)
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <a class="accordion-toggle" data-toggle="collapse" title="{{$key->title}}"
                                               href="#collapse-attribute-{{$counter}}">
                                                <h6 class="panel-title">{{$key->title}}
                                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                </h6>
                                            </a>
                                        </div>
                                        <div id="collapse-attribute-{{$counter}}" class="panel-collapse collapse">
                                            <div class="panel-body" act="filter-body">
                                                <div class="form-group filter-search">
                                                    <input type="text" placeholder="جستجو در {{ $key->title }}..."
                                                           class="form-control">
                                                    <button class="btn" act="submit">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                    <button class="btn" act="clear" style="display: none">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                                <ul act="filter-control" data-filter-id="{{ $key->title }}"
                                                    data-type="multi">
                                                    @foreach($key->values as $value)
                                                        <li act="filter-option" data-alias="{{$value->name}}"
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
                                        <?php $counter++ ?>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </aside>
                <div class="col col-xl-10 col-lg-9 col-md-8 col-sm-12 col-xs-12" id="products-wrapper">
                    <div class="row options">
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                            <div class="sort-by">
                                <div class="op-title">مرتب‌سازی بر اساس:</div>
                                <div act="filter-control" data-filter-id="sort" data-type="single">
                                    <a class="op-item active" act="filter-option" data-alias="جدیدترین"
                                       data-value='{"field":"id", "method":"DESC"}'> جدیدترین</a>
                                    <a class="op-item" act="filter-option" data-alias="گران‌ترین"
                                       data-value='{"field":"latest_price", "method":"DESC"}'>گران‌ترین</a>
                                    <a class="op-item" act="filter-option" data-alias="ارزان‌ترین"
                                       data-value='{"field":"latest_price", "method":"ASC"}'>ارزان‌ترین</a>
                                    <a class="op-item" act="filter-option" data-alias="محبوب‌ترین"
                                       data-value='{"field":"average_rating", "method":"DESC"}'> محبوب‌ترین</a>
                                    <a class="op-item" act="filter-option" data-alias="تخفیف‌"
                                       data-value='{"field":"has_discount", "method":"DESC"}'> تخفیف</a>
                                    <?php $sort_data_title = get_structure_sort_title($keys); ?>
                                    @if($sort_data_title !== false)
                                        <a class="op-item" act="filter-option" data-alias="{{$sort_data_title}}  صعودی"
                                           data-value='{"field":"structure_sort_title", "method":"ASC"}'>
                                            {{$sort_data_title}} صعودی</a>
                                        <a class="op-item" act="filter-option" data-alias="{{$sort_data_title}} نزولی"
                                           data-value='{"field":"structure_sort_title", "method":"DESC"}'>
                                            {{$sort_data_title}} نزولی</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <h5 class="product-count">
                                <span class="price-data" id="products-counts">0</span>&nbsp;
                                محصول یافت شده
                            </h5>
                        </div>
                    </div>
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
                            @for($i=0; $i<5; $i++)
                                <div class="col-xl-25 col-lg-4 col-md-6 col-sm-6 col-xs-12 @if($i==1) hidden-xs @elseif($i==2)
                                        hidden-xs @elseif($i==3) hidden-sm hidden-xs @endif">
                                    <div class="product-item-loading">
                                        <div class="product-pic"></div>
                                        <div class="product-title"></div>

                                        <div class="product-footer">
                                            <div class="product-price"></div>
                                            <div class="rating-value">
                                                <i class="fa fa-star-o"></i>
                                            </div>
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

@endsection

@section('back_to_top_class')
    back-to-top-product-list
@endsection


@section('footer_class')
    padding-bottom
@endsection
