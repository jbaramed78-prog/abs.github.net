<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


class Prof extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

/*     public function groupes()
    {
        return $this->belongsToMany(Groupe::class,'groupe_profs');
    } */
    public function groupes()
    {
        return $this->belongsToMany(Groupe::class,'relations');
    }

    public function absences()
    {
        $year = Absysyear::Where('active','on')->first()->year;
        $Model = 'App\Models\Etat'.$year;
        return $this->hasMany($Model);
    }


    public function modules()
    {
        return $this->belongsToMany(module::class,'relations');
    }
}
