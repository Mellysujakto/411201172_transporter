<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator as Validator;

class UserController extends Controller
{
    public function list()
    {
        $list = User::all();
        return response()->json($list, 200);
    }

    public function listKurir()
    {
        $list = User::all()->where("role",  'kurir');
        return response()->json($list, 200);
    }

    public function listAdmin()
    {
        $list = User::all()->where("role",  'admin');
        return response()->json($list, 200);
    }

    public function getById($id)
    {
        $detail = User::find($id);
        return response()->json($detail, 200);
    }


    public function create(Request $request)
    {
        $role = 'kurir';

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json('name and email are required', 400);
        }

        if ($request->get('role') != null) {
            $role = $request->get('role');
        }

        $password = 'Test1234';

        if ($request->get('password') != null) {
            $password = $request->get('password');
        }

        $result = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($password),
            'api_token' => Str::random(60),
            'role' => $role,
        ]);
        return response()->json($result, 201);
    }


    public function update(Request $request)
    {
        $role = 'kurir';
        $id = $request->input('id');
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json('id, name, password, and email are required', 400);
        }

        $product = User::find($id);

        if ($request->get('role') == null) {
            $role = $product->role;
        } else {
            $role = $request->get('role');
        }

        $product->name = $request->get('name');
        $product->email = $request->get('email');
        $product->role = $role;
        if ($request->get('password') != null && $request->get('password') != $product->password) {
            $product->password = Hash::make($request->get('password'));
        }
        $product->save();

        $result = User::find($id);

        return response()->json($result, 200);
    }


    public function delete($id)
    {
        User::where('id', $id)->delete();
        return response()->json("Data User with id $id already deleted", 200);
    }

    public function getToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json(['message' => 'error', 'data' => $messages], 400);
        }

        $email = $request->input('email');
        $password = $request->input('password');

        //will be failed cauesed by password
        $result = User::all()->where('email', $email)->where('password', $password)->first();
        if ($result) {
            return response()->json($result, 200);
        }
        return response()->json("User unregistered!", 404);
    }
}
