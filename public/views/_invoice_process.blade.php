<div class="process">
    <ul class="row">
        <li class="col done">
            <span>سـبـــد خـریــد</span>
            <div class="square">
                <i class="fa fa-check" aria-hidden="true"></i>
            </div>
            <div class="line hidden-md hidden-sm hidden-xs"></div>
        </li>
        <li class="col @if($status > 0) done @elseif($status == 0) doing @endif">
            <span>اطلاعات سفارش</span>
            <div class="square">
                <i class="fa fa-check" aria-hidden="true"></i>
            </div>
            <div class="line hidden-md hidden-sm hidden-xs"></div>
        </li>
        <li class="col @if($status > 1) done @elseif($status == 1) doing @endif">
            <span>اطلاعات پرداخت</span>
            <div class="square">
                <i class="fa fa-check" aria-hidden="true"></i>
            </div>
            <div class="line hidden-md hidden-sm hidden-xs"></div>
        </li>
        <li class="col @if($status > 2) done @elseif($status == 2) doing @endif">
            <span>پرداخت</span>
            <div class="square">
                <i class="fa fa-check" aria-hidden="true"></i>
            </div>
            <div class="line hidden-md hidden-sm hidden-xs"></div>
        </li>
    </ul>
</div>