<?php

namespace App\Http\Controllers;

use App\Models\action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actions = Action::all();
        return view(
            'admin.action.action',
            compact(
                'actions')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\action  $action
     * @return \Illuminate\Http\Response
     */
    public function show(action $action)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\action  $action
     * @return \Illuminate\Http\Response
     */
    public function edit(action $action)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\action  $action
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, action $action)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\action  $action
     * @return \Illuminate\Http\Response
     */
    public function destroy(action $action)
    {
        //
    }
}
