<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $table = 'general_setting';

    protected $fillable = ['business_name','contact_person_name','contact','business_address','city','company_white_logo','company_black_logo','site_color','favicon',];
    protected $appends = ['whitelogo','blacklogo'];

    public function getWhiteLogoAttribute()
    {
        return url('images/upload') . '/'.$this->attributes['company_white_logo'];
    }

    public function getBlackLogoAttribute()
    {
        return url('images/upload') . '/'.$this->attributes['company_black_logo'];
    }
}
