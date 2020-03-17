<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $cat = Category::all();
            return response()->json($cat, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $valid = Validator::make($request->all(), [
                'catName' => 'required|unique:category,catName',
            ]);


            if ($valid->fails()) {
                return response()->json(['error' => $valid->errors()], 400);
            } else {
                $cat = new Category();
                $cat->catName = $request->catName;
                if ($cat->save()) {
                    return response()->json($cat, 200);
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
                'catName' => 'required|unique:category,catName,' . $id,
            ]);
            if ($valid->fails()) {
                return response()->json(['error' => $valid->errors()], 400);
            } else {
                $cat = Category::find($id);
                $cat->catName = $request->catName;
                if ($cat->update()) {
                    return response()->json($cat);
                }
            }
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    public function destroy($id)
    {
        try {
            if (Category::destroy($id)) {
                return response()->json('Success', 200);
            }
        } catch (\Exception $e) {
            return response()->json([], 500);
        }

    }

    public function show($id)
    {
        try {
            $cat = Category::find($id);
            return response()->json($cat, 200);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }
}
