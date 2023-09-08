<div class="overflow-auto">
    @isset($show)
        @component('components._anchor', [
            'url' => data_get($show, 'url', $show),
            'icon' => data_get($show, 'icon', 'la la-eye'),
            'data' => data_get($show, 'data', []),
            'class' => data_get($show, 'class', 'btn btn-secondary btn-sm btn-elevate btn-circle btn-icon'),
            'title' => data_get($show, 'title', 'Detail'),
            'target' => data_get($show, 'target', '_self'),
            'disable' => data_get($show, 'disable', false),
        ])
        @endcomponent
    @endisset

    @isset($edit)
        @component('components._anchor', [
            'url' => data_get($edit, 'url', $edit),
            'icon' => data_get($edit, 'icon', 'la la-edit'),
            'data' => data_get($edit, 'data', []),
            'class' => data_get($edit, 'class', 'btn btn-info btn-sm btn-elevate btn-circle btn-icon'),
            'title' => data_get($edit, 'title', 'Edit'),
            'target' => data_get($edit, 'target', '_self'),
            'disable' => data_get($edit, 'disable', false),
        ])
        @endcomponent
    @endisset

    @isset($delete)
        @component('components._button', [
            'url' => data_get($delete, 'url', $delete),
            'icon' => data_get($delete, 'icon', 'la la-trash'),
            'type' => 'delete',
            'data' => data_get($delete, 'data', []),
            'class' => data_get($delete, 'class', 'btn btn-danger btn-sm btn-elevate btn-circle btn-icon'),
            'title' => data_get($delete, 'title', 'Delete'),
            'disable' => data_get($delete, 'disable', false),
        ])
        @endcomponent
    @endisset

    @isset($restore)
        @component('components._button', [
            'url' => data_get($restore, 'url', $restore),
            'icon' => data_get($restore, 'icon', 'la la-undo'),
            'type' => 'restore',
            'data' => data_get($restore, 'data', []),
            'class' => data_get($restore, 'class', 'btn btn-warning btn-sm btn-elevate btn-circle btn-icon'),
            'title' => data_get($restore, 'title', 'Restore'),
            'disable' => data_get($restore, 'disable', false),
        ])
        @endcomponent
    @endisset

    @isset($activate)
        @component('components._button', [
            'url' => data_get($activate, 'url', $activate),
            'icon' => data_get($activate, 'icon', 'fa fa-check'),
            'type' => 'activate',
            'data' => data_get($activate, 'data', []),
            'class' => data_get($activate, 'class', 'btn btn-success btn-sm btn-elevate btn-circle btn-icon'),
            'title' => data_get($activate, 'title', 'Activate'),
            'disable' => data_get($activate, 'disable', false),
        ])
        @endcomponent
    @endisset

    @isset($deactivate)
        @component('components._button', [
            'url' => data_get($deactivate, 'url', $deactivate),
            'icon' => data_get($deactivate, 'icon', 'fa fa-times'),
            'type' => 'deactivate',
            'data' => data_get($deactivate, 'data', []),
            'class' => data_get($deactivate, 'class', 'btn btn-danger btn-sm btn-elevate btn-circle btn-icon'),
            'title' => data_get($deactivate, 'title', 'Deactivate'),
            'disable' => data_get($deactivate, 'disable', false),
        ])
        @endcomponent
    @endisset

    @isset($custom_url)
        @foreach($custom_url as $custom)
            @component('components._anchor', [
                'url' => data_get($custom, 'url', $custom),
                'icon' => data_get($custom, 'icon'),
                'data' => data_get($custom, 'data', []),
                'class' => data_get($custom, 'class', 'btn btn-primary btn-sm btn-elevate btn-circle btn-icon'),
                'title' => data_get($custom, 'title'),
                'target' => data_get($custom, 'target', '_self'),
                'disable' => data_get($custom, 'disable', false),
            ])
            @endcomponent
        @endforeach
    @endisset

    @isset($custom_action)
        @foreach($custom_action as $custom)
            @component('components._button', [
                'url' => data_get($custom, 'url', $custom),
                'icon' => data_get($custom, 'icon'),
                'type' => 'custom',
                'data' => data_get($custom, 'data', []),
                'class' => data_get($custom, 'class', 'btn btn-primary btn-sm btn-elevate btn-circle btn-icon'),
                'title' => data_get($custom, 'title'),
                'disable' => data_get($custom, 'disable', false),
            ])
            @endcomponent
        @endforeach
    @endisset
</div>
