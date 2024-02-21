<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    /**
     * Protected
     */
    protected $guarded = [''];
    protected $dates = ['created_at', 'updated_at', 'expired_date'];

    /**
     * Function Action Crud
     */
    public static function storeBarang($request){
        $data = self::create($request->all());
        $data .= self::createLogsBarang();
        return $data;
    }

    public function updateBarang($request){
        $this->update($request->all());
        $this->updateLogsBarang();
        return $this;
    }
    
    public function deleteBarang(){
        $this->delete();
        $this->deleteLogsBarang();
        return $this;
    }

    

    /**
     * Function Create Logs Aktifity
     */
    public static function createLogsBarang(){
        $date = date('Y-m-d h:i:s');
        $data = Log::create([
            'waktu' => $date,
            'aktifitas' => 'Menambahkan Data Barang',
            'id_user' => auth()->user()->id
        ]);
        return $data;
    }

    public static function updateLogsBarang(){
        $date = date('Y-m-d h:i:s');
        $data = Log::create([
            'waktu' => $date,
            'aktifitas' => 'Mengupdate Data Barang',
            'id_user' => auth()->user()->id
        ]);
        return $data;
    }

    public static function deleteLogsBarang(){
        $date = date('Y-m-d h:i:s');
        $data = Log::create([
            'waktu' => $date,
            'aktifitas' => 'Menghapus Data Barang',
            'id_user' => auth()->user()->id
        ]);
        return $data;
    }
}
