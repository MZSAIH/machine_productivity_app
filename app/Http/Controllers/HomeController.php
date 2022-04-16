<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Machine;
use App\Models\Production;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;

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
        }
        $latest_action = Action::find(45);
        return view(
            'home',
            compact(
                'machines',
                'latest_action'
            )
        );
    }
}
