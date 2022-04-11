<?php

namespace App\Http\Controllers;

use App\Models\RecipeList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RecipeListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(RecipeList::where('user_id', Auth::id())->with('ListEntries')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'title' => [
                    'required',
                    'string',
                    Rule::unique('recipe_lists')->where('user_id', Auth::id())
                ]

            ],
            [
                'unique' => 'List with this name already exists'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['message' => $errors], 422);
        }

        $list = RecipeList::create(['title' => $request->title, 'user_id' => Auth::id()]);
        return response()->json(['message' => 'List created', 'list' => $list], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RecipeList  $recipeList
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = RecipeList::where('user_id', Auth::id())->with('ListEntries')->find($id);

        if (!$list) {
            return response()->json(['message' => 'No list with this ID'], 404);
        }

        return response()->json($list, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RecipeList  $recipeList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $list = RecipeList::where('user_id', Auth::id())->find($id);

        if (!$list) {
            return response()->json(['message' => 'No list with this ID'], 404);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'title' => [
                    'required',
                    'string',
                    Rule::unique('recipe_lists')->where('user_id', Auth::id())
                ]

            ],
            [
                'unique' => 'List with this name already exists'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['message' => $errors], 422);
        }

        $list->update(['title' => $request->title]);
        return response()->json(['message' => 'List title updated', $list], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecipeList  $recipeList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = RecipeList::where('user_id', Auth::id())->find($id);

        if (!$list) {
            return response()->json(['message' => 'No list with this ID'], 404);
        }

        $list->delete();
        return response()->json(['message' => 'List deleted'], 200);
    }
}
