<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;
    protected $with = ['prof','module','groupe'];

    public function prof()
    {
        return $this->belongsTo(Prof::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    public function groupe()
    {
        return $this->belongsTo(Groupe::class);
    }
}
