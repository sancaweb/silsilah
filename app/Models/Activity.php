<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    protected $table = "activity_log";

    public function user()
    {
        return $this->belongsTo(User::class, 'causer_id', 'id', 'id');
    }
}
