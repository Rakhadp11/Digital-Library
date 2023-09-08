<button
    @isset($id) id="{{ $id }}" @endisset
    type="{{ $type ?? 'button' }}"
    class="{{ $class }}"
    @isset($tooltip) title="{{ $tooltip }}" @endisset
    @isset($disable)
    @if($disable)
        style="cursor: not-allowed"
    @else
        onclick="App.goToLinkWithTarget('{{ $url }}', '{{ $target }}')"
    @endif
    @endisset
    {{-- data-data='@json($data)'
    > --}}
    <i class="{{ $icon }}"></i>
    @isset($label) {{ $label }}@endisset
</button>
