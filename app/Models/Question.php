<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function topic()
    {
        return $this->hasMany(Topic::class);
    }

    public function status()
    {
        return $this->belongsTo(CustomStatus::class,'status_id');
    }
}
