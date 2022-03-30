<?php

namespace App\Http\Controllers;

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
            $machine->prod = Production::where('machine_id', $machine->id)->where('status', 1)->first();
        }
        return view(
            'home',
            compact(
                'machines'
            )
        );
    }
}
