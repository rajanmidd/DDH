<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ComboPackages extends Model
{
    protected $table = 'combo_packages';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [ 'agency_id', 'combo_name', 'combo_title', 'combo_description', 'days', 'night', 'price', 'triple_sharing','double_sharing', 'combo_location', 'latitude','longitude','camping','camp_description','status','is_deleted','is_blocked','created_at','updated_at'];


  public function comboMeal()
  {
    return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','12')->orderBy('id','asc');
  }

  public function comboInclusion()
  {
    return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','13')->orderBy('id','asc');
  }

  public function comboExclusion()
  {
    return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','14')->orderBy('id','asc');
  }


  public function comboImages()
  {
    return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','15')->orderBy('id','asc');
  }

  public function comboVideos()
  {
    return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','16')->orderBy('id','asc');
  }

  public function comboTerms()
  {
    return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','17')->orderBy('id','asc');
  }

  public function comboNotes()
  {
    return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','18')->orderBy('id','asc');
  }

  public function comboItinerary()
  {
    return $this->hasMany('App\models\Itinerary', 'camping_id', 'id')->where('type','2')->orderBy('id','asc');
  }

  public function comboService()
  {
    return $this->hasMany('App\models\CampingService', 'camping_id', 'id')->where('type','2')->orderBy('id','asc');
  }
}
