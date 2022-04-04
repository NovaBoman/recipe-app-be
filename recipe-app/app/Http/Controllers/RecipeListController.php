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
        return RecipeList::where('user_id', Auth::id())->get();
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
            return $validator->errors()->all();
        }

        return RecipeList::create([
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RecipeList  $recipeList
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = RecipeList::find($id);

        if (!$list) {
            return ['message' => 'No list with this ID'];
        }

        if ($list->user_id !== Auth::id()) {
            return ['message' => 'User has no list with this ID'];
        }

        return $list;
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
        $validator = Validator::make(
            $request->title,
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
            return $validator->errors()->all();
        }

        $list = RecipeList::find($id);

        if (!$list) {
            return ['message' => 'No list with this ID'];
        }

        if ($list->user_id !== Auth::id()) {
            return ['message' => 'User has no list with this ID'];
        }

        $list->update(['title' => $request->title]);
        return $list;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecipeList  $recipeList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = RecipeList::find($id);

        if (!$list) {
            return ['message' => 'No list with this ID'];
        }

        if ($list->user_id !== Auth::id()) {
            return ['message' => 'User has no list with this ID'];
        }
        $list->destroy();
        return ['message' => 'List deleted'];
    }
}
