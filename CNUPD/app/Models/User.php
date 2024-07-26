<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'city_id',
        'authority',
        'admin',
        'password',
        'full_name',
        'position',
        'approved'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function log(){
        return $this->hasMany(Log::class);

    }

    public function isAdmin(){
        return $this->admin;
    }

    public static function getRegisters(User $user){
        $logs = DB::table('logs')->where('user_id', $user->id)->where('action', 'CREATE')->get();
        $peopleIds = $logs->pluck('people_id');
        $people = DB::table('people')->whereIn('id', $peopleIds)->paginate(10);

        return $people;
    }

    public static function getAll(){
        $users = DB::table('users')->where('admin', false)->paginate(10);
        return $users;
    }

    public static function updateUser(Request $request, $user){
        $user->username = $request->input('username');
        $user->full_name = $request->input('full_name');
        $user->position = $request->input('position');
        $user->email = $request->input('email');

        if ($request->has('city')) {
            $user->city_id = $request->input('city');
        }
        $user->save();
    }
}
