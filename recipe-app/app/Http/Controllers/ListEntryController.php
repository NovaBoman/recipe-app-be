<?php

namespace App\Http\Controllers;

use App\Models\ListEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ListEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                'recipe_list_id' => 'required',
                'recipe_id' => [
                    'required',
                    Rule::unique('list_entries')->where('recipe_list_id', $request->recipe_list_id)
                ]

            ],
            [
                'unique' => 'Recipe has already been added to list'
            ]
        );

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        return ListEntry::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListEntry  $listEntry
     * @return \Illuminate\Http\Response
     */
    public function show(ListEntry $listEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListEntry  $listEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListEntry $listEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListEntry  $listEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListEntry $listEntry)
    {
        //
    }
}
