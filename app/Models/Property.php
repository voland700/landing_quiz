<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';
    protected $fillable = [
        'name',
        'sort'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
