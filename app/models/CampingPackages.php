<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CampingPackages extends Model
{
  protected $table = 'camping_packages';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [ 'agency_id', 'camping_name', 'camping_title', 'camping_description', 'days', 'night', 'triple_sharing','double_sharing','status','is_deleted','is_blocked','created_at','updated_at'];


  public function campingMeal()
  {
    return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','5')->orderBy('id','asc');
  }

  public function campingInclusion()
  {
    return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','6')->orderBy('id','asc');
  }

  public function campingExclusion()
  {
    return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','7')->orderBy('id','asc');
  }


  public function campingImages()
  {
    return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','8')->orderBy('id','asc');
  }

  public function campingVideos()
  {
    return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','9')->orderBy('id','asc');
  }

  public function campingTerms()
  {
    return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','10')->orderBy('id','asc');
  }

  public function campingNotes()
  {
    return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','11')->orderBy('id','asc');
  }

  public function campItinerary()
  {
    return $this->hasMany('App\models\Itinerary', 'camping_id', 'id')->orderBy('id','asc');
  }

  public function campService()
  {
    return $this->hasMany('App\models\CampingService', 'camping_id', 'id')->orderBy('id','asc');
  }
}
