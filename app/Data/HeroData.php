<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Required;
use Spatie\LaravelData\Attributes\Nullable;
use Spatie\LaravelData\Attributes\StringType;

class HeroData extends Data
{
  public function __construct(
    #[MapInputName('title')]
    #[Required]
    #[StringType]
    public string $title,

    #[MapInputName('deskripsi')]
    #[Required]
    #[StringType]
    public string $deskripsi,

    #[MapInputName('button')]
    #[Required]
    #[StringType]
    public string $button,

    #[MapInputName('image')]
    #[Nullable]
    #[StringType]
    public ?string $image,
  ) {
  }
}
