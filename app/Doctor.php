<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'crm',
        'phone'
    ];

    public function expertises()
    {
        return $this->belongsToMany(Expertise::class,'doctor_has_expertises','doctor_id', 'expertise_id');
    }

    public function scopeOfSearch($query, $param)
    {
        if (trim($param) != "") {
         return  $query->where('name', 'like', '%'.$param.'%')
                ->orWhere('crm', $param);
        }
    }
}
