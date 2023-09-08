<?php

namespace App\Repositories;

use App\Data\CategoryData;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use LaravelEasyRepository\Implementations\Eloquent;

class EloquentCategoryRepository
{
    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function storeCategory(CategoryData $data)
    {
        $category = Category::create([
            'name' => $data->name,
            'description' => $data->description,
            'image' => $data->image,
        ]);

        return $category;
    }

    public function createDom()
    {
        $dom = Category::all();

        return $dom;
    }

    public function editCategory($id)
    {
        $category = Category::where('id', $id)->firstOrFail();

        return $category;
    }

    public function editDom()
    {
        $dom = Category::all();

        return $dom;
    }

    public function updateCategory(CategoryData $data, $id)
    {
        $category = Category::where('id', $id)->first();

        if ($category) {
            $category->update([
                'name' => $data->name,
                'description' => $data->description,
                'image' => $data->image,
            ]);
        }

        return $category;
    }


    public function destroyCategory($id)
    {
        $category = Category::where('id', $id)->delete();

        return $category;
    }
}
