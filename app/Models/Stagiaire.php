<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    
    public function groupe()
    {
        return $this->belongsTo(Groupe::class);
    }

    public function absences()
    {
        $year = Absysyear::Where('active','on')->first()->year;
        return $this->hasMany(Etat::class, 'foreign_key', 'stagiaire_id')->where('year',$year);
    }
    
}
