<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $table = 'machines';

    protected $fillable = ['id','name','status'];

    public function productions()
    {
        return $this->hasMany(Production::class);
    }

}
