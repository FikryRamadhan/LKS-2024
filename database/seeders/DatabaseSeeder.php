<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User
        User::create([
            'type_user' => 'Admin',
            'name' => 'Fikry Ramadhan',
            'alamat' => 'Jl. Sampora',
            'telepon' => '123456789',
            'username' => 'fikry123',
            'password' => bcrypt('123'),
        ]);
        User::create([
            'type_user' => 'Kasir',
            'name' => 'Kasir',
            'alamat' => 'Jl. Sampora',
            'telepon' => '123456789',
            'username' => 'kasir123',
            'password' => bcrypt('123'),
        ]);
        User::create([
            'type_user' => 'Gudang',
            'name' => 'gudang',
            'alamat' => 'Jl. Sampora',
            'telepon' => '123456789',
            'username' => 'gudang123',
            'password' => bcrypt('123'),
        ]);

        // Barang
        Barang::create([
            'kode_barang' => '001',
            'nama_barang' => 'Roti',
            'expired_date' => '2024-02-02',
            'jumlah_barang' => 10, 
            'satuan' => 'pcs',
            'harga_satuan' => 10000
        ]);
        Barang::create([
            'kode_barang' => '002',
            'nama_barang' => 'Stroberry Perry',
            'expired_date' => '2024-02-02',
            'jumlah_barang' => 20, 
            'satuan' => 'pcs',
            'harga_satuan' => 15000
        ]);
        Barang::create([
            'kode_barang' => '003',
            'nama_barang' => 'Blueberry Perry',
            'expired_date' => '2024-02-02',
            'jumlah_barang' => 100, 
            'satuan' => 'pcs',
            'harga_satuan' => 20000
        ]);

        // // Transaksi
        // Transaksi::create([
        //     'no_transaksi' => '001',
        //     'tgl_transaksi' => '2024-02-02',
        //     'total_bayar' => 20000,
        //     'id_user' => 1,
        //     'id_barang' => 1
        // ]);
        // Transaksi::create([
        //     'no_transaksi' => '002',
        //     'tgl_transaksi' => '2024-02-02',
        //     'total_bayar' => 20000,
        //     'id_user' => 3,
        //     'id_barang' => 2
        // ]);
        // Transaksi::create([
        //     'no_transaksi' => '003',
        //     'tgl_transaksi' => '2024-02-02',
        //     'total_bayar' => 20000,
        //     'id_user' => 2,
        //     'id_barang' => 3
        // ]);

        // Log
        Log::create([
            'waktu' => '2024-02-02',
            'aktifitas' => 'Belanja',
            'id_user' => 1
        ]);
        Log::create([
            'waktu' => '2024-02-02',
            'aktifitas' => 'Belanja',
            'id_user' => 2
        ]);
        Log::create([
            'waktu' => '2024-02-02',
            'aktifitas' => 'Belanja',
            'id_user' => 3
        ]);
    }
}
