<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qlips extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->belongsTo(Question::class,'question_id');
    }

    public function advisor()
    {
        return $this->belongsTo(Advisor::class,'advisor_id');
    }

    public function status()
    {
        return $this->belongsTo(CustomStatus::class,'status_id');
    }

}
