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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RecipeList  $recipeList
     * @return \Illuminate\Http\Response
     */
    public function show(RecipeList $recipeList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RecipeList  $recipeList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecipeList $recipeList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecipeList  $recipeList
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecipeList $recipeList)
    {
        //
    }
}
