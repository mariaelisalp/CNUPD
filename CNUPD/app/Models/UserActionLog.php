<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActionLog extends Model
{
    use HasFactory;

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
}
