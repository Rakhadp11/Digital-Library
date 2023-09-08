<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Required;
use Spatie\LaravelData\Attributes\Nullable;
use Spatie\LaravelData\Attributes\StringType;

class CategoryData extends Data
{
  public function __construct(
    #[MapInputName('name')]
    #[Required]
    #[StringType]
    public string $name,

    #[MapInputName('description')]
    #[Required]
    #[StringType]
    public string $description,

    #[MapInputName('image')]
    #[Nullable]
    #[StringType]
    public ?string $image,
  ) {
  }
}
