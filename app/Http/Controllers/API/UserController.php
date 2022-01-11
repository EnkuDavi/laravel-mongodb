<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Helpers\ResponseFormatter;

class UserController extends Controller
{
    public function get()
    {
        $user = User::all();
        return ResponseFormatter::success($user, 'Data Users');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required','max:64'],
                'username' => ['required','string','max:32','unique:users,username'],
                'email' => ['required','email','unique:users,email'],
                'password' => ['required','string'],
                'phone' => ['required','numeric']
            ]);

            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone
            ]);

            $user = User::where('username', $request->username)->first();
            return ResponseFormatter::success($user, 'Data Berhasil di simpan');
        } catch (Throwable $err) {
            return ResponseFormatter::error(Null, $err ,500);
        }
    }

    
    public function show($name)
    {
      
        $user = User::where('username',$name)->get();
        if(count($user) > 0){
            return ResponseFormatter::success($user, 'Data Berhasil di temukan');
        }else{
            return ResponseFormatter::error(Null, 'Not Found', 404);
        }
    }

    public function update(Request $request, $name)
    {
        try {
            $request->validate([
                'name' => ['required','max:64'],
                'username' => ['required','string','max:32','unique:users,username'],
                'email' => ['required','email','unique:users,email'],
                'password' => ['required','string'],
                'phone' => ['required','numeric']
            ]);

            $data = $request->all();
            $user = User::where('username', $name)->first();
            if($user){
                $user->name = $request->name;
                $user->username = $request->username;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->phone = $request->phone;

                $user->save();
                return ResponseFormatter::success($data, 'Data Berhasil di Update');
            }else{
                return ResponseFormatter::error(Null, 'Data tidak ditemukan!', 500);
            }
        } catch (Throwable $err) {
            return ResponseFormatter::error(Null, $err, 500);
        }
    }

    public function destroy($name)
    {
        $user = User::where('username', $name)->first();
        if($user){
            $user->delete();
            return ResponseFormatter::success(True, 'Data Berhasil di delete');
        }else{
            return ResponseFormatter::error(
                Null, 'Data tidak ditemukan', 404
            );
        }
    }
}
