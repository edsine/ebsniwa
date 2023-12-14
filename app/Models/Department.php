<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'created_by',
    ];

    public function branch(){
        return $this->hasOne('App\Models\Branch','id','branch_id');
    }

    public function departmentHead()
    {
        return $this->hasOne(DepartmentHead::class, 'department_id', 'id');
    }
}
