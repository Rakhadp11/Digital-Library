@if (isset($icon) || isset($title))
    <div class="card-title">
        @isset ($icon)
            <span class="card-icon">
                <i class="{{ $icon }}"></i>
            </span>
        @endisset

        @isset ($title)
            <h3 class="card-label">
                {{ __($title) }}
                @isset($sub_title)
                    <small>{{ __($sub_title) }}</small>
                @endisset
            </h3>
        @endisset
    </div>
@endif
@isset ($toolbars)

    <div class="card-toolbar">
        <div class="my-auto">

            @isset($filter)
                @component('components._dropdown-filter-item', ['filter' => $filter])
                @endcomponent
            @endisset

            @if (data_get($toolbars, 'actions'))
                @foreach(data_get($toolbars, 'actions', []) as $action)
                    @component('components._action', [
                        'url' => data_get($action, 'url', 'javascript:void(0);'),
                        'class' => data_get($action, 'class', 'btn-primary'),
                        'icon' => data_get($action, 'icon'),
                        'label' => data_get($action, 'label'),
                    ])
                    @endcomponent
                @endforeach
            @endif

            @if (data_get($toolbars, 'buttons'))
                @foreach(data_get($toolbars, 'buttons', []) as $buttons)
                    @component('components.button', [
                        'url' => data_get($buttons, 'url', '#'),
                        'label' => data_get($buttons, 'label'),
                        'icon' => data_get($buttons, 'icon'),
                        'type' => data_get($buttons, 'type'),
                        'target' => data_get($buttons, 'target'),
                        'data' => data_get($buttons, 'data', []),
                        'class' => data_get($buttons, 'class', 'btn-primary btn-sm'),
                        'title' => data_get($buttons, 'title'),
                        'disable' => data_get($buttons, 'disable', false),
                    ])
                    @endcomponent
                @endforeach
            @endif

            @if (data_get($toolbars, 'dropdown'))
                @component('metronic::components.card._dropdown', data_get($toolbars, 'dropdown'))
                @endcomponent
            @endif
        </div>
    </div>
@endisset
