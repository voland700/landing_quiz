<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $table = 'steps';
    protected $fillable = [
        'name',
        'active',
        'sort',
        'type',
        'extra',
        'obligatory',
        'advice'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }



}
