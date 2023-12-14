<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentHead extends Model
{
    protected $fillable = [
        'user_id',
        'department_id',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
