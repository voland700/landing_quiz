<div class="detail_container">
    <div class="detail_top">
        <div class="detail_img_wrap">
            <img src="{{ $product->getImage() }}" alt="{{ $product->name }}" class="detail_img">
        </div>
        <div class="detail_info_wrap">
            @if($product->summary)
            <div class="detail_summary">{!! $product->summary !!}</div>
            @endif
            @if($product->properties)
            <div class="detail_property">
                @foreach($product->properties as $property)
                    <div class="detail_property_row">
                        <span class="detail_property_name">{{$property->name}}</span>
                        <span class="detail_property_separator"></span>
                        <span class="detail_property_value">{{$property->value}}</span>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
    <div class="detail_description">{!! $product->description !!}</div>
    <div class="detail_btn_wrap">
        @if($product->link)
        <a href="{{$product->link}}" target="_blank" class="detail_btn_more">Смотреть в каталоге</a>
        @endif
    </div>
</div>
