<?php

namespace App\Http\Controllers;

use App\Models\AnimalType;
use Illuminate\Http\Request;
use Validator;

class AnimalTypeController extends Controller
{
    public function index()
    {
        try {
            $type = AnimalType::all();
            return response()->json($type, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $valid = Validator::make($request->all(), [
                'atypeName' => 'required|unique:animaltype,atypeName',
            ]);


            if ($valid->fails()) {
                return response()->json(['error' => $valid->errors()], 400);
            } else {
                $type = new AnimalType();
                $type->atypeName = $request->atypeName;
                if ($type->save()) {
                    return response()->json($type, 200);
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
                'atypeName' => 'required|unique:animaltype,atypeName,' . $id,
            ]);
            if ($valid->fails()) {
                return response()->json(['error' => $valid->errors()], 400);
            } else {
                $type = AnimalType::find($id);
                $type->atypeName = $request->atypeName;
                if ($type->update()) {
                    return response()->json($type);
                }
            }
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    public function destroy($id)
    {
        try {
            if (AnimalType::destroy($id)) {
                return response()->json('Success', 200);
            }
        } catch (\Exception $e) {
            return response()->json([], 500);
        }

    }

    public function show($id)
    {
        try {
            $type = AnimalType::find($id);
            return response()->json($type, 200);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }
}
