<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Groupe;
use App\Models\Filiere;

class Module extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

/*     public function profs()
    {
        return $this->belongsToMany(Prof::class,'prof_modules');
    } */

    public function profs()
    {
        return $this->belongsToMany(Prof::class,'relations');
    }

/*     public function groupes()
    {
        return $this->belongsToMany(Groupe::class,'groupe_modules');
    } */

    public function groupes()
    {
        return $this->belongsToMany(Groupe::class,'relations');
    }
}
