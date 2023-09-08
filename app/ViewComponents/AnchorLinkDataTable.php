<?php

namespace App\ViewComponents;

use Spatie\DataTransferObject\DataTransferObject;

class AnchorLinkDataTable extends DataTransferObject
{
    public readonly ?string $url;
    public ?string $title;
    public ?string $icon;
    public ?string $class;
    public readonly string $target;
    public readonly bool $disable;
    public readonly array $data;

    public static function make(
        string $url,
        string $title = null,
        string $icon = null,
        string $class = null,
        string $target = '_self',
        bool $disable = false,
        array $data = []
    ) {
        return new self(
            url: $url,
            title: $title,
            icon: $icon,
            class: $class,
            target: $target,
            disable: $disable,
            data: $data,
        );
    }
}
