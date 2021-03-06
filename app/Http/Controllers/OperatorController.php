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
        $scartos = [];
        $production = Production::where('machine_id', $machine->id)->where('status', 'C')->first();
        if($production == null){
            $production = Production::where('machine_id', $machine->id)->where('status', 'P')->first();
        }
        if($production != null){
            $actions = DB::table('actions')
            ->rightjoin('operation', 'actions.id', '=', 'operation.action_id')
            ->join('users', 'users.id', '=', 'operation.user_id')
            ->select('actions.id', 'actions.number', 'actions.name', 'users.fullname', 'operation.quantity', 'operation.material', 'operation.created_at')
            ->where('operation.production_id', $production->id)
            ->orderBy('operation.created_at', 'desc')
            ->get();

            $scartos = DB::table('scarto')
            ->leftJoin('users', 'scarto.user_id', '=', 'users.id')
            ->select('users.fullname', 'scarto.scarto', 'scarto.scarto_pr', 'scarto.created_at')
            ->where('scarto.production_id', $production->id)
            ->orderBy('scarto.created_at', 'desc')
            ->get();

        }
        //return $scartos;
        return view(
            'operator.operation',
            compact(
                'machine',
                'production',
                'actions',
                'scartos'
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
        $data['material'] = $request['material'];
        $data['created_at'] = Carbon::now()->toDateTimeString();
        //return $data;
        $production = Production::find($request['production_id']);
        $machine    = Machine::find($request['machine_id']);
        if ($request['qte'] >= $production->production_lotto){
            $production->production_lotto = $request['qte'];
            $production->material = $request['material'];
            DB::table('operation')->insert($data);
            //Update status machine and production
            if ($request['action_id'] == 61 ||
                    $request['action_id'] == 62 ||
                        $request['action_id'] == 63 ) {
                $machine->status = 'R';
            }elseif($request['action_id'] == 66 ||
                        $request['action_id'] == 67 ){
                $machine->status = 'C';
            }elseif($request['action_id'] == 68 ){
                $machine->status = 'F';
            }elseif($request['action_id'] == 70 ){
                $machine->status = 'P';
                $production->status = 'F';
            }elseif($request['action_id'] == 64 ||
                        $request['action_id'] == 16 ||
                        $request['action_id'] == 17 ||
                        $request['action_id'] == 45 ||
                        $request['action_id'] == 46 ||
                        $request['action_id'] == 47 ||
                        $request['action_id'] == 48 ||
                        $request['action_id'] == 53 ||
                        $request['action_id'] == 55 ||
                        $request['action_id'] == 56 ||
                        $request['action_id'] == 57 ||
                        $request['action_id'] == 65 ||
                        $request['action_id'] == 69 ||
                        $request['action_id'] == 88 ||
                        $request['action_id'] == 25 ){
                $machine->status = 'E';
            }elseif($request['action_id'] == 54 ){
                $machine->status = 'P';
            }elseif($request['action_id'] == 58 ){
                $machine->status = 'P';
                $production->status = 'P';
            }
            $machine->update();
            $production->update();
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
        //Update machine status
        DB::table('machines')
            ->where('id', $production->machine_id)
            ->update(['status' => "C"]);
    }

    public function create_production(Request $request)
    {
        $machine_id = 0;
        if($request->has('machine_id'))
            $machine_id = $request['machine_id'];
        return view('operator.create_production',compact('machine_id'));
    }

    public function create_scarto(Request $req)
    {
        $machine = Machine::find($req['machine_id']);
        $production = Production::find($req['production_id']);
        $actions = Action::all();
        return view(
            'operator.create_scarto',
            compact(
                'machine',
                'actions',
                'production'
            )
        );
    }

    public function store_scarto(Request $request)
    {
        $data['production_id'] = $request['production_id'];
        $data['machine_id'] = $request['machine_id'];
        $data['user_id'] = $request['user_id'];
        $data['scarto'] = $request['scarto'];
        $data['scarto_pr'] = $request['scarto_pr'];
        $data['created_at'] = Carbon::now()->toDateTimeString();
        //return $data;
        $production = Production::find($request['production_id']);
        if ($request['scarto'] >= $production->scarto){
            $production->scarto = $request['scarto'];
            $production->update();
            DB::table('scarto')->insert($data);
            return redirect('operation?machine_id='.$request['machine_id'])->with('msg','Scarto added successfully');
        }else{
            return ;
        }
    }

}
