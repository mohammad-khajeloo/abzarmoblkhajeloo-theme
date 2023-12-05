@extends('_base')

@section('title')
    لیست علاقه‌مندی‌ها -
@endsection

@section('main_content')
    <script>window.currentPage = "favorites"</script>
    <div class="container favorites" id="favorites">
        <div class="icon-title">
            <i class="icon-favorite" aria-hidden="true"></i><span>علاقه‌مندی‌ها</span>
        </div>
        <div class="top-line-content">
            <div class="row">
                @foreach($wishList as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        @include("_product-box", ["item" => $product, "remove_cart_button" => true])
                    </div>
                @endforeach
            </div>
            @if(count($wishList) == 0)
                <div class="empty-favorites">
                    <p>محصولی هنوز به علاقه مندی شما اضافه نشده است.</p>
                    <a href="{{ route('public.home') }}" title="مشاهده محصولات">مشاهده محصولات</a>
                </div>
            @endif
        </div>
    </div>
@endsection
