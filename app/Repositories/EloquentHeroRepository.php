<?php

namespace App\Repositories;

use App\Data\HeroData;
use App\Models\Hero;
use Illuminate\Database\Eloquent\Model;
use LaravelEasyRepository\Implementations\Eloquent;

class EloquentHeroRepository
{
    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Hero $model)
    {
        $this->model = $model;
    }

    public function storeHero(HeroData $data)
    {
        $hero = Hero::create([
            'title' => $data->title,
            'deskripsi' => $data->deskripsi,
            'button' => $data->button,
            'image' => $data->image,
        ]);

        return $hero;
    }

    public function createDom()
    {
        $dom = Hero::all();

        return $dom;
    }

    public function editHero($id)
    {
        $hero = Hero::where('id', $id)->firstOrFail();

        return $hero;
    }

    public function editDom()
    {
        $dom = Hero::all();

        return $dom;
    }

    public function updateHero(HeroData $data, $id)
    {
        $hero = Hero::where('id', $id)->first();

        if ($hero) {
            $hero->update([
                'title' => $data->title,
                'deskripsi' => $data->deskripsi,
                'button' => $data->button,
                'image' => $data->image,
            ]);
        }

        return $hero;
    }


    public function destroyHero($id)
    {
        $hero = Hero::where('id', $id)->delete();

        return $hero;
    }
}
