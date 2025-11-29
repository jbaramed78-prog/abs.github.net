<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Absysyear;
use App\Models\Module;
use App\Models\Stagiaire;
use Illuminate\Support\Facades\Auth;

class Groupe extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

/*     public function profs()
    {
        return $this->belongsToMany(Prof::class,'groupe_profs');
    } */

    public function profs()
    {
        return $this->belongsToMany(Prof::class,'relations');
    }


    public function stagiaires()
    {
        $year = Absysyear::Find(Auth::user()->year)->year;
        return $this->hasMany(Stagiaire::class)->where('year',$year);
    }

    public function modules()
    {
        return $this->belongsToMany(module::class,'relations');
    }
 
/*     public function modules()
    {
        return $this->belongsToMany(module::class,'groupe_modules');
    } */
}

