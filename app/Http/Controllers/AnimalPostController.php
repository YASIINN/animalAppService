<?php

namespace App\Http\Controllers;

use App\Models\AnimalPost;
use App\Models\UserLike;
use Illuminate\Http\Request;
use Validator;

class AnimalPostController extends Controller
{

    public function likeorunlike(Request $request)
    {
        try {
            $likeorunlike = UserLike::where([
                ["animal_post_id", "=", $request->postid],
                ["user_id", "=", $request->userid]
            ])->get();
            if (count($likeorunlike) > 0) {
                if (UserLike::destroy($likeorunlike[0]->id)) {
                    return response()->json("Success", 200);
                }
            } else {
                $likes = new UserLike();
                $likes->animal_post_id = $request->postid;
                $likes->user_id = $request->userid;
                if ($likes->save()) {
                    return response()->json($likes, 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function index()
    {
        try {
            $post = AnimalPost::with(['animaltype', 'category', 'user', 'file', 'like'])->latest()->get();

            return response()->json($post, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $valid = Validator::make($request->all(), [
                'title' => 'required',
                'pcontent' => 'required'
            ]);


            if ($valid->fails()) {
                return response()->json(['error' => $valid->errors()], 400);
            } else {
                $post = new AnimalPost();
                $post->title = $request->title;
                $post->content = $request->pcontent;
                if ($post->save()) {
                    return response()->json($post, 200);
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
                'title' => 'required',
                'pcontent' => 'required'
            ]);
            if ($valid->fails()) {
                return response()->json(['error' => $valid->errors()], 400);
            } else {
                $post = AnimalPost::find($id);
                $post->title = $request->title;
                $post->content = $request->pcontent;
                if ($post->update()) {
                    return response()->json($post);
                }
            }
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    public function destroy($id)
    {
        try {
            if (AnimalPost::destroy($id)) {
                return response()->json('Success', 200);
            }
        } catch (\Exception $e) {
            return response()->json([], 500);
        }

    }

    public function show($id)
    {
        try {
            $post = AnimalPost::find($id);
            return response()->json($post, 200);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }
}
