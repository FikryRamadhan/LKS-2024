<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    /**
     * protected
     */
    protected $guarded = [''];
    protected $dates = ['created_at', 'updated_at', 'tgl_transaksi'];

    /**
     * Relationship
     */
    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function detailTransaksi(){
        return $this->hasMany(DetailTransaksi::class, 'kode_transaksi');
    }

    /**
     * CRUD Action
     */
    public static function createTransaksi($request){
        return self::create($request);
    }
    
}
