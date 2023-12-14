<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitHead extends Model
{
    protected $fillable = [
        'user_id',
        'unit_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}
