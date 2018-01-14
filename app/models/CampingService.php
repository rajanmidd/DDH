<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CampingService extends Model
{
    protected $table = 'camping_service';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [ 'camping_id', 'service_name', 'service_value', 'created_at', 'updated_at'];
}
