<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\City;
use App\Models\State;
use App\Models\UserFile;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\UserRequest;
use App\Notifications\ApprovalNotification;
use App\Notifications\DenialNotification;
use App\Models\UserActionLog;

class UserRequestController extends Controller
{
    public function index_users(){
        $users = User::getAll();
        return view ('admin.index_users', compact('users'));
    }

    public function disableUser(User $user){
        $user->approved = false;
        $user->save();
        UserActionLog::manageAccess($user, 'DISABLE');
        session()->flash('message1', 'Usuário desabilitado com sucesso!');
        return redirect()->route('admin.index_users');
    }

    public function enableUser(User $user){
        $user->approved = true;
        $user->save();
        UserActionLog::manageAccess($user, 'ENABLE');
        session()->flash('message2', 'Usuário habilitado com sucesso!');
        return redirect()->route('admin.index_users');
    }

    public function index_requisicoes(Request $request){
        $user_requests = UserRequest::getRequests();
       return view('admin.index_requisicoes',compact('user_requests'));
    }

    public function exibe_requisicao(int $id){
        $user_request = UserRequest::findRequest($id);
        return view('admin.show_requisicao', $user_request);
    }
    
    public function aprova_requisicao(int $id){
        
        $request = UserRequest::find($id);
        $request->notify(new ApprovalNotification());
        
        $user = (new UserRequest())->approve($request);

        UserActionLog::authorize($user);
       
        session()->flash('message', 'Solicitação aceita');
        event(new Registered($user));
        return redirect()->route('admin.index_requisicoes');
    }

    public function rejeita_requisicao(int $id){
        $request = UserRequest::find($id);
        $request->notify(new DenialNotification());
        $request->delete();
        session()->flash('warning', 'Solicitação rejeitada');
        return redirect()->route('admin.index_requisicoes');
        
    }

}
