<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductionExport;
use Carbon\Carbon;

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
    public function create(Request $request)
    {
        $machines = Machine::all();
        return view('admin.production.create_production',compact('machines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Paused all productions
        DB::table('productions')
        ->where('machine_id',$request['machine_id'])
        ->update(['status' => "P"]);
        //Insert new production
        $data = $request->all();
        $data['status'] = 'I';
        Production::create($data);
        //Update machine status
        DB::table('machines')
        ->where('id',$request['machine_id'])
        ->update(['status' => "R"]);
        if($request['is_crlf'])
            return redirect('production')->with('msg','Production created successfully');
        return redirect('operation?machine_id='.$request['machine_id'])->with('msg','Production created successfully');
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

    public function export(Request $request){
        $production = Production::find($request['production_id']);
        $actions = DB::table('actions')
            ->rightjoin('operation', 'actions.id', '=', 'operation.action_id')
            ->join('users', 'users.id', '=', 'operation.user_id')
            ->select('actions.id', 'actions.number', 'actions.name', 'users.fullname', 'operation.quantity', 'operation.material', 'operation.created_at')
            ->where('operation.production_id', $production->id)
            ->orderBy('operation.created_at', 'desc')
            ->get();

        return view('exports.export', [
            'production' => $production,
            'actions' => $actions
        ]);
        // $export = new ProductionExport(Production::find($request['production_id']));
        // return Excel::download($export, 'export'.Carbon::now()->toDateString().'.xlsx');
    }

    public function change_machine(Request $request)
    {
        $production = Production::find($request->p_id);
        $production->machine_id = $request->m_id;
        $production->save();
        return response(['success' => true, 'data' => []]);
    }
}
