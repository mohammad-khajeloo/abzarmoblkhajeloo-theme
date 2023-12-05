@extends('_base')

@section('title')
    {{ $directory->title }} -
@endsection

@section('meta_tags')
    <link rel="canonical" href="{{ $directory->getFrontUrl() }}"/>

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="category" content="">
    <meta itemprop="description" content="">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:type" content="article">
@endsection

@section('main_content')
    <script>window.currentPage = "blog-list"</script>
    <div class="articles">
        <div class="container">
            <div class="slider">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                    @foreach($articles as $article)
                        <div class="swiper-slide">
                            <div class="article-box">
                                <a href="{{ $article->getFrontUrl() }}" class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                                    <div class="pic"
                                         style="background:url({{ ImageService::getImage($article, 'original') }}) 50% 50% /cover;">
                                    </div>
                                </a>
                                <div class="details col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                    <a href="{{ $article->getFrontUrl() }}">
                                        <h2 class="title">{{ $article->title }}</h2>
                                    </a>
                                    <div class="date">
                                        {{ $article->directory->title }}
                                        - {{ TimeService::getFormalDateFrom($article->created_at) }}
                                    </div>
                                    <a href="{{ $article->getFrontUrl() }}" class="hidden-sm hidden-xs">
                                        <div class="desc">
                                            {{ $article->short_content }}
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>

        <div class="featured-articles-wrapper">
            <div class="container">
                <div class="row">
                    <aside class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
                        <div class="side-item">
                            <div class="section-title">دسته بندی ها</div>
                            <ul class="categories">
                                @foreach(get_blog_categories($directory) as $blogCategory)
                                    <li>
                                        <a href="{{ $blogCategory->getFrontUrl() }}">
                                            <i class="fa fa-angle-left"></i>
                                            <h3 class="title">{{ $blogCategory->title }}</h3>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                    <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
                        @if($articles->currentPage() == 1)
                            <h1 class="section-title">پیشنهادهای سردبیر</h1>
                            <div class="featured-articles">
                                <div class="row">
                                    @foreach(get_popular_blog(4, 'blog') as $popularBlog)
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                            <div class="featured-article-item">
                                                <a href="{{ $popularBlog->getFrontUrl() }}">
                                                    <div class="pic">
                                                        <img src="{{ ImageService::getImage($popularBlog, 'thumb') }}"
                                                             class="img-fluid" alt="{{ $popularBlog->title }}">
                                                    </div>
                                                </a>
                                                <a href="{{ $popularBlog->getFrontUrl() }}"><h5
                                                            class="title">{{ $popularBlog->title }}</h5></a>
                                                <div class="date">
                                                    {{ $popularBlog->directory->title }}
                                                    / {{ TimeService::getDateFrom($popularBlog->created_at) }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <div class="all-articles">
            <div class="container">
                <div class="section-title">سایر خبرها</div>
                <div class="row">
                    @foreach($articles as $article)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="article-box">
                                <a href="{{ $article->getFrontUrl() }}">
                                    <div class="pic">
                                        <img src="{{ ImageService::getImage($article, 'thumb') }}"
                                             alt="{{ $article->title }}"
                                             class="img-fluid">
                                    </div>
                                </a>
                                <a href="{{ $article->getFrontUrl() }}">
                                    <h4 class="title">{{ $article->title }}</h4>
                                </a>
                                <div class="date">{{ TimeService::getFormalDateFrom($article->created_at) }}</div>
                                <div class="short-desc">{{ $article->short_content }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @include('_pagination', [
                    'currentPage' => $articles->currentPage(),
                    'lastPage' => $articles->lastPage(),
                ])
            </div>
        </div>
    </div>
@endsection
