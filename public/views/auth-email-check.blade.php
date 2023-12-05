@extends('_base')

@section('title')
    تایید مالکیت ایمیل -
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

    <script>window.currentPage = "auth-email-check"</script>
    <div class="container mobile-auth">
        <div class="icon-title">
            <i class="fa fa-question" aria-hidden="true"></i><span>تایید مالکیت ایمیل</span>
        </div>
        <div class="extra-link-container">
            <a href="{{route("customer-auth.send-auth-confirm", ["email", $value])}}" class="extra-link" title="ارسال مجدد ایمیل">
                ارسال مجدد ایمیل
            </a>
            <a href="{{route('customer-auth.show-auth', 'mobile')}}" class="extra-link pull-left" title="ارسال کد از طریق تلفن همراه">
                ارسال کد از طریق تلفن همراه
            </a>
        </div>
        <div class="top-line-content">
            <form class="" action="{{route("customer-auth.do-check", ["email", $value])}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="one_time_code">کد ۴ رقمی ارسال شده را وارد کنید.<span class="required">*</span></label>
                    <input type="text" class="form-control number-control" name="one_time_code"
                           placeholder=""
                           value="{{old('one_time_code')}}">
                </div>
                <button type="submit" class="btn submit">تایید</button>
            </form>
        </div>
    </div>
@endsection

