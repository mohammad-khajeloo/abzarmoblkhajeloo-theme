@extends('_mail_base')
@section('title')
    دریافت پیام از وبسایت
@endsection
@section('subject')
    دریافت پیام
@endsection
@section('content')
    <div style="text-align: right;" align="right">
        <p style="direction: rtl;text-align: justify ;font-size: 14px; line-height: 20px; margin: 15px 0 15px;; padding: 0;">
            <strong style="font-weight: bold">موضوع پیام
                :</strong> {{ isset($data['subject']) ? $data['subject'] : 'بدون موضوع' }}‌
        </p>
        <hr>
        <section
                style="direction: rtl;text-align: justify ;font-size: 14px; line-height: 20px; margin: 15px 0 15px;; padding: 0;">
            ‌<span style="font-weight: bold">از طرف : </span> {{ isset($data['mobile']) ? $data['mobile'] : 'ناشناس' }}
        </section>
        <hr>
        <section
                style="direction: rtl;text-align: justify ;font-size: 14px; line-height: 20px; margin: 15px 0 15px;; padding: 0;">
            ‌<span style="font-weight: bold">متن پیام : </span> {{ isset($data['message']) ? $data['message'] : 'بدون متن' }}
        </section>

    </div>

    <br>
    <br>
    <div style="text-align: right;" align="right">
        @foreach($data as $key => $value)
            @if($key == 'message' or $key == 'subject' or $key == 'mobile')
                @continue
            @endif
            <section
                    style="direction: rtl;text-align: justify ;font-size: 14px; line-height: 20px; margin: 15px 0 15px;; padding: 0;">
                ‌<span style="font-weight: bold">{{ trans('validation.attributes.' . $key) }} : </span>
                {{ $value }}
            </section>
            <hr>
        @endforeach
    </div>

    <div style="text-align: right;" align="right">
        <hr>
        <p style="direction: rtl;text-align: right ;font-size: 12px; line-height: 20px; margin: 20px 0 0; padding: 0;">
            لینک مشاهده کامل پیام در پنل:
        </p>
        <p style="direction: ltr; text-align: left;font-size: 12px; line-height: 20px; margin: 20px 0 0; padding: 0;"
           align="left">
            <a href="{{ $adminUrl }}">مشاهده پنل</a>
        </p>
    </div>
@endsection