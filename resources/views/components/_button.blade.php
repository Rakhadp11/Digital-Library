<button
    type="button"
    class="{{ $class }}"
    title="{{ $title }}"
    @if ($disable)
    style="cursor: not-allowed"
    @else
    onclick="App.actionDataTable(this, '{{ $type }}')"
    data-url="{{ $url }}"
    data-data='@json($data)'
    @endif>
    <i class="{{ $icon }}"></i>
</button>
