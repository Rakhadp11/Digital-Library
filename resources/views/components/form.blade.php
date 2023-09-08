<form
    id="{{ $id ?? 'form' }}"
    class="kt-form {{ $class ?? '' }}"
    method="POST"
    action="{{ $action ?? 'javascript:void(0);' }}"
    enctype="{{ empty($is_upload) ? 'application/x-www-form-urlencoded' : 'multipart/form-data' }}"
    @csrf

    @method($method ?? 'post')

    @component('components.card', $card ?? [
        'header' => [
            'title' => empty($method)
                ? __('theme::pages.form.title', ['title' => $title])
                : __('theme::pages.form.title_' . strtolower($method), ['title' => $title]),
        ]
    ])
        @slot('body')
            {!! $forms ?? '' !!}
        @endslot

        @slot('footer')
            @isset($buttons)
                {!! $buttons !!}
            @else
                @component('components.button', [
                    'icon' => 'la la-arrow-left',
                    'text' => __('theme::pages.form.button_back'),
                    'class' => 'btn-secondary',
                    'attributes' => [
                        'onclick' => 'javascript:history.back();',
                    ],
                ])
                @endcomponent

                @isset($action)
                    @component('components.button', [
                        'type' => 'submit',
                        'icon' => 'la la-check',
                        'text' => __('theme::pages.form.button_' . ($method ?? 'post')),
                        'class' => 'btn-primary',
                    ])
                    @endcomponent
                @endisset
            @endisset
        @endslot
    @endcomponent
</form>
