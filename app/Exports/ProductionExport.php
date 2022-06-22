<?php

namespace App\Exports;

use App\Models\Production;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromView;

class ProductionExport implements FromView
{

    protected $production;

    public function __construct(Production $production)
    {
        $this->production = $production;
    }

    public function view(): View
    {
        return view('exports.export', [
            'productions' => Production::all()// $this->production
        ]);
    }

}
