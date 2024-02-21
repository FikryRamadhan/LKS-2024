<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded=[''];

    /**
     * 
     * Relationship
     * 
     * */

    public function log(){
        return $this->belongsTo(Log::class);
    }

    /**
     * 
     * Hak Akses Website
     * 
     */
    public function thisAdmin(){
        return $this->type_user == 'Admin';
    }

    public function thisKasir(){
        return $this->type_user == 'Kasir';
    }

    public function thisGudang(){
        return $this->type_user == 'Gudang';
    }

    /**
     * 
     * CRUD Action
     * 
     */
    public static function createUser($request){
        $data = self::create($request->all());
        $data .= self::logsCreate($request);
        return $data;
    }

    public function updateData(){
        $this->update();
        $this->updateuserLogs();
        return $this;
    }

    public function deleteData(){
        $this->delete();
        $this->deleteuserLogs();
        return $this;
    }

    /**
     * 
     * Logs Aktifitas
     * 
     */
    
    public static function logsCreate(){
        $date = date('Y-m-d h:i:s');
        $data = Log::create([
            'waktu' => $date,
            'aktifitas' => 'Membuat User',
            'id_user' => auth()->user()->id
        ]);
        return $data;
    }

    public static function updateuserLogs(){
        $date = date('Y-m-d h:i:s');
        $data = Log::create([
            'waktu' => $date,
            'aktifitas' => 'Update Data User',
            'id_user' => auth()->user()->id
        ]);
        return $data;
    }

    public function deleteuserLogs(){
        $date = date('Y-m-d h:i:s');
        $data = Log::create([
            'waktu' => $date,
            'aktifitas' => 'Menghapus User '.$this->username,
            'id_user' => auth()->user()->id
        ]);
        return $data;
    }

}
