<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $table = 'actions';

    protected $fillable = ['number','name'];

    public $timestamps = false;

    public function productions()
    {
        return $this->belongsToMany(Production::class,'operation')->withPivot('user_id');
    }

    public function users(){
        return $this->belongsToMany(User::class,'operation')->withPivot('production_id');
    }
}
