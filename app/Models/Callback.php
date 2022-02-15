<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
    protected $table = 'callbacks';
    protected $fillable = [
        'name',
        'phone',
        'shown'
    ];
    public function getNewAttribute()
    {
        return ($this->shown == 0 ) ? true : false;
    }
}
