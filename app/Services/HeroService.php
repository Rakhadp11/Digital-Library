<?php

namespace App\Services;

use App\Data\HeroData;
use App\Repositories\EloquentHeroRepository;

final class HeroService
{
    protected EloquentHeroRepository $repository;

    public function __construct(EloquentHeroRepository $repository)
    {
        $this->repository = $repository;
    }

    public function storeHero(HeroData $data)
    {
        return $this->repository->storeHero($data);
    }

    public function editHero($id)
    {
        return $this->repository->editHero($id);
    }

    public function updateHero(HeroData $data, $id)
    {
        return $this->repository->updateHero($data, $id);
    }

    public function destroyHero($id)
    {
        return $this->repository->destroyHero($id);
    }
}
