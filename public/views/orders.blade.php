@extends('_base')

@section('title')
    لیست سفارشات -
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
    <script>window.currentPage = "orders"</script>
    <div class="container orders" id="history">
        <div class="icon-title">
            <i class="icon-shopping-bag" aria-hidden="true"></i><span>لیست سفارشات</span>
        </div>
        <div class="top-line-content">
            <div class="header hidden-md hidden-sm hidden-xs">
                <div class="col col-lg-1">ردیف</div>
                <div class="col col-lg-3">کد</div>
                <div class="col col-lg-2">تاریخ</div>
                <div class="col col-lg-2">مبلغ</div>
                <div class="col col-lg-3">وضعیت</div>
                <div class="col col-lg-1">جزئیات</div>
            </div>

            <?php $invoices = get_invoices(); ?>
            @foreach($invoices as $invoice)
                <div class="order-item">

                    <div class="order-row">
                        <div class="col col-lg-1 hidden-md hidden-sm hidden-xs numerical-data">{{$invoice->id}}</div>
                        <div class="col col-lg-3 col-md-12 col-sm-12 col-xs-12 code">
                            <span class="hidden-xl hidden-lg">کد: </span>{{$invoice->tracking_code}}
                        </div>
                        <div class="col col-lg-2 col-md-6 col-sm-6 col-xs-6">
                            <span class="hidden-xl hidden-lg">تاریخ: </span>{{JDate::forge($invoice->created_at)->format('Y/m/d')}}
                        </div>
                        <div class="col col-lg-2 col-md-6 col-sm-6 col-xs-6 price-data">
                            <span class="hidden-xl hidden-lg">مبلغ: </span>{{$invoice->sum}}
                        </div>
                        @if($invoice->is_active)
                            @if($invoice->isPayed())
                                <div class="col col-lg-3 col-md-6 col-sm-6 col-xs-6 shipment-status">
                                                <span class="status-{{$invoice->shipment_status}}">
                                                @lang('invoice.shipment_status.' . $invoice->shipment_status)
                                                </span>
                                </div>
                            @else
                                <div class="col col-lg-3 col-md-6 col-sm-6 col-xs-6 payment-status">
                                                <span class="status-{{$invoice->payment_status}}">
                                                @lang('invoice.payment_status.' . $invoice->payment_status)
                                                </span>
                                </div>
                            @endif
                        @else
                            <div class="col col-lg-3 col-md-6 col-sm-6 col-xs-6 general-status">
                                            <span class="status-deactivated">
                                                غیر فعال
                                            </span>
                            </div>
                        @endif
                        <div class="col col-lg-1 col-md-6 col-sm-6 col-xs-6 more">
                            <a href="{{ route('customer.invoice.show-checkout', $invoice) }}"
                               title="سفارش {{$invoice->id}}"><i
                                        class="fa fa-angle-down hidden-md hidden-sm hidden-xs"></i>
                            <span class="btn hidden-xl hidden-lg">مشاهده<i class="fa fa-angle-left"></i></span>
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach

            @include('_pagination', [
                    'currentPage' => $invoices->currentPage(),
                    'lastPage' => $invoices->lastPage(),
                ])

        </div>
    </div>
@endsection