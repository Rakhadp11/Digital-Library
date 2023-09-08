<a
    class="{{ $class }}"
    title="{{ $title }}"
    @if ($disable)
        href="javascript:void(0);"
        style="cursor: not-allowed"
    @else
        href="{{ $url }}"
        target="{{ $target }}"
    @endif
    {!! html_attribute($data ?? []) !!} <!-- This part is unclear without more context -->
>
    <i class="{{ $icon }}"></i>
</a>
