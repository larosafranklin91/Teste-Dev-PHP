<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function firstStep(Request $request)

    {

        $request->validate([
            'name' => 'required|string|max:70',
            'cpf' => 'required|numeric|digits:11|unique:' . User::class,
            'email' => 'required|string|email|max:70|unique:' . User::class,
        ]);
        return to_route('register');
    }
    public function secondtStep(Request $request)

    {

        $request->validate([
            'cep' => 'required|numeric|digits:8',
            'rua' => 'required|string|max:70',
            'bairro' => 'required|string|max:70',
            'cidade' => 'required|string|max:70',
            'uf' => 'required|string|max:70',
        ]);
        return to_route('register');
    }




    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:70',
            'cpf' => 'required|numeric|digits:11|unique:' . User::class,
            'cep' => 'required|numeric|digits:8',
            'rua' => 'required|string|max:70',
            'bairro' => 'required|string|max:70',
            'cidade' => 'required|string|max:70',
            'uf' => 'required|string|max:70',
            'email' => 'required|string|email|max:70|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms'=>'accepted',
        ]);

        $user = User::create([
            'name' => $request->name,
            'cpf' => $request->cpf,
            'cep' => $request->cep,
            'rua' => $request->rua,
            'cidade' => $request->cidade,
            'bairro' => $request->bairro,
            'uf' => $request->uf,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
