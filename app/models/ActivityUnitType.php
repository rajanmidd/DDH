<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ActivityUnitType extends Model
{
  protected $table = 'activity_unit_type';
  
  protected $fillable = ['unit_name', 'status'];
}
