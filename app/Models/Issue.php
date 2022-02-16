<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $table = 'issues';
    protected $fillable = [
        'name',
        'phone',
        'result',
        'shown',
        'product_id'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    //Accessors
    public function getNewAttribute()
    {
        return $this->shown == 0 ? true : false;
    }
}
