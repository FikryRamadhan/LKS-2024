<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\MyClass\Validations;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\MyClass\Response;
use App\Models\User;


class LoginController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function authenticate(Request $request){
        Validations::authenticate($request);
        
        $kredensial = $request->only('username', 'password');

        $user = User::where('username', $kredensial['username'])->first();

        if(Hash::check($kredensial['password'], $user->password)){
            Auth::loginUsingId($user->id);
            $date = date('Y-m-d h:i:s');
            if(Auth::loginUsingId($user->id) == true){
                Log::create([
                    'waktu' => $date,
                    'aktifitas' => 'Login',
                    'id_user' => $user->id
                ]);
            }
            return Response::success(['user' => $user]);
        } else {
            return Response::error('Username atau password salah');
        }
    }

    public function logout(){
        $date = date('Y-m-d h:i:s');
        if(auth()->logout()){
            Log::create([
                'waktu' => $date,
                'aktifitas' => 'Logout',
                'id_user' => auth()->user()->id
            ]);
            auth()->logout();
            return redirect()->route('login');
        } else {
            return redirect()->back();
        }
    }
}

