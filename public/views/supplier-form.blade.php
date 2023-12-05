@extends('_base')

@section('title')
    فرم تامین‌کنندگان
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

    <script>window.currentPage = "suppliers"</script>
    <div class="container suppliers" id="">
        <div class="icon-title">
            <i class="fa fa-building-o" aria-hidden="true"></i><span>فرم تامین‌کنندگان</span>
        </div>

        <div class="top-line-content">
            <div class="form-group">
                <label for="supplier">چه نوع فروشنده‌ای هستید؟</label>
                <div class="radio">
                    <div class="radio-group">
                        <input hct-form-field type="radio" name="supplier" id="type_person"
                               hct-validation="required" value="شخص حقیقی">
                        <label for="type_person" class="radiobtn">
                            <span>شخص حقیقی</span>
                        </label>
                    </div>
                    <div class="radio-group">
                        <input hct-form-field hct-validation="required" type="radio" name="supplier" id="type_legal"
                               value="شخص حقوقی">
                        <label for="type_legal" class="radiobtn">
                            <span>شخص حقوقی</span>
                        </label>
                    </div>
                </div>
            </div>
            <form hct-form="supplier-person-form" hct-title="فرم تامین‌کنندگان حقیقی"
                  class="form-person-content suppliers-form d-none">
                {{--if is person / start --}}
                <div class="icon-title">
                    <i class="fa fa-angle-left" aria-hidden="true"></i><span>اطلاعات شخصی</span>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="name">نام</label>
                            <input hct-form-field hct-validation="required" type="text" class="form-control"
                                   name="name" placeholder="نام" value="">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="family">نام خانوادگی</label>
                            <input hct-form-field hct-validation="required" type="text" class="form-control"
                                   name="family" placeholder="نام خانوادگی" value="">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php $birthday = 1; ?>
                            <label for="secondary_phone">تاریخ تولد</label>
                            <div class="birth-date">
                                <label for="birthday_day" class="d-none"></label>
                                <select class="form-control" name="birthday_day" hct-form-field
                                        hct-validation="required">
                                    <option>روز</option>
                                    @for($i=1; $i<=31; $i++)
                                        <option
                                                value="{{$i}}"
                                                @if(($birthday == $i) or (old('birthday_day') == $i)) selected @endif>
                                            {{$i}}
                                        </option>
                                    @endfor
                                </select>
                                <label for="birthday_month" class="d-none"></label>
                                <select class="form-control" name="birthday_month" hct-form-field
                                        hct-validation="required">
                                    <option>ماه</option>
                                    @foreach(get_months() as $key => $month)
                                        <option
                                                value="{{$key+1}}"
                                                @if(($birthday == $key+1) or (old('birthday_month') == $key+1)) selected @endif>
                                            {{$month}}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="birthday_year" class="d-none"></label>
                                <select class="form-control" name="birthday_year" hct-form-field
                                        hct-validation="required">
                                    <option>سال</option>
                                    @foreach(get_years() as $year)
                                        <option
                                                value="{{$year}}"
                                                @if(($birthday == $year) or (old('birthday_year') == $year)) selected @endif>
                                            {{$year}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="national_code">کدملی<span class="required">*</span></label>
                            <input type="text" class="form-control number-control" name="national_code"
                                   hct-form-field hct-validation="required"
                                   id="national_code" placeholder="کد ملی خود را بنویسید" value="">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="birth_number">شماره شناسنامه<span class="required">*</span></label>
                            <input type="text" class="form-control number-control" name="birth_number"
                                   hct-form-field hct-validation="required"
                                   id="birth_number" placeholder="شماره شناسنامه خود را بنویسید" value="">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 align-self-center">
                        <div class="form-group">
                            <label>جنسیت</label>
                            <div class="radio">
                                <label for="gender" class="d-none"></label>
                                <div class="radio-group">
                                    <input type="radio" name="gender" id="gender_female" value="زن" hct-form-field
                                           hct-validation="required">
                                    <label for="gender_female" class="radiobtn">
                                        <span>@lang('general.gender.'.Gender::MALE)</span>
                                    </label>
                                </div>

                                <div class="radio-group">
                                    <input type="radio" name="gender" id="gender_male" value="مرد" hct-form-field
                                           hct-validation="required">
                                    <label for="gender_male" class="radiobtn">
                                        <span>@lang('general.gender.'.Gender::FEMALE)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 text-right">
                        <label>آدرس</label>
                        <div class="office-location">
                            <div class="form-group">
                                <label for="state_id" class="d-none"></label>
                                <input type="text" class="form-control" name="state_id" placeholder="استان"
                                       hct-form-field hct-validation="required"
                                       value="{{old('state_id')}}" id="state-selector"
                                       data-url="{{route('api.v1.location.get-states')}}"
                                       data-initial-value="{{get_state_json_by_id(old('state_id'))}}">

                            </div>
                            <div class="form-group">
                                <label for="city_id" class="d-none"></label>
                                <input type="text" class="form-control" name="city_id" placeholder="شهر"
                                       hct-form-field hct-validation="required"
                                       value="{{old('city_id')}}" id="city-selector"
                                       data-url-base="{{route('api.v1.location.get-cities')}}"
                                       data-initial-value="{{get_city_json_by_id(old('city_id'))}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="phone">تلفن ثابت</label>
                            <input type="text" class="form-control number-control" id="phone" name="phone"
                                   hct-form-field hct-validation="required"
                                   placeholder="تلفن ثابت" value="">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="mobile">تلفن همراه</label>
                            <input type="text" class="form-control number-control" id="mobile" name="mobile"
                                   hct-form-field hct-validation="required"
                                   placeholder="تلفن همراه" value="">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="address">ادامه آدرس</label>
                            <input type="text" class="form-control" id="address" name="address" hct-form-field
                                   hct-validation="required"
                                   placeholder="آدرس ..." value="">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="product_desc">قصد فروش چه نوع کالایی را دارید؟</label>
                            <textarea class="form-control" id="product_desc" name="product_desc" rows="2"
                                      hct-form-field hct-validation="required"
                                      placeholder="شرح کالایتان را بنویسید ..."></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="additional_desc">توضیحات بیشتر</label>
                            <textarea class="form-control" id="additional_desc" name="additional_desc" rows="2"
                                      hct-form-field hct-validation="required"
                                      placeholder="توضیحات بیشتر ..."></textarea>
                        </div>
                    </div>
                </div>
                {{--if is person / end --}}
                <button type="submit" class="btn submit" data-text="ذخیره اطلاعات">
                    <span class="text">ذخیره اطلاعات</span></button>
            </form>

            <form hct-form="supplier-legal-form" hct-title="فرم تامین‌کنندگان حقوقی"
                  class="form-legal-content d-none suppliers-form">
                {{--if is legal / start --}}
                <div class="icon-title">
                    <i class="fa fa-angle-left" aria-hidden="true"></i><span>اطلاعات شرکت</span>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="company_name">نام شرکت</label>
                            <input type="text" class="form-control" id="company_name" placeholder="نام شرکت"
                                   hct-form-field hct-validation="required"
                                   name="company_name" value="{{old('company_name')}}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="national_id">شناسه ملی</label>
                            <input hct-form-field hct-validation="required" type="text"
                                   class="form-control number-control"
                                   id="national_id" placeholder="شناسه ملی ..." name="national_id"
                                   value="{{old('national_id')}}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="registration_code">شماره ثبت</label>
                            <input hct-form-field hct-validation="required" type="text"
                                   class="form-control number-control"
                                   id="registration_code" placeholder="شماره ثبت ..." name="registration_code"
                                   value="{{old('registration_code')}}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="economical_code">کد اقتصادی</label>
                            <input hct-form-field hct-validation="required" type="text"
                                   class="form-control number-control" id="economical_code"
                                   placeholder="کد اقتصادی ..."
                                   name="economical_code" value="{{old('economical_code')}}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="company_phone">تلفن ثابت</label>
                            <input hct-form-field hct-validation="required" type="text"
                                   class="form-control number-control" id="company_phone"
                                   placeholder="کد شهر الزامی است" name="company_phone"
                                   value="{{old('company_phone')}}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="mobile">تلفن همراه</label>
                            <input hct-form-field hct-validation="required" type="text"
                                   class="form-control number-control" id="mobile" name="mobile"
                                   placeholder="تلفن همراه ..." value="">
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="secondary_phone">محل شرکت</label>
                            <div class="office-location">
                                <div class="form-group">
                                    <label for="company_state_id" class="d-none"></label>
                                    <input hct-form-field hct-validation="required" type="text" class="form-control"
                                           name="company_state_id" placeholder="استان"
                                           value="{{old('state_id')}}" id="state-selector"
                                           data-url="{{route('api.v1.location.get-states')}}"
                                           data-initial-value="{{get_state_json_by_id(old('state_id'))}}">

                                </div>
                                <div class="form-group">
                                    <label for="company_city_id" class="d-none"></label>
                                    <input hct-form-field hct-validation="required" type="text" class="form-control"
                                           name="company_city_id" placeholder="شهر"
                                           value="{{old('city_id')}}" id="city-selector"
                                           data-url-base="{{route('api.v1.location.get-cities')}}"
                                           data-initial-value="{{get_city_json_by_id(old('city_id'))}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="address">ادامه آدرس</label>
                            <input hct-form-field hct-validation="required" type="text" class="form-control"
                                   id="address" name="address"
                                   placeholder="آدرس ..." value="">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="product_desc">قصد فروش چه نوع کالایی را دارید؟</label>
                            <textarea class="form-control" id="product_desc" name="product_desc" rows="2"
                                      hct-form-field hct-validation="required"
                                      placeholder="شرح کالایتان را بنویسید ..."></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="additional_desc">توضیحات بیشتر</label>
                            <textarea class="form-control" id="additional_desc" name="additional_desc" rows="2"
                                      hct-form-field hct-validation="required"
                                      placeholder="توضیحات بیشتر ..."></textarea>
                        </div>
                    </div>
                </div>
                {{--if is person / end --}}
                <button type="submit" class="btn submit" data-text="ذخیره اطلاعات">
                    <span class="text">ذخیره اطلاعات</span></button>
            </form>


        </div>
    </div>
@endsection