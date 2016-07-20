<li>
    <a href="{{ route($lang.'.attributes.slug', $attribute->slug) }}" title="{{ $attribute->title }}">
        {!! $attribute->title !!}
        {!! $attribute->present()->thumb(null, 200) !!}
    </a>
</li>
