<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Machine;
use App\Models\Production;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request){
        if(!Auth::check())
            return redirect('login');

        //Default values
        $machines  = Machine::get();
        foreach ($machines as $machine){
            $machine->prod = Production::where('machine_id', $machine->id)->where('status', 'C')->first();
            if($machine->prod == null){
                $machine->prod = Production::where('machine_id', $machine->id)->where('status', 'P')->first();
            }
            if($machine->prod != null)
                //$machine->latest_action = Action::find(45);
                $machine->latest_action = DB::table('actions')
                ->rightjoin('operation', 'actions.id', '=', 'operation.action_id')
                ->where('operation.production_id', $machine->prod->id)
                ->orderBy('created_at', 'desc')->first();
        }


        return view(
            'home',
            compact(
                'machines',
            )
        );
    }
}
