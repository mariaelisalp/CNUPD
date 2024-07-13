<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\UserFile;

class UserRequest extends Model
{
    use HasFactory;

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
}
