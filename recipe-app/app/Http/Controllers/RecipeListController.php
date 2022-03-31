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
        return RecipeList::where('user_id', 1)->get();
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
                'user_id' => 'required|integer',
                'title' => [
                    'required',
                    'string',
                    Rule::unique('recipe_lists')->where('user_id', $request->user_id)
                ]

            ],
            [
                'unique' => 'List with this name already exists'
            ]
        );

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        return RecipeList::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RecipeList  $recipeList
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return RecipeList::find($id);
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
            $request->all(),
            [
                'user_id' => 'required|integer',
                'title' => [
                    'required',
                    'string',
                    Rule::unique('recipe_lists')->where('user_id', $request->user_id)
                ]

            ],
            [
                'unique' => 'List with this name already exists'
            ]
        );

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        RecipeList::find($id)->update(['title' => $request->title]);
        return RecipeList::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecipeList  $recipeList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return RecipeList::destroy($id);
    }
}
