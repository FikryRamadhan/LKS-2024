<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\MyClass\Response;
use App\MyClass\Validations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $dataUsers = User::all();
        return view('user.index', [
            'users' => $dataUsers
        ]);
    }

    public function store(Request $request){
        Validations::storeUser($request);
        DB::beginTransaction();
        try {
            User::createUser($request);
            DB::commit();

            return Response::success();
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }

    }

    public function edit(User $user){
        try {
            return Response::success([
                'user' => $user
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    public function update(Request $request, User $user){
        Validations::updateUser($request);
        DB::beginTransaction();
        try {
            $user->updateData($request);
            DB::commit();

            return Response::success();
        } catch (Exception $e) {
            DB:: rollBack();

            return Response::error($e);
        }
    }

    public function destroy(User $user){
        DB::beginTransaction();
        try {
            $user->deleteData();
            DB::commit();

            return Response::success();
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }
}
