@extends('_base')


@section('main_content')
    <div class="sticky-banner" hct-gallery="sticky_banner" hct-title="بنر بالای سایت" hct-max-entry="2">
        <ul class="hidden-xl hidden-lg hidden-md hidden-sm hidden-xs hidden-xxs" hct-gallery-fields>
            <li hct-gallery-field="main_title" hct-title="عنوان"></li>
            <li hct-gallery-field="link_addr" hct-title="آدرس لینک"></li>
        </ul>

        <div hct-gallery-item>
            <img hct-attr-src="{%- prop:image_path %}"
                 alt="{%- ex-prop:main_title %}" class="img-fluid"/>
            <a href="#" hct-attr-href="{%- ex-prop:link_addr %}" class="absolute-link"
               title="{%- ex-prop:main_title %}" id="sticky_banner"></a>
        </div>
    </div>
@endsection
