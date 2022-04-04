<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $table = 'machines';

    protected $fillable = ['name','status'];

    public $timestamps = false;

    public function productions()
    {
        return $this->hasMany(Production::class);
    }

}
