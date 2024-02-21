<?php

namespace App\MyClass;

class Validations {
    public static function authenticate($request){
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required|max:20',
        ],[
            'username.required' => 'Username wajib diisi!',
            'username.exists' => 'Username tidak ditemukan!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 6 karakter!',
        ]);
    } 

    /**
     * User
     */
    public static function storeUser($request){
        $request->validate([
            'alamat' => 'required',
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'telepon' => 'required',
            'password' => 'required|min:5|max:12',
        ], [
            'alamat.required' => 'Alamat Wajib Di Isi',
            'name.required' => 'Nama Wajib Diisi',
            'username.required' => 'Username Wajib Diisi',
            'username.unique' => 'Username Telah Terpakai',
            'telepon.required' => 'No Telepon Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
            'password.min' => 'Password Minimal 5 Dijit',
            'password.max' => 'Password  Maksimal 12 dijit' 
        ]);
    }

    public static function updateUser($request){
        $request->validate([
            'alamat' => 'required',
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$request->id,
            'telepon' => 'required',
            'password' => 'required|min:5|max:12',
        ], [
            'alamat.required' => 'Alamat Wajib Di Isi',
            'name.required' => 'Nama Wajib Diisi',
            'username.required' => 'Username Wajib Diisi',
            'username.unique' => 'Username Telah Terpakai',
            'telepon.required' => 'No Telepon Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
            'password.min' => 'Password Minimal 5 Dijit',
            'password.max' => 'Password  Maksimal 12 dijit'
        ]);
    }

    /**
     * Gudang || Product
     */
    public static function storeBarang($request){
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'expired_date' => 'required',
            'jumlah_barang' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
        ]);
    }
    public static function updateBarang($request){
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'expired_date' => 'required',
            'jumlah_barang' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
        ]);
    }

    /**
     * Kasir || Transaksi
     */
    public static function transaksi($request){
        $request->validate([
            'kode_transaksi' => 'required',
            'id_barang' => 'required',
            'harga_total' => 'required',
            'jumlah_barang' => 'required',
        ]);
    }
}