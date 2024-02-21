<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    /**
     * protected 
     */
    protected $guarded = [''];

    /**
     * Relationship
     */
    public function transaksi(){
        return $this->belongsTo(Transaksi::class, 'kode_transaksi');
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    /**
     * Function 
     */
    public function  formatRp($data){
        return "Rp.". number_format($data, 2, ',', '.');
    }

    /**
     * CRUD Action
     */
    public static function createDetailTransaksi($request){
        $data = self::create($request->all());
        $data .= self::logsCreate();
        
        return $data;
    }

    /**
     * Log Aktifitas
     */
    public static function logsCreate(){
        $date = date('Y-m-d h:i:s');
        $data = Log::create([
            'waktu' => $date,
            'aktifitas' => 'Menambahkan Transaksi Masuk',
            'id_user' => auth()->user()->id
        ]);
        return $data;
    }

    public function updateuserLogs(){
        $date = date('Y-m-d h:i:s');
        $data = Log::create([
            'waktu' => $date,
            'aktifitas' => 'Update Data Transaksi',
            'id_user' => auth()->user()->id
        ]);
        return $data;
    }

    public function deleteuserLogs(){
        $date = date('Y-m-d h:i:s');
        $data = Log::create([
            'waktu' => $date,
            'aktifitas' => 'Menghapus Data Transaksi',
            'id_user' => auth()->user()->id
        ]);
        return $data;
    }

}
