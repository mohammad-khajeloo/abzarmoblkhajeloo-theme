@extends('_base')

@section('title')
    پروفایل - افزودن آدرس -
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

    <script>window.currentPage = "address-add"</script>
    <div class="container address-add" id="addresses">
        <div class="icon-title">
            <i class="icon-placeholder" aria-hidden="true"></i><span>افزودن آدرس</span>
        </div>
        <div class="top-line-content" id="insertAddress">
            <form action="{{route('customer.address.store')}}" method="post" id="address-module">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="office-location">
                            <div class="col">
                                <div class="form-group">
                                    <label>استان<span class="required">*</span></label>
                                    <input type="text" class="form-control required" name="state_id"
                                           value="{{old('state_id')}}" placeholder="نام استان"
                                           id="state-selector"
                                           data-url="{{route('api.v1.location.get-states')}}"
                                           @if(old('state_id') != null )
                                               data-initial-value='{{get_state_json_by_id(old('state_id'))}}'
                                            @endif >
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>شهر<span class="required">*</span></label>
                                    <input type="text" class="form-control required" name="city_id"
                                           value="{{old('city_id')}}" placeholder="نام شهر"
                                           id="city-selector"
                                           data-url-base="{{route('api.v1.location.get-cities')}}"
                                           @if(old('city_id') != null )
                                               data-initial-value='{{get_city_json_by_id(old('city_id'))}}'
                                            @endif >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <div class=" form-group">
                            <label>آدرس<span class="required">*</span></label>
                            <input type="text" class="form-control" name="superscription"
                                   value="{{old('superscription')}}" placeholder="ادامه ادرس">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class=" form-group">
                            <label>شماره تماس<span class="required">*</span></label>
                            <input type="text" class="form-control number-control"
                                   name="phone_number" value="{{old('phone_number')}}"
                                   placeholder="مثال:۰۹۱۲۰۰۰۰۰۰۰">
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <div class=" form-group">
                            <label>کد پستی</label>
                            <input type="text" class="form-control number-control" name="zipcode"
                                   value="{{old('zipcode')}}" placeholder="کد پستی ۱۰ رقمی">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class=" form-group">
                            <label>تحویل گیرنده<span class="required">*</span></label>
                            <input type="text" class="form-control" name="transferee_name"
                                   value="{{old('transferee_name')}}" placeholder="نام تحویل گیرنده">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn submit" data-text="اضافه کردن"><span class="text">اضافه کردن</span>
                </button>
            </form>
        </div>
    </div>
@endsection