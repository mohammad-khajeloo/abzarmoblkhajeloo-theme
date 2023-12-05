@extends('_base')

@section('title')
    {{ $article->getSeoTitle() }} -
@endsection

@section('meta_tags')
    @include('_meta_tags', ['obj' => $article])
    <meta property="og:type" content="article">
@endsection

@section('main_content')
    <script>window.currentPage = "blog-single"</script>
    <div class="article-single">

        <div class="container">
            <ol class="breadcrumb hidden-md hidden-sm hidden-xs">
                @foreach($article->directory->getParentDirectories() as $parentDirectory)
                    <li><a href="{{$parentDirectory->url_full}}">{{$parentDirectory->title}}</a></li>
                @endforeach
                <li class="active">{{$article->title}}</li>
            </ol>

            <div class="row">
                <aside class="col-lg-3 col-md-4 hidden-sm hidden-xs">
                    <div class="side-item">
                        <div class="section-title">دسته بندی ها</div>
                        <ul class="categories">
                            @foreach(get_blog_categories($article->directory) as $blogCategory)
                                <li>
                                    <a href="{{ $blogCategory->getFrontUrl() }}">
                                        <i class="fa fa-angle-left"></i>
                                        <h3 class="title">{{ $blogCategory->title }}</h3>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="side-item">
                        <div class="section-title">محبوب‌ترین</div>
                        <div class="most-visited">
                            @foreach(get_popular_blog(3, 'blog') as $popularBlog)
                                <div class="item">
                                    <a href="{{ $popularBlog->getFrontUrl() }}">
                                        <div class="pic">
                                            <img src="{{ ImageService::getImage($popularBlog, 'thumb') }}"
                                                 class="img-fluid" alt="{{ $popularBlog->title }}">
                                        </div>
                                    </a>
                                    <a href="{{ $popularBlog->getFrontUrl() }}">
                                        <h4 class="title">{{ $popularBlog->title }}</h4>
                                    </a>
                                    <div class="date">

                                        {{ $popularBlog->directory->title }}
                                        / {{ TimeService::getDateFrom($popularBlog->created_at) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div hct-gallery="article_banners" hct-title='بنرها' hct-max-entry="1" hct-random-select>
                        <ul class="hidden-xl hidden-lg hidden-md hidden-sm hidden-xs hidden-xxs" hct-gallery-fields>
                            <li hct-gallery-field="banner_title" hct-title="عنوان بنر"></li>
                            <li hct-gallery-field="banner_link" hct-title="آدرس لینک"></li>
                        </ul>
                        <div class="side-item" hct-gallery-item>
                            <img hct-attr-src="{%- prop:image_path %}"
                                 alt="{%- ex-prop:banner_title %}" class="img-fluid"/>
                            <a target="_blank" href="{%- ex-prop:banner_link %}" title="" class="absolute-link"></a>
                        </div>
                    </div>
                </aside>

                <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                    <div class="article-content">
                        <div class="header">
                            <h1 class="title">{{ $article->title }}</h1>
                            <div class="date">
                                {{ $article->directory->title }} / {{ TimeService::getDateFrom($article->created_at) }}
                            </div>
                        </div>
                        <div class="pic">
                            <img src="{{ ImageService::getImage($article, 'original') }}" alt="{{ $article->title }}"
                                 class="img-fluid">
                        </div>
                        <div class="desc">
                            {{ $article->short_content }}
                            <hr/>
                            {!! $article->full_text !!}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="related-articles">
            <div class="container">
                <div class="title-wrapper">
                    <div class="title">دانستنی‌های مرتبط</div>
                </div>
                <div class="row">
                    @foreach(get_article_related_articles($article, 4) as $relatedArticle)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="article-box">
                                <div class="pic">
                                    <img src="{{ ImageService::getImage($relatedArticle, 'thumb') }}"
                                         alt="{{ $relatedArticle->title }}"
                                         class="img-fluid">
                                </div>
                                <a href="{{ $relatedArticle->getFrontUrl() }}">
                                    <h5 class="title">{{ $relatedArticle->title }}</h5>
                                </a>
                                <div class="date">{{ TimeService::getFormalDateFrom($relatedArticle->created_at) }}</div>
                                <div class="short-desc">{{ $relatedArticle->short_content }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection

@section('extra_js')
    @include('_article-rich-snippet', compact('article'))
@endsection