<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $guarded;

    public function status()
    {
        return $this->belongsTo(CustomStatus::class,'status_id');
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }
}
