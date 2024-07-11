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
                return redirect()->back()->with('erro','Seu cadastro está em análise. O prazo é de 24 a 48 horas.');
            }
            if(!empty($user)){
                if($user_request->approved AND (!$user->approved)){
                    return redirect()->back()->with('erro','Este usuário não está autorizado a acessar o sistema. Entre em contato com o administrador para mais informações.');
                }
            }
        }
        return $next($request);
    }
}
