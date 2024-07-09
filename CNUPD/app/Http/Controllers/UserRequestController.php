<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Models\UserRequest;

class UserRequestController extends Controller
{
    //
    public function index_requisicoes(Request $request){
        $user_requests = UserRequest::where('approved', false)->get();
       return view('admin.index_requisicoes',compact('user_requests'));
    }
    public function aprova_requisicao($user_requests){
        
        $request = UserRequest::findOrFail($user_requests);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'city_id' => $request->city_id,
            'password' => Hash::make($request->password),
            'full_name' => $request->full_name,
            'position' => $request->position,
            'authority' => '1',
            'approved' => '1',
        ]);
        //dd($request);

        event(new Registered($user));

        //Auth::login($user);

        return redirect()->route('admin.index_requisicoes');
    }
    public function rejeita_requisicao(Request $request){}



}
