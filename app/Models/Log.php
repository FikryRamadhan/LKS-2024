<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Log extends Model
{
    use HasFactory;
    /**
     * protected 
     */
    protected $guarded =[''];
    protected $dates = ['created_at', 'updated_at', 'waktu'];

    /**
     * 
     * Relationship
     * 
     */
    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
