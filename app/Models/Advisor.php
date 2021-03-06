<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
{
    use HasFactory;

    public function status()
    {
        return $this->belongsTo(CustomStatus::class,'status_id');
    }

    public function custom_advisor()
    {
        return $this->status()->where('slug','!=','hide')->get();
    }
}
