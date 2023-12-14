<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name',
        'department_id',
    ];

    public function department(){
        return $this->belongsTo('App\Models\Department','department_id','id');
    }

    public function unitHead()
    {
        return $this->hasOne(UnitHead::class, 'unit_id', 'id');
    }
}
