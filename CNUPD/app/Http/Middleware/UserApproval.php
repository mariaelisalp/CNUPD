<?php

namespace App\Http\Middleware;

use App\Models\UserRequest;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserApproval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_request = UserRequest::where("email", $request->email)->first();
        $user = User::where('email', $request->email)->first();
        if(!empty($user_request)){
            if(!$user_request->approved){
                session()->flash('error','Seu cadastro está em análise. O prazo é de 24 a 48 horas.');
                return redirect()->back();
            }
            if(!empty($user)){
                if($user_request->approved AND (!$user->approved)){
                    session()->flash('warning', 'Entre em contato com o administrador do seu setor para saber como prosseguir.');
                    return redirect()->back();
                }
            }
        }
        return $next($request);
    }
}
