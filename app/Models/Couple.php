<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Couple extends Model
{
    use HasFactory;

    protected $table = "couples";

    public function descendants() //keturunan
    {
        return $this->hasMany(Person::class, 'parent_id', 'id');
    }

    public function personHusband()
    {
        return $this->belongsTo(Person::class, 'husband_id', 'id');
    }

    public function personWife()
    {
        return $this->belongsTo(Person::class, 'wife_id', 'id');
    }
}
