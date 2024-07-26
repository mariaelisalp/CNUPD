<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $states = State::all()->pluck('abbr','id');

        return view('auth.register', compact('states'));
    }

    public function searchCities($state_id){
        $cities = City::where('state_id', $state_id)->pluck('name', 'id');
        return response()->json($cities);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
    
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:'.UserRequest::class],
            'full_name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.UserRequest::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
            'files' => ['required', 'array', 'min:1']
        ]);

        $userRequest = (new UserRequest())->createRequest($request);
        
        event(new Registered($userRequest));
        $request->session()->flash('message', 'Caso sua solicitação seja aceita ou rejeitada, você receberá um aviso em seu email.');
        //Auth::login($user);

        return redirect()->back();
    }
}
