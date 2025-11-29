<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function etats()
    {
        $year = Absysyear::Where('active','on')->first()->year;
        $Model = 'App\Models\Etat'.$year;
        
        return $this->hasMany($Model);
    }
}
