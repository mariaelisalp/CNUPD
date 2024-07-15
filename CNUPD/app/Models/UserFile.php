<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFile extends Model
{
    use HasFactory;
    protected $table = 'user_files';

    protected $fillable = [
        'user_request_id',
        'file',
    ];

    public function user_request(){
        return $this->belongsTo(UserRequest::class);
    }

    public static function saveDocs(UserRequest $userRequest, $fileNameToStore){
        UserFile::create([
            'user_request_id' => $userRequest->id,
            'file' => $fileNameToStore,
        ]);
    }
}
