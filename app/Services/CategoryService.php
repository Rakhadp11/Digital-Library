<?php

namespace App\Services;

use App\Data\CategoryData;
use App\Repositories\EloquentCategoryRepository;

final class CategoryService
{
    protected EloquentCategoryRepository $repository;

    public function __construct(EloquentCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function storeCategory(CategoryData $data)
    {
        return $this->repository->storeCategory($data);
    }

    public function editCategory($id)
    {
        return $this->repository->editCategory($id);
    }

    public function updateCategory(CategoryData $data, $id)
    {
        return $this->repository->updateCategory($data, $id);
    }

    public function destroyCategory($id)
    {
        return $this->repository->destroyCategory($id);
    }
}
