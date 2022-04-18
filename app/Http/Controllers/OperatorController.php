<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Machine;
use App\Models\Production;
use Carbon\Carbon;
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
        $actions = [];
        $production = Production::where('machine_id', $machine->id)->where('status', 'C')->first();
        if($production == null){
            $production = Production::where('machine_id', $machine->id)->where('status', 'P')->first();
        }
        if($production != null){
            $actions = DB::table('actions')
            ->rightjoin('operation', 'actions.id', '=', 'operation.action_id')
            ->join('users', 'users.id', '=', 'operation.user_id')
            ->select('actions.id', 'actions.number', 'actions.name', 'users.username', 'operation.quantity', 'operation.created_at')
            ->where('operation.production_id', $production->id)
            ->orderBy('operation.created_at', 'desc')
            ->get();
        }
        //return $actions;
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
        $data['created_at'] = Carbon::now()->toDateTimeString();

        $production = Production::find($request['production_id']);
        if ($request['qte'] >= $production->production_lotto){
            $production->production_lotto = $request['qte'];
            $production->update();
            DB::table('operation')->insert($data);
            return redirect('operation?machine_id='.$request['machine_id'])->with('msg','Operation added successfully');
        }else{
            return ;
        }
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
