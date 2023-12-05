@extends('_base')

@section('title')
    تغییر رمز عبور -
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
    <script>window.currentPage = "change-password"</script>
    <div class="container password">
        <div class="icon-title">
            <i class="fa fa-question" aria-hidden="true"></i><span>تغییر رمز عبور</span>
        </div>
        <div class="top-line-content">
            <form action="{{route('customer.profile.do-change-password')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="new_password">رمز عبور جدید</label>
                    <input type="password" class="form-control" id="new_password"
                           name="new_password" placeholder="رمز عبور جدید">
                </div>
                <div class="form-group">
                    <label for="new_password_confirmation">تکرار رمز عبور جدید</label>
                    <input type="password" class="form-control" id="new_password_confirmation"
                           name="new_password_confirmation" placeholder="تکرار رمز عبور جدید">
                </div>

                <button type="submit" class="btn btn-icon-reverse submit" data-text='ذخیره'>
                    <i class="fa fa-floppy-o"></i><span class="text"> ذخیره</span>
                </button>
            </form>
        </div>
    </div>
@endsection

@section('footer_class') border-top @endsection
