<?php

namespace App\Http\Controllers;

use App\Models\RecipeList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'title' => 'required|string',
            'user_id' => 'required|integer',
        ]);

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
        $request->validate([
            'title' => 'required|string'
        ]);
        RecipeList::find($id)->update($request->all());
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
