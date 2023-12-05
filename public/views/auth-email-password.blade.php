@extends('_base')

@section('title')
    ورود -
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
    <script>window.currentPage = "auth-email-password"</script>
    <div class="container mobile-auth">
        <div class="icon-title">
            <i class="icon-login" aria-hidden="true"></i><span>ورود‌ با رمزعبور</span>
        </div>
        <div class="extra-link-container">
            <a href="{{route('customer-auth.send-auth-confirm', ['email', $value])}}" class="extra-link right" title="ورود با کد یکبارمصرف">
                ورود با کد یکبارمصرف
            </a>
        </div>
        <div class="top-line-content">
            <form class="" action="{{route("customer-auth.do-password-auth", ['email', $value])}}" method="post">
                {{ csrf_field() }}
                @if($errors->has('g-recaptcha-response'))
                    <p class="bg-warning" style="padding: 10px;">
                        لطفا دوباره تلاش کنید.
                    </p>
                @endif
                <div class="form-group">
                    <label for="password">
                        برای ورود‌
                        <b>رمزعبور</b>
                        خود را وارد کنید.
                        <span class="required">*</span>
                    </label>
                    <input type="password" class="form-control" name="password" placeholder="">
                </div>
                @if(recaptcha_enabled()) @captcha('fa') @endif
                <button type="submit" class="btn submit" data-text="ورود"><span class="text">ورود</span></button>
            </form>
        </div>
    </div>
@endsection

