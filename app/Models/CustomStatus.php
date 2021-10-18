<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomStatus extends Model
{
    use HasFactory;

    protected $hidden=[
      'created_at',
      'updated_at'
    ];

    public function topic()
    {
        return $this->hasMany(Topic::class);
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function advisor()
    {
        return $this->hasMany(Advisor::class);
    }
}
