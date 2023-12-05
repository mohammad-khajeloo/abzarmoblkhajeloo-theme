<a class="btn add-basket single-add-btn-{{$item->id}} d-none" title="">
    <div class="btn-add-basket-text">افزودن به سبدخرید</div>
    <div class="btn-add-basket-icon">
        <img src="/HCMS-assets/img/basket.svg"
             alt="basket"/>
    </div>
</a>
<div class="counter-box-{{$item->id}} d-none">
    <div class="form-group count-group"
         data-action="{{route('customer.cart.detach-product', $item->id)}}">
        <input type="text"
               class="form-control count-control count-control-local"
               name="count-{{$item->id}}"
               placeholder="تعداد"
               value="0"
               data-min="{{$item->getMinimumAllowedPurchaseCount()}}"
               data-max="{{$item->getMaximumAllowedPurchaseCount()}}">
        <div class="count-increase">+</div>
        <div class="count-decrease">-</div>
    </div>
</div>