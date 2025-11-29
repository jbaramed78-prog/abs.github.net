<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfModule extends Model
{
    use HasFactory;

    protected $table = 'prof_modules';
    public $timestamps = false;
    protected $guarded = [];
}
