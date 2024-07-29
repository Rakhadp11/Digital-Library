<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $heroes = Hero::all();
        return view('frontend.home.index', [
            'heroes' =>  $heroes
        ]);
    }
}
