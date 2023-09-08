<a href="{{ $url }}" class="btn btn-sm btn-light {{ $class }}">
    @isset($icon) <i class="{{ $icon }}"></i> @endisset
    {{ $label ?? '' }}
</a>
