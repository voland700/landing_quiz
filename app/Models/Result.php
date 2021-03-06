<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';
    protected $fillable = [
        'name',
        'phone',
        'result',
        'shown'
    ];
    //Accessors
    public function getNewAttribute()
    {
        return $this->shown == 0 ? true : false;
    }
}
