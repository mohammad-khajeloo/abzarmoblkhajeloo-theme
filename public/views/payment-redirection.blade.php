@extends('_base')

@section('title')
    انتقال به صفحه‌ی پرداخت -
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
    <script>window.currentPage = "payment-redirection"</script>
    <div class="container payment-redirection" id="payment-redirection">
        <div class="icon-title">
            <i class="fa fa-external-link-square" aria-hidden="true"></i>
            <span>انتقال به صفحه پرداخت</span>
        </div>
        <div class="top-line-content">
            <p class="bg-success" id="success-message" style="padding: 10px;">
                در حال ارسال اطلاعات برای درگاه پرداخت،
                <br/> لطفا صبر کنید...
            </p>
            <p class="bg-danger" id="danger-message" style="padding: 10px;display: none;">
                متاسفانه انتقال شما با مشکل مواجه شده است.<br/>
                <a href="{{route('customer.invoice.index')}}" title="بازگشت به صفحه سفارشات">بازگشت به صفحه سفارشات</a>
            </p>
            <form method="{{$form->method}}" id="redirection-form" style="display: none;" action="{{$form->action}}">
                @foreach($form->attributes as $attribute)
                    <input type="hidden" name="{{$attribute->name}}" value="{{$attribute->value}}">
                @endforeach
            </form>
        </div>
    </div>
@endsection

@section('footer_class') border-top @endsection