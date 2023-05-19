<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kurir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KurirController extends Controller
{
    public function list()
    {
        $list = Kurir::all();
        return response()->json($list, 200);
    }

    public function getById($id)
    {
        $detail = Kurir::find($id);
        return response()->json($detail, 200);
    }


    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json(['message' => 'error', 'data' => $messages], 400);
        }

        $result = Kurir::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'api_token' => Str::random(60),
        ]);
        return response()->json($result, 201);
    }


    public function update(Request $request)
    {
        $id = $request->input('id');
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'password' => 'required',
            'email' => 'email',
        ]);
        if ($validator->fails()) {
            return response()->json('id and password is required', 400);
        }

        Kurir::where('id', $id)
            ->update($request->all());
        $result = Kurir::find($id);

        return response()->json($result, 200);
    }


    public function delete($id)
    {
        Kurir::where('id', $id)->delete();
        return response()->json("Data Kurir with id $id already deleted", 200);
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

        $result = Kurir::all()->where('email', $email)->where('password', $password)->first();
        if ($result) {
            return response()->json($result, 200);
        }
        return response()->json("Kurir unregistered!", 404);
    }
}
