<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupeProf extends Model
{
    use HasFactory;

    protected $table = 'groupe_profs';
    public $timestamps = false;
    protected $guarded = [];
}
