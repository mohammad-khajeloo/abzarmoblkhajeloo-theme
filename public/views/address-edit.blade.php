@extends('_base')

@section('title')
    پروفایل - ویرایش آدرس -
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

    <script>window.currentPage = "address-edit"</script>
    <div class="container address-edit" id="addresses">
        <div class="icon-title">
            <i class="icon-placeholder" aria-hidden="true"></i>
            <span>ویرایش {{$customer_address->name}}</span>
        </div>
        <div class="top-line-content" id="insertAddress">
            <form action="{{route('customer.address.update', $customer_address)}}"
                  method="post" id="address-module">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-2 col-md-6 col-sm-12 form-group">
                        <label>استان :</label>
                        <input type="text" class="form-control" value="{{$customer_address?->state?->name}}" disabled>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 form-group">
                        <label>شهر :</label>
                        <input type="text" class="form-control" value="{{$customer_address?->city?->name}}" disabled>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="form-group">
                            <label for="superscription">آدرس<span class="required">*</span></label>
                            <input type="text" class="form-control" name="superscription"
                                   value="{{$customer_address->superscription}}"
                                   placeholder="ادامه آدرس">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="phone_number">شماره تماس<span class="required">*</span></label>
                            <input type="text" class="form-control number-control" name="phone_number"
                                   value="{{$customer_address->phone_number}}"
                                   placeholder="مثال:۰۹۱۲۰۰۰۰۰۰۰">
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="zipcode">کد پستی</label>
                            <input type="text" class="form-control number-control" name="zipcode"
                                   value="{{$customer_address->zipcode}}"
                                   placeholder="کد پستی ۱۰ رقمی">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="form-group">
                            <label for="transferee_name">تحویل گیرنده<span class="required">*</span></label>
                            <input type="text" class="form-control" name="transferee_name"
                                   value="{{$customer_address->transferee_name}}"
                                   placeholder="نام تحویل گیرنده">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn submit" data-text="ذخیره"><span class="text">ذخیره</span></button>
            </form>
        </div>
    </div>
@endsection