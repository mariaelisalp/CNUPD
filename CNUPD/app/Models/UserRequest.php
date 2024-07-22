<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\UserFile;
use Illuminate\Support\Facades\Hash;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;

class UserRequest extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'city_id',
        'password',
        'full_name',
        'position',
    ];

    public function files(){
        return $this->hasMany(UserFile::class);
    }

    public static function uploadDocs(Request $request,UserRequest $userRequest){
        $fileNames = [];
        foreach($request->file('files') as $file) {
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
        
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
        
            $path = $file->storeAs('public/user_docs', $fileNameToStore);
            $fileNames[] = $fileNameToStore;

            UserFile::saveDocs($userRequest, $fileNameToStore);
        
        }
        
    }

    public static function createRequest($request){
        $userRequest = UserRequest::create([
            'username' => $request->username,
            'email' => $request->email,
            'city_id' => $request->input('city'),
            'password' => Hash::make($request->password),
            'full_name' => $request->full_name,
            'position' => $request->position,
        ]);
        
        if($request->hasFile('files') != null){
            UserRequest::uploadDocs($request, $userRequest);
        }

        return $userRequest;

    }

    public static function getRequests(){
        return DB::table('user_requests')->where('approved', false)->paginate(10);
        
    }

    public static function findRequest(int $id){
        $user_request = UserRequest::find($id);
        $cidade = City::find($user_request->city_id);
        $estado = State::find($cidade->state_id);
        $files = UserFile::where('user_request_id', $id)->get();

        return compact('user_request', 'cidade', 'estado', 'files');
    }

    public function approve($request){
        
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

        return $user;
    }
}
