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

    public function user()
    {
        return $this->belongsToMany(User::class,'user_qlips','qlips_id','user_id');
    }


    public function userLisining()
    {
        return $this->belongsToMany(User::class,'user_listenings','qlips_id','user_id');
    }

    public function userUpvote()
    {
        return $this->belongsToMany(User::class,'user_upvote','qlips_id','user_id');
    }
}
