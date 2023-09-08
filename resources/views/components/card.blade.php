<!--begin::Card-->
<div class="card shadow-sm {{ $class ?? '' }}">
    @isset($header)
        <div class="card-header">
            @if (is_array($header))
                @component('components._header', $header)
                @endcomponent
            @else
                {!! $header !!}
            @endif
        </div>
    @endisset

    @isset($body)
        <div class="card-body {{ $body_class ?? '' }}">
            {{-- FLASH MESSAGE --}}
            @include('components.flash')

            {!! $body !!}
        </div>
    @endisset

    @isset($footer)
        <div class="card-footer {{ $footer_class ?? '' }}">
            {!! $footer !!}
        </div>
    @endisset
</div>
<!--end::Card-->
