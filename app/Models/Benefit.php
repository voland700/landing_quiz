<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\ProductsRequest;

class Benefit extends Model
{

    protected $table = 'benefits';
    protected $fillable = [
        'active',
        'name',
        'sort',
        'img'
    ];

    public static function uploadImage(ProductsRequest $request, $image = null)
    {
        if ($request->hasFile('img')) {
            if ($image) {
                Storage::delete($image);
            }
            $folder = substr(str_shuffle("01234567890123456789"), 0, 2);
            return $request->file('img')->store("/images/{$folder}");
        }
        return null;
    }

    public function getImage()
    {
        if (!$this->img) {
            return asset("/images/src/no-photo.jpg");
        }
        return asset("storage/{$this->img}");
    }



}
