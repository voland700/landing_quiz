<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = [
        'active',
        'name',
        'sort',
        'step_id'
    ];

    public function step()
    {
        return $this->belongsTo(Step::class);
    }
}
