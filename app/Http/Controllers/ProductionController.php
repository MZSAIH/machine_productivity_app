<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Machine;
use App\Models\Production;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $machine_id = 0;
        $machines = Machine::all();
        if($request->has('machine_id')){
            $machine_id = $request['machine_id'];
            $productions = Production::where('machine_id', $machine_id)->get();
        }else{
            $productions = Production::all();
        }
        return view(
            'admin.production.production',compact('productions','machine_id','machines')
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
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function show(Production $production)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function edit(Production $production)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Production $production)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function destroy(Production $production)
    {
        $production->delete();
        return response(['success' => true]);
    }

    public function change_machine(Request $request)
    {
        return $request['id'];
        $production = Production::find($request->prod_id);
        $production->machine_id = $request->machine_id;
        $production->save();
        return response(['success' => true, 'data' => []]);
    }
}
