<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SomeController extends Controller
{
    public function store(Request $request)
    {
        Session::put('key', 'value');
        session(['key' => 'value']);

        return redirect()->route('some.route');
    }

    public function show()
    {
        $value = Session::get('key');
        $value = session('key');
        return view('some.view', compact('value'));
    }
}
