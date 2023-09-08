@section('inputs')
    <input
        type="{{ $type ?? 'text' }}"
        id="{{ $id ?? $name }}"
        name="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror {{ $class ?? '' }}"
        value="{{ old($name, $value ?? '')  }}"
        @if (isset($step)) step="{{$step}}" @endif
        @if (isset($readonly) && $readonly) readonly @endif
        @if (isset($disabled) && $disabled) disabled @endif
        @if (isset($required) && $required) required @endif
        />
@overwrite