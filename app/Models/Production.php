<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    protected $table = 'productions';

        protected $fillable = ['id','machine_id','staring_date','ending_date','objectif'];

    public function getMachineAttribute()
    {
        return Machine::find($this->machine_id);
    }

    public function actions()
    {
        return $this->belongsToMany(Action::class,'operation')->withPivot('user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'operation')->withPivot('action_id');
    }

}
