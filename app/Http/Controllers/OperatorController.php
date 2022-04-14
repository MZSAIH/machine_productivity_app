<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Machine;
use App\Models\Production;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $machine = Machine::find($req['machine_id']);
        $production = Production::where('machine_id', $machine->id)->where('status', 'C')->first();
        if($production == null){
            $production = Production::where('machine_id', $machine->id)->where('status', 'P')->first();
        }

        $actions = DB::table('actions')
        ->rightjoin('operation', 'actions.id', '=', 'operation.action_id')
        ->where('operation.production_id', $production->id)
        ->get();

        return view(
            'operator.operation',
            compact(
                'machine',
                'production',
                'actions'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $machine = Machine::find($req['machine_id']);
        $production = Production::find($req['production_id']);
        $actions = Action::all();
        return view(
            'operator.create_operation',
            compact(
                'machine',
                'actions',
                'production'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['production_id'] = $request['production_id'];
        $data['action_id'] = $request['action_id'];
        $data['user_id'] = $request['user_id'];
        $data['quantity'] = $request['qte'];
        DB::table('operation')->insert($data);
        return redirect('operation?machine_id='.$request['machine_id'])->with('msg','Operation added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
    }

    public function change_production(Request $request)
    {
        $production = Production::find($request['id']);
        //Update other productons with C status to P
        DB::table('productions')
            ->where('machine_id',$production->machine_id)
            ->where('status','C')
            ->update(['status' => "P"]);
        //Update our production to C status
        DB::table('productions')
            ->where('id', $request['id'])
            ->update(['status' => "C"]);
    }

}
