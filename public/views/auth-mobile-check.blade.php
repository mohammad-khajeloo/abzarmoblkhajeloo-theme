@extends('_base')

@section('title')
    تایید مالکیت تلفن همراه -
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

    <script>window.currentPage = "auth-mobile-check"</script>
    <div class="container mobile-auth">
        <div class="icon-title">
            <i class="fa fa-question" aria-hidden="true"></i><span>تایید مالکیت تلفن همراه</span>
        </div>
        <div class="extra-link-container">
            <a href="{{route('customer-auth.send-auth-confirm', ['mobile', $value])}}" class="extra-link" title="ارسال مجدد کد">
                ارسال مجدد کد
            </a>
            <a href="{{route('customer-auth.show-auth', 'email')}}" class="extra-link pull-left" title="ارسال کد از طریق ایمیل">
                ارسال کد از طریق ایمیل
            </a>
        </div>
        <div class="top-line-content">
            <form class="" action="{{route("customer-auth.do-check", ["mobile", $value])}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="one_time_code">کد ۴ رقمی ارسال شده را وارد کنید.<span class="required">*</span></label>
                    <input type="text" class="form-control number-control" name="one_time_code"
                           placeholder=""
                           value="{{old('one_time_code')}}">
                </div>
                <button type="submit" class="btn submit" data-text="تایید"><span class="text">تایید</span></button>
            </form>
        </div>
    </div>
@endsection

