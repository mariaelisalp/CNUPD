<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\UserRequest;
use App\Notifications\ApprovalNotification;
use App\Notifications\DenialNotification;

class UserRequestController extends Controller
{
    //
    public function index_requisicoes(Request $request){
        $user_requests = UserRequest::where('approved', false)->get();
       return view('admin.index_requisicoes',compact('user_requests'));
    }

    public function exibe_requisicao(int $id){
        $user_request = UserRequest::find($id);
        $cidade = City::find($user_request->city_id);
        $estado = State::find($cidade->state_id);
        return view('admin.show_requisicao', compact('user_request', 'cidade', 'estado'));
    }
    public function aprova_requisicao(int $id){
        
        $request = UserRequest::find($id);
        $request->notify(new ApprovalNotification());
        $request->approved = 1;
        $request->save();
        
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'city_id' => $request->city_id,
            'password' => $request->password,
            'full_name' => $request->full_name,
            'position' => $request->position,
            'authority' => 1,
            'approved' => 1,
        ]);
        //dd($request);
       
        
        event(new Registered($user));
        return redirect()->route('admin.index_requisicoes');
    }

    public function rejeita_requisicao(int $id){
        $request = UserRequest::find($id);
        $request->notify(new DenialNotification());
        $request->delete();
        return redirect()->route('admin.index_requisicoes');
        
    }



}
