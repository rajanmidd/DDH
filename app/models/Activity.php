<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
  protected $table = 'activity';
  
  protected $fillable = ['name', 'activity_image','unit_type','status'];
  
  public function activityUnitType()
  {
     return $this->hasOne('App\models\ActivityUnitType', 'id', 'unit_type');
  }
}
