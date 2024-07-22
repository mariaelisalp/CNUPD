<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserActionLog extends Model
{
    use HasFactory;
    protected $table = 'logs';

    protected $fillable = [
        'user_id',
        'action',
        'people_id',
        'target_user_id',
        'description',
    ];

    public function people(){
        return $this->belongsTo(People::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function create_log($people){
        UserActionLog::create([
            'user_id' => auth()->user()->id,
            'action' => 'CREATE',
            'people_id' => $people->id,
            'description' => 'Criou novo registro de pessoa',
        ]);
    }

    public static function read_log($people){
        UserActionLog::create([
            'user_id' => auth()->user()->id,
            'action' => 'READ',
            'people_id' => $people->id,
            'description' => 'Acessou um registro de pessoa',
        ]);
    }

    public static function update_log($people){
        UserActionLog::create([
            'user_id' => auth()->user()->id,
            'action' => 'UPDATE',
            'people_id' => $people->id,
            'description' => 'Editou um registro de pessoa',
        ]);
    }

    public static function delete_log(){
        UserActionLog::create([
            'user_id' => auth()->user()->id,
            'action' => 'DELETE',
            'description' => 'Deletou um registro de pessoa',
        ]);
    }

    public function login(){
        UserActionLog::create([
            'user_id' => auth()->user()->id,
            'action' => 'LOGIN',
            'description' => 'Fez login no sistema',
        ]);
    }

    public static function authorize($user){
        UserActionLog::create([
            'user_id' => auth()->user()->id,
            'action' => 'AUTHORIZE',
            'target_user_id' => $user->id,
            'description' => 'Autorizou o acesso de',
        ]);
    }

    public static function manageAccess($user, string $action){
        if($action == 'ENABLE'){
            $description = 'Habilitou o acesso de';
        }
        else{
            $description = 'Desabilitou o acesso de';
        }
        UserActionLog::create([
            'user_id' => auth()->user()->id,
            'action' => $action,
            'target_user_id' => $user->id,
            'description' => $description,
        ]);
    }

    public function getAll($filters, $period, $now){
        if($filters){
            return DB::table('logs')->whereIn('action', $filters)->paginate(20);
        }
        else{
            return DB::table('logs')->paginate(20);
        }

        if ($period) {
            $startDate = now()->subDays($period)->startOfDay();
            return DB::table('logs')->where('created_at', '>=', $startDate);
        }
        
    }

    public static function getDetails($logs){
        $details = [];

        foreach($logs as $log){
            $user = DB::table('users')->where('id', $log->user_id)->first();
            $target_id = DB::table('users')->where('id', $log->target_user_id)->first();
            
            $details[$log->id] = [
                'username' => $user->username,
                'target_user' => $target_id ? $target_id->username : null,
            ];
        }

        return $details;
    }
}
