<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    protected $table = 'productions';

        protected $fillable = ['id','order_id','code_article','desc_article','stampo','machine_id'/*,'staring_date','ending_date'*/,'objectif','status'];

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
