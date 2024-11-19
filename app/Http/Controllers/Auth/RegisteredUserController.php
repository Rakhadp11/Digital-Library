<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\MixedCaseWithNumbers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**login
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:' . User::class,
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        $messages = [
            'email.regex' => 'Alamat email harus merupakan alamat email Gmail (@gmail.com).',
        ];

        $validatedData = $request->validate($rules, $messages);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => '0',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::EMAIL);
    }
}
