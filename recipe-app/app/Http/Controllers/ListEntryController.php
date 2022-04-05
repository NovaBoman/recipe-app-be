<?php

namespace App\Http\Controllers;

use App\Models\ListEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ListEntryController extends Controller
{

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
                'recipe_list_id' => [
                    'required',
                    Rule::exists('recipe_lists', 'id')->where('user_id', Auth::id())
                ],

                'recipe_id' => [
                    'required',
                    Rule::unique('list_entries')->where('recipe_list_id', $request->recipe_list_id)
                ]
            ],
            [
                'unique' => 'Recipe has already been added to list',
                'exists' => 'No recipe list with this ID'
            ]
        );

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        return ListEntry::create($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListEntry  $listEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entry = ListEntry::find($id);
        if (!$entry || $entry->recipeList->user->id !== Auth::id()) {
            return ['message' => 'No entry with this ID'];
        }
        $entry->delete();
        return ['message' => 'Entry deleted'];
    }
}
