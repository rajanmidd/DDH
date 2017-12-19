<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ActivityDifficultyLevel extends Model
{
    protected $table = 'activity_difficulty_level';
    
    protected $fillable = ['name','status'];
}
