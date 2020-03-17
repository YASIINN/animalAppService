<?php

namespace App\Http\Controllers;

use App\Models\Password;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        try {
            $user = User::all();
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $user = User::with([])->where([["email", "=", $request->username]])->whereHas("password", function ($q) use ($request) {
                $q->where("password", $request->password);
            })->get();
            if (count($user) > 0) {
                return response()->json($user, 200);
            } else {
                return response()->json([], 204);

            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $valid = Validator::make($request->all(), [
                'username' => 'required|unique:user,email',
                "password" => "required",
                "phone" => 'required|unique:user,phone',
            ]);


            if ($valid->fails()) {
                return response()->json(['error' => $valid->errors()], 204);
            } else {
                $user = new User();
                $user->uName = "";
                $user->surName = "";
                $user->uFullName = "";
                $user->email = $request->username;
                $user->phone = $request->phone;
                $user->gender = "";

                if ($user->save()) {
                    $pass = new Password();
                    $pass->password = $request->password;
                    $pass->user_id = $user->id;
                    if ($pass->save()) {
                        return response()->json($user, 200);
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $valid = Validator::make($request->all(), [
                'phone' => 'unique:user,phone,' . $id,
            ]);
            if ($valid->fails()) {
                return response()->json(['error' => $valid->errors()], 204);
            } else {
                $user = User::find($id);
                $user->uName = $request->name ? $request->name : "";
                $user->surName = $request->surname ? $request->surname : "";
                $user->uFullName = ($request->name && $request->surname) ? $request->name . " " . $request->surname : "";
                $user->phone = $request->phone;
                $user->gender = $request->gender ? $request->gender : '';

                if ($user->update()) {
                    return response()->json($user);
                }
            }
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    public  function userPost(Request $request){
        try {
            $user = User::find(1)->animalpost;
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    public function destroy($id)
    {
        try {
            if (User::destroy($id)) {
                return response()->json('Success', 200);
            }
        } catch (\Exception $e) {
            return response()->json([], 500);
        }

    }

    public function show($id)
    {
        try {
            $user = User::find($id);
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }
}
