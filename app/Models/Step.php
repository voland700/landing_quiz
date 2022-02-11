<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function benefits()
    {
        return  Benefit::where('active', 1)->select('name', 'img')->orderBy('sort')->limit(5)->get();
    }

    public function getSession()
    {
        if (!session()->has('quiz')) {
            $steps = DB::table('steps')->where('active', 1)->orderBy('sort')->get();
            $stages = [];
            $i = 1;
            foreach($steps as $step){
                $stages['steps'][$i] = [
                    'id'=> $step->id,
                    'name'=> $step->name,
                    'received' => false,
                    'answer' => [],
                    'extra' => [],
                    'message' => [],
                    'step' => $i
                ];
                $i++;
            }
            $stages['count'] = (int)$steps->count();
            $stages['total'] = (int)$stages['count'] +1;
            session(['quiz' => $stages]);
            return $stages;
        } else {
            return  session('quiz');
        }
    }













}
